<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationSubmitController extends Controller
{
    public function submit(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        //
        return response()->json($data);
    }
}
