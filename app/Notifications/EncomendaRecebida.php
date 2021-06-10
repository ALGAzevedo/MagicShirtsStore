<?php

namespace App\Notifications;

use App\Models\Encomenda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class EncomendaRecebida extends Notification
{
    use Queueable;
    private $encomenda;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($encomendaRecebida, $utilizador)
    {
        $this->encomenda = $encomendaRecebida;
        $this->user = $utilizador;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $url = url('encomendas/'.$this->encomenda->id);
        return (new MailMessage)
            ->greeting("Olá, ". $this->user->name."!")
            ->line('A sua encomenda foi recebida com sucesso.')
            ->line('Pode ver a sua encomenda no link abaixo.')
            ->action('Ver Encomenda', $url )
            ->line('Aguardamos pagamento.')
            ->line('Obrigado por nos escolher para comprar as suas tshirts!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
