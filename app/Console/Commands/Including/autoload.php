<?php


spl_autoload_register(function($class){

    $filename = "$class.php";

    if(!file_exists($filename)){

        echo "Class does not exist";

    }

    include $filename;

    //include "$class.php";

});
