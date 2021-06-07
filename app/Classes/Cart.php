<?php

namespace App\Classes;

use Illuminate\Support\Collection;

class Cart extends Collection{
    public static function getContent(): Collection
    {
        return session()->has('carrinho')
            ? collect(session()->get('carrinho'))
            : new Collection;
    }

    public static function total()
    {
        $content = self::getContent();
        return $content->sum('quantidade');
    }

    public static function subtotal()
    {
        $content = self::getContent();
        return $content->sum('subtotal');

    }

    public static function destroy()
    {
        session()->forget('carrinho');
        session()->forget('carrinho_qty');
        session()->forget('carrinho_subtotal');
    }
}
