<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Post;
use Parsedown;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('status','=',1)
            ->with(array('user' => function ($query) {
                $query->select(['id', 'name', 'email']);
            }))
            ->orderBy('publish_time','asc')
            ->get();
        //print_r('<pre>');print_r($posts);print_r('<pre>');die;
        return view('posts.home', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $post = Post::where('status','=',1)
            ->where('id','=',$id)
            ->first();
        return view('posts.detail', compact('post'));
    }
}
