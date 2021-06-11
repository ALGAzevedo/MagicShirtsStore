<?php

if (! function_exists('static_asset')) {
    function static_asset($cliente_id,$url) {
        return $cliente_id ?  route('storage.asset', ['path' => $url]) : asset('storage/estampas/'.$url);
    }
}
/*
 * helper para recibos em pdf
if (! function_exists('static_file')) {
    function static_file($file) {
        return route('storage.file', ['path' => $file]);
    }
}*/
