<?php
namespace app\script\commands;
class CommandActive extends BaseCommand {
    /**
     * @var string
     */
    private $operatorName = null;
    
    /**
     * {@inheritDoc}
     * @see \app\script\commands\ICommand::setCmdArgs()
     */
    public function setCmdArgs($args) {
        if ( !isset($args[0]) ) {
            throw new \Exception('active command requires an operator name');
        }
        $this->operatorName = $args[0];
    }
    
    /**
     * {@inheritDoc}
     * @see \app\script\commands\BaseCommand::run()
     */
    protected function run() {
        $this->getRuntime()->activeOperator($this->operatorName);
    }
}