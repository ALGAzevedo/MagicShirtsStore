<?php

if (! function_exists('static_asset')) {
    function static_asset($key,$url) {
        return $key ? asset('storage/estampas/'.$url) : route('storage.asset', ['path' => $url]);
    }
}
/*
 * helper para recibos em pdf
if (! function_exists('static_file')) {
    function static_file($file) {
        return route('storage.file', ['path' => $file]);
    }
}*/
