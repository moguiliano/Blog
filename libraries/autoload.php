<?php

spl_autoload_register(function($className)
{
    
    $className= str_replace('\\','/', $className);
    // replace (arg1 par arg 2 dans expression)
    //"Controllers\article" 
    require_once('libraries/'.$className.'.php');

})
?>