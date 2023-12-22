<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class LangSwitcherController extends Controller
{
   public function setLangInCookies(Request $request) {
       $data = $request->validate([
          'lang' => 'required|string|max:4',
       ]);
       $available_locales = config('app.available_locales');

       if(in_array($data['lang'], $available_locales, true)) {
           return response()->json(Cookie::get('selected_location'))->withCookie('selected_location', $data['lang'], 60*24*365);
       }

       return response()->json("We don't know this lang");
   }
}
