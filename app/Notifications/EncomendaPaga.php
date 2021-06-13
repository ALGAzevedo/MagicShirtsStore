<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EncomendaPaga extends Notification implements ShouldQueue
{
    use Queueable;

    private $encomenda;
    private $userID;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($value, $utilizador)
    {
        $this->encomenda = $value;
        $this->userID = $utilizador;
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
        $url = url('cliente/encomendas/' . $this->encomenda->id);
        $user = User::findOrFail($this->userID);
        return (new MailMessage)
            ->greeting('Olá, ' . $user->name . "!")
            ->line('Recebemos o pagamento da sua encomenda que irá receber a nossa maior atenção.')
            ->line('Assim que a enviarmos voltaremos a enviar um email a informá-lo.')
            ->line('Pode ver a sua encomenda no link abaixo.')
            ->action('Ver Encomenda', $url)
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
