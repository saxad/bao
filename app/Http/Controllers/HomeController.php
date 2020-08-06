<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schema\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postes = Post::getPosts();
        return view('home',compact('postes'));
    }

    public function showPosts(){

        return json_encode(Post::getPosts());
    }

    public function showDepartures(Request $request)
    {
        
        $poste = $request->poste;
        return Post::getDepartue($poste);
    }
}
