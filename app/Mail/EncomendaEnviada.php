<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EncomendaEnviada extends Mailable
{
    use Queueable, SerializesModels;

    private $userID, $encomenda;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($encomenda, $utilizador)
    {
        $this->encomenda = $encomenda;
        $this->userID = $utilizador;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::findOrFail($this->userID);

        return $this->from('noreply@magicshirtstore.com')
            ->subject('A sua encomenda for enviada.')
            ->view('emails.orders.enviada')
            ->withEncomenda($this->encomenda)
            ->with([
                'orderId' => $this->encomenda->id,
                'orderName' => $user->name,
                'orderPrice' => $this->encomenda->preco_total,
            ]);
    }
}
