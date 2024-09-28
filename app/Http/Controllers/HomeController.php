<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $links = Link::where('user_id', $user->id)->latest()->get();
        $data['total_url'] = $links->count();
        $data['total_click'] = $links->sum('click_count');
        $data['click_links'] = $links->where('click_count','!=', 0)->count();
        $data['links'] = $links;

        return view('dashboard',$data);
    }

    public function destroy($id){
        $link = Link::find($id);
        $link->delete();
        session()->flash('success', 'Link deleted successfully');
        return redirect('/dashboard');
    }
}
