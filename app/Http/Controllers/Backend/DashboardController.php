<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Xenon\LaravelBDSms\Facades\SMS;
use Xenon\LaravelBDSms\Provider\Ssl;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('app.dashboard');
        $links = Link::latest()->get();
        $data['total_url'] = $links->count();
        $data['total_click'] = $links->sum('click_count');
        $data['click_links'] = $links->where('click_count','!=', 0)->count();
        $data['links'] = $links;
        $data['user'] = User::where('type','user')->count();

        return view('backend.dashboard',$data);
    }


}
