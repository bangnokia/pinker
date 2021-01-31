<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinkerController extends Controller
{
    public function index()
    {
        $response = exec("ls -la");

        return view('tinker', [
            'response' => $response
        ]);
    }
}
