<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\Contact;

use function Laravel\Prompts\alert;

class ApplicationSubmitController extends Controller
{
    public function getEmail()
    {
        return Contact::find(1);
    }

    public function submit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $strData = implode(';<br>', $data);
        $recipient = $this->getEmail()->email;
        $content = $strData;
        Mail::to($recipient)->send(new TestEmail($content));
        $this->sendToTelegram($request);
        return response()->json($data);
    }

    public function sendToTelegram(Request $request)
    {

        $activeChat = DB::table('active_chats')->where('is_chat_active', true)->first();
        $adminChat = \DefStudio\Telegraph\Models\TelegraphChat::where('chat_id', $activeChat->chat_id)->first();
        $data = $request->input('title');
        $adminChat->message($data)->send();
        return response()->json([
            'success' => true,
            'message' => $data
        ]);

    }
}
