<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationSubmitController extends Controller
{
    public function submit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
         $headers ='From: starovman@ukr.net' . "\r\n" .
		'Reply-To: papapolinki@gmail.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
         $strData = implode(';/n',$data);
        mail('starovman@ukr.net', 'order', $strData, $headers);
        return response()->json($data);
    }
}
