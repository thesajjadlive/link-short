<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['links']]);
    }
    public function shorten(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);
        $app_url = config('app.url');
        $existingUrl = Link::where('original_url', $request->url)->first();
        if ($existingUrl) {
            return response()->json([
                'short_url' => $app_url.$existingUrl->short_url,
            ]);
        }
        $auth_user = auth('api')->user();
        $shortCode = Str::random(8);
        $url = Link::create([
            'original_url' => $request->input('url'),
            'short_url' => $shortCode,
            'user_id' => $auth_user->id??null,
            'click_count' => 0
        ]);

        return response()->json([
            'short_url' => $app_url.$shortCode,
        ]);
    }

    public function redirect($shortCode)
    {
        $url = Link::where('short_url', $shortCode)->firstOrFail();
        $url->increment('click_count');
        return redirect($url->original_url);
    }

    public function links()
    {
        $auth_user = auth('api')->user();
        $links = Link::where('user_id', $auth_user->id)->latest()->get();
        return $this->sendResponse($links, 'Data fetched successfully');
    }

}