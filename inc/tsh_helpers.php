<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
* @desc Debug
* @param string $str
* @return array
**/
function vardump( $str ){
        var_dump('<pre>');
        var_dump( $str );
        var_dump('</pre>');
}