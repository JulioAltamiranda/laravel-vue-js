<?php

use Illuminate\Support\Facades\Storage;

function currentRoute($name){
    return request()->is($name);
}