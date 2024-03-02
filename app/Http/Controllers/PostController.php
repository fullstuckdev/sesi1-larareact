<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'app-id' => '65dca3abafdc1b08b5688477'
        ])->get('https://dummyapi.io/data/v1/tag/water/post?limit=10');

        $posts = $response->json()['data'];

        return view('posts.index', compact('posts'));
    }
}
