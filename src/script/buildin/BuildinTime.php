<?php
namespace app\script\buildin;
use app\script\Runtime;
class BuildinTime {
    /**
     * @param Runtime $runtime
     * @return string
     */
    public static function getHhiiss( ) {
        return date('His');
    }
}