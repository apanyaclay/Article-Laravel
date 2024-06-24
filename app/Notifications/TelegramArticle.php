<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;
use League\HTMLToMarkdown\HtmlConverter;

class TelegramArticle extends Notification
{
    use Queueable;
    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the telegram representation of the notification.
     */
    public function toTelegram($notifiable)
    {

        $converter = new HtmlConverter(array('strip_tags' => true));
        $excerptMarkdown = $converter->convert($this->data['excerpt']);
        $imageUrl = 'https://apanyaclay.com/assets/' . $this->data['image'].'';
        return TelegramFile::create()
            ->parseMode('Markdown')
            ->content("*" . $this->data['title'] . "*\n\n" . $excerptMarkdown)
            // ->photo('https://apanyaclay.com/assets/article/gambar-pemandangan-6_1719141661.jpeg')
            ->photo($imageUrl)
            // ->button('View Article', 'http://127.0.0.1:8000/article/' . $this->data['image'])
            ->button('View Article', env('APP_URL').'/article/' . $this->data['slug'])
            ->to(-1002207874457);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->data['title'],
            'slug' => $this->data['slug'],
            'excerpt' => $this->data['excerpt'],
            'image' => $this->data['image'],
        ];
    }
}
