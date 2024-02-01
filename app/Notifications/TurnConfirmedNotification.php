<?php

namespace App\Notifications;

use App\Models\Turn;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TurnConfirmedNotification extends Notification
{
    use Queueable;
    protected $name;
    protected $doctor_name;
    protected $day;
    protected $start_hour;
    protected $end_hour;
    /**
     * Create a new notification instance.
     */
    public function __construct(Turn $turn)
    {
        $this->name = $turn->users->full_name;
        $this->doctor_name = auth()->user()->full_name;
        $this->day = $turn->times->day;
        $this->start_hour = $turn->times->start_hours;
        $this->end_hour = $turn->times->end_hours;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Dear ' . $this->name . ' Your Turn With Doctor ' . $this->doctor_name .
                ' In Day ' . $this->day . ' In Hours ' . $this->start_hour . ' : ' . $this->end_hour .
                ' Is Confirmed.'
        ];
    }
}
