<?php

namespace App\Notifications;

use App\Channels\Messages\WhatsAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\WhatsAppChannel;
use App\Models\Booking;
use URL;


class OrderProcessed extends Notification
{
  use Queueable;


  public $booking;
  
  public function __construct(Booking $booking)
  {
    $this->booking = $booking;
  }
  
  public function via($notifiable)
  {
    return [WhatsAppChannel::class];
  }
  
  public function toWhatsApp($notifiable)
  {
    
    $deliveryDate = $this->booking->created_at->toFormattedDateString();


    return (new WhatsAppMessage)
        ->content("Your service request of {$this->booking->s_name} has been approved.");
  }
}
