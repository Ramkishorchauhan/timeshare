<?php 

use Illuminate\Support\Str;
use App\Library\GetFunction;

if(!function_exists('p')){
    function p($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";

    }
}

if(!function_exists('uploadImage')){
    function uploadImage($request,$file_name,$path='uploads'){
        return GetFunction::uploadImage($request,$file_name,$path);
    }
}

?>