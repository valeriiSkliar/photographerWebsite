<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        $number = 5;
        $data = $request->merge(['some_data' => 'merge data to request']);
        return view('test', compact('number', 'data'));
    }
}
