<?php

namespace App\Classes;

use Illuminate\Support\Collection;

class Cart extends Collection{
    public function getContent(): Collection
    {
        return session()->has('carrinho')
            ? collect(session()->get('carrinho'))
            : new Collection;
    }

    public function count()
    {
        $content = $this->getContent();
        return $content->sum('quantidade');
    }

    public function subtotal()
    {
        $content = $this->getContent();
        return $content->sum('subtotal');

    }

    public function destroy()
    {
        session()->forget('carrinho');
        session()->forget('carrinho_qty');
    }
}
