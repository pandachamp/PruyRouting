<?php

use PruyRouting\Route;

Route::map("/user/{dddd}","get",function ($request){
    echo "Hello {$request['dddd']} and {$request['name']}";
});


Route::map("/user","post",function ($request){
    echo "World {$request['name']}";
});

Route::map("/data/{number}","post",function ($request){
    echo "Number is {$request['number']} and Name is {$request['name']}";
});