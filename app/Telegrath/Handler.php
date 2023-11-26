<?php

namespace App\Telegrath;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Stringable;

/**
 * @method message(string $string)
 */
class Handler extends WebhookHandler
{
    private $telegraphBot;
    protected $telegraphCurrentChat;

    public function __construct(TelegraphBot $telegraphBot)
    {
        $this->telegraphBot = TelegraphBot::find(1);
    }

    public function conf($inputPassword)
    {
        $adminChat = DB::table('active_chats')->where('is_chat_active', true)->first();
        $adminPassword = Config::get('telegraph.admin_password', 'default_password');
        $chatId = $this->request->message['from']['id'];
        $this->setTelegraphCurrentChat($chatId);


        /** @var TelegraphChat $chat */
        $chat = TelegraphChat::where('chat_id', $chatId)->first();
        if ($adminChat->chat_id == $chatId) {
            $this->reply(print_r('$chatId' . $chatId, true));
            $this->reply('This chat is already the admin chat.');
            return;
        } else {
            $this->reply('You are not admin of this bot');

            try {
                if (!$chat) {
                    /** @var TelegraphChat $chat */
                    $chat = $this->telegraphBot->chats()->create([
                        'chat_id' => $chatId,
                        'name' => 'guest',
                    ]);
                    $this->reply('Create new guest chat: ' . $chat->chat_id);
                } else {
                    $response = $chat->message(__('Please enter your password'))
                        ->send();

                }
            } catch (\Exception $e) {
                $this->reply(print_r('Error: ' . $e->getMessage(), true));
            }
        }
    }

    /**
     * @param mixed $telegraphCurrentChat
     */
    public function setTelegraphCurrentChat($telegraphCurrentChat): void
    {
        $this->telegraphCurrentChat = $telegraphCurrentChat;
    }

    /**
     * @return mixed
     */
    public function getTelegraphCurrentChat()
    {
        return $this->telegraphCurrentChat;
    }

    protected function handleChatMessage(Stringable $text): void
    {
        $adminPassword = Config::get('telegraph.admin_password', 'default_password');
        $this->chat->html("Admin pass: $adminPassword")->send();
        $senderId = $this->message->from()->id();
        $this->reply('$senderId: ' . $senderId);

        if ($text == $adminPassword) {
            $adminPassword = null;
            $this->reply('handleChatMessage: Correct password. Access allow.');
            $this->confirm_change_admin($senderId);
        } else if ($text == 'YES') {
            $this->reply('Chat will be registered as admin.');
            $this->change_admin();
        } else {
            $this->reply('Incorrect password. Access denied.');
        }


    }

    public function change_admin()
    {
        $senderId = $this->message->from()->id();
        $this->reply('Changing admin chat to: ' . $senderId);

        $currentAdminChat = DB::table('active_chats')->where('is_chat_active', true)->first();

        if ($currentAdminChat) {
            DB::table('active_chats')
                ->where('chat_id', $currentAdminChat->chat_id)
                ->update(['is_chat_active' => false]);

            $this->reply('Previous admin chat ' . $currentAdminChat->chat_id . ' demoted.');
        }

        DB::table('active_chats')
            ->updateOrInsert(
                ['chat_id' => $senderId],
                ['is_chat_active' => true]
            );

        $this->reply('New admin chat ' . $senderId . ' promoted.');

    }

    public function confirm_change_admin($chatId): void
    {
        $this->reply('confirm_change_admin');

        try {
            $chat = TelegraphChat::where('chat_id', $chatId)->first();

            $response = $chat->message(__('Please confirm change admin chat!Type - YES'))
                ->send();
        } catch (\Exception $e) {
            $this->reply(print_r('Error: ' . $e->getMessage(), true));
        }

    }
}

