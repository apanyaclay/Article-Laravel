<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\User;
use App\Notifications\TelegramArticle;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramUpdates;
use Telegram\Bot\Actions;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram as FacadesTelegram;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $updates = TelegramUpdates::create()
        //     // Dapatkan maksimal 2 pembaruan
        //     ->limit(2)
        //     // Tambahkan opsi tambahan ke permintaan
        //     ->options([
        //         'timeout' => 0,
        //     ])
        //     ->get();

        // // Periksa apakah permintaan berhasil
        // if ($updates['ok']) {
        //     // Ambil chat ID dari pembaruan pertama
        //     $chatId = $updates['result'][0]['message']['chat']['id'];

        //     // Lakukan sesuatu dengan chat ID
        //     // Misalnya, kirim pesan balasan atau proses lebih lanjut
        //     return response()->json($updates['result']);
        // }

        // return response()->json(['error' => 'Failed to get updates from Telegram'], 500);
        $response = FacadesTelegram::bot('mybot')->getMe();
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        event(new MyEvent($request->name));
        $chatId = -1002207874457;
        // return TelegramFile::create()
        //     ->parseMode('Markdown')
        //     ->content("*" . $this->data['title'] . "*\n\n" . $this->data['excerpt'])
            // ->file('https://user-images.githubusercontent.com/1915268/66616792-daad1c80-ebef-11e9-9bdf-c0bc484cf037.jpg', 'photo')
        //     ->file($this->data['image'], 'photo')
        //     ->button('View Article', 'http://127.0.0.1:8000/article/' . $this->data['slug'])
        //     ->to(-1002207874457);
        // $telegram = new Telegram();
        // $telegram->setToken(config('services.telegram-bot-api.token'));

        // $data = [
        //     'title' => 'New Post',
        //     'message' => 'New post created by ' . $request->name,
        //     'telegram_user_id' => $chatId,
        //     'url' => 'https://apanyaclay.com'
        // ];

        $telegram = [
            'title' => 'New Post',
            'slug' => $request->name,
            'excerpt' => 'New post created by ' . $request->name,
            'image' => 'https://apanyaclay.com/assets/gambar-pemandangan-6.jpeg',
        ];
        $user = User::find(1);
        $user->notify(new TelegramArticle($telegram));
        // $response = FacadesTelegram::sendMessage([
        //     'chat_id' => '@apanyaclaychannel',
        //     'text' => $request->name
        // ]);

        // $messageId = $response->getMessageId();
        // $chatIds = $response->chat->id;
        // $responses = FacadesTelegram::forwardMessage([
        //     'chat_id' => 740297781,
        //     'from_chat_id' => $chatIds,
        //     'message_id' => $messageId
        // ]);

        // FacadesTelegram::sendChatAction([
        //     'chat_id' => 740297781,
        //     'action' => 'upload_photo',
        // ]);

        // FacadesTelegram::sendPhoto([
        //     'chat_id' => '@apanyaclaychannel',
        //     'photo' => 'https://user-images.githubusercontent.com/1915268/66616792-daad1c80-ebef-11e9-9bdf-c0bc484cf037.jpg',
        //     'caption' => $request->name
        // ]);

        // $messageId = $response->getMessageId();
        // $reply_markup = Keyboard::make()
        // ->setResizeKeyboard(true)
        // ->setOneTimeKeyboard(true)
        // ->row([
        //     Keyboard::button('1'),
        //     Keyboard::button('2'),
        //     Keyboard::button('3'),
        // ])
        // ->row([
        //     Keyboard::button('4'),
        //     Keyboard::button('5'),
        //     Keyboard::button('6'),
        // ])
        // ->row([
        //     Keyboard::button('7'),
        //     Keyboard::button('8'),
        //     Keyboard::button('9'),
        // ])
        // ->row([
        //     Keyboard::button('0'),
        // ]);

        // $response = FacadesTelegram::sendMessage([
        //     'chat_id' => '740297781',
        //     'text' => 'Hello World',
        //     'reply_markup' => $reply_markup
        // ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
