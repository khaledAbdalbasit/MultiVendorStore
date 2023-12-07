<?php
function load_class($className)
{
    return __DIR__."/{$className}.php";
}

spl_autoload_call('load_class');


?>
