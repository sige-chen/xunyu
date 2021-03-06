<?php
namespace app\script\commands;
use app\script\UserFunction;

class CommandFunc extends BaseCommand {
    /**
     * @var unknown
     */
    protected $name = null;
    /**
     * @var unknown
     */
    protected $params = null;
    
    /**
     * @var array
     */
    private $commands = array();
    
    /**
     * @var array
     */
    private $blockChain = [];
    
    /**
     * {@inheritDoc}
     * @see \app\script\commands\ICommand::pushCommand()
     */
    public function pushCommand(ICommand $command) {
        if ( $command === $this ) {
            # 初始化
            $this->blockChain[] = $command;
            $this->commands = [];
        } else if ( $command->isBlockStart() ) {
            # 出现子块
            $this->blockChain[] = $command;
            $this->commands[] = $command;
        } else if ( 1 < count($this->blockChain)
        && $command->isBlockEnd($this->blockChain[count($this->blockChain)-1]) ) {
            # 出现块结束符
            array_pop($this->blockChain);
            $this->commands[] = $command;
        } else if ( 1==count($this->blockChain)
        && $command instanceof CommandEndfunc ) {
            # 当前块结束
            $this->getRuntime()->blockFinished();
            $this->exec();
        } else {
            # 普通命令
            $this->commands[] = $command;
        }
    }
    
    /**
     * {@inheritDoc}
     * @see \app\script\commands\BaseCommand::setCmdArgs()
     */
    public function setCmdArgs( $args ) {
        $this->name = array_shift($args);
        $this->params = $args;
    }
    
    /**
     * {@inheritDoc}
     * @see \app\script\commands\BaseCommand::isBlockStart()
     */
    public function isBlockStart() {
        return true;
    }
    
    /**
     * {@inheritDoc}
     * @see \app\script\commands\BaseCommand::run()
     */
    protected function run() {
        $func = new UserFunction();
        $func->name = $this->name;
        $func->paramNames = $this->params;
        $func->commands = $this->commands;
        $func->file = $this->getDefination('file');
        $func->line = $this->getDefination('line');
        $this->getRuntime()->funcRegister($func);
    }
}