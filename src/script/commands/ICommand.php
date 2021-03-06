<?php
namespace app\script\commands;
use app\script\TestCase;

interface ICommand {
    /**
     * set command args to command
     * @param array $args
     * @return void
     */
    function setCmdArgs( $args );
    
    /**
     * execute command with runtime
     * @return void
     */
    function exec( );
    
    /**
     * @param string $rawCommand
     */
    function setRawCommand( $rawCommand );
    
    /**
     * @return string
     */
    function getRawCommand();
    
    /**
     * 
     */
    function isBlockStart();
    
    /**
     * 
     */
    function isBlockEnd(ICommand $command);
    
    /**
     * @param ICommand $command
     */
    function pushCommand(ICommand $command);
    
    /**
     * setup command definations
     * @param string $name
     * <li> - file : the file path of command. </li>
     * <li> - line : this line no of command in file. </li>
     * @param mixed $value
     */
    function setDefination($name, $value);
    
    /**
     * get command definations
     * @param string $name
     * <li> - file : the file path of command. </li>
     * <li> - line : this line no of command in file. </li>
     * @return mixed
     */
    function getDefination($name);
    
    /**
     * set testcase to command
     * @param TestCase $testcase
     * @return void
     */
    function setTestCase( TestCase $testcase );
}

