<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\Contact;

use function Laravel\Prompts\alert;

class ApplicationSubmitController extends Controller
{
    public function getEmail() {
        return Contact::find(1);
    }

    public function submit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
         $strData = implode(';<br>',$data);
        $recipient = $this->getEmail()->email;
        $content = $strData;
         Mail::to($recipient)->send(new TestEmail($content));
         return response()->json($data);
    }
}
