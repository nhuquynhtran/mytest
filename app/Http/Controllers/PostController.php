<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Carbon\Carbon;

class PostController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id','=',Auth::user()->id)
            ->orderBy('publish_time','asc')
            ->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string',
        ]);
        $validatedData['user_id'] = $user->id;
        $post = Post::create($validatedData);
   
        return redirect('/posts')->with('success', 'Post is successfully saved. Please wait for admin approval!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('status','=',1)
            ->where('id','=',$id)
            ->first();
        return view('posts.detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string'
        ]);
        Post::whereId($id)->update($validatedData);

        return redirect('/posts')->with('success', 'Post is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post is successfully deleted');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function content_manager()
    {
        $posts = Post::orderBy('created_at','asc')
            ->get();
        return view('posts.content_manager', compact('posts'));
    }

    /**
     * Publish the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $post = Post::findOrFail($id);
        if ($post->status==1) {
            $validatedData = array('status' => 0);
        } else {
            $validatedData = array('status' => 1);
        }
        $validatedData['publish_time']  = Carbon::now();
        Post::whereId($id)->update($validatedData);
        $apiFormat = array('status' => true, 'message' => 'Post is successfully change publish status');
        return response()->json($apiFormat);
    }

    /**
     * Filter resource .
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, Post $post)
    {
        $post = $post->newQuery();

        if ($request->has('created_at') && $request->input('created_at')) {
            $post = $post->where('created_at', 'LIKE', $request->input('created_at'). '%');
        }

        // Search for a post based on status.
        if ($request->has('status') && $request->input('status') !=='all') {
            $post = $post->where('status', $request->input('status'));
        }

        // order by
        if ($request->has('order_by')) {
            $post = $post->orderBy($request->input('order_by'),'desc');
        }
        $posts = $post->get();
        return view('posts.content_manager', compact('posts'));
    }
    /**
     * auto publish the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auto_publish($id, Request $request)
    {
        $validatedData = $request->validate([
            'publish_time' => 'required|date|date_format:Y-m-d h:i:s'
        ]);
        $post = Post::findOrFail($id);
        $validatedData = array('auto_publish' => 1);
        $validatedData['publish_time']  = $request->input('publish_time');
        Post::whereId($id)->update($validatedData);
        return redirect('admin/content_manager')->with('success', 'Post is successfully setting auto publish status');
    }
}
