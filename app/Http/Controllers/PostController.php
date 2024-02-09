<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $posts = Storage::get('posts.txt');
        // $postcon = explode("\n", $posts);
        // $view_data = [
        //     'posts' => $postcon
        // ];

        // $posts = DB::table('posts')->where('active', true)->get();
        $posts = Post::active()
            // ->withTrashed()
            ->get();
        $view_data = ['posts' => $posts];
        // dd($posts);

        // dd($view_data);
        // ddd($postcon);
        return view('posts.PostIndex', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.PostCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $in = $request->input();
        // $posts = Storage::get('posts.txt');
        // $postcon = explode("\n", $posts);

        // $new_post = [
        //     count($postcon) + 1,
        //     $in['title'],
        //     $in['comment'],
        //     1,
        //     $in['detail'],
        //     date('Y-m-d H:i:s'),
        // ];
        // $new_post = implode(',',$new_post);
        // array_push($postcon, $new_post);
        // $postcon = implode("\n", $postcon);
        // dd($postcon);
        // Storage::write('posts.txt', $postcon);

        $new_post = [
            'title' => $in['title'],
            'content' => $in['content'],
            'bookmark' => true,
            'detail' => $in['detail'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // DB::table('posts')->insert($new_post);
        // Post::insert($new_post);
        Post::create($new_post); // memiliki validasi dalam menambahkan data
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts =  Storage::get('posts.txt');
        // $postcon = explode("\n", $posts);
        // $selected_post = array();
        // foreach ($postcon as $post) {
        //     $post = explode(",", $post);
        //     if ($post[0] == $id) {
        //         $selected_post = $post;
        //     }
        // }
        // $view_data = [
        //     'post' => $selected_post
        // ];

        // $posts = DB::table('posts')
        //         ->where('id', '=', $id)
        //         ->first();
        $posts = Post::where('id', $id)->first();
        $comments = $posts->comments()->get();
        $countComments = $posts->countComments();
        // dd($posts);
        $view_data = ['post' => $posts, 'comments' => $comments, 'countComments' => $countComments];

        return view('posts.PostDetail', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $posts = DB::table('posts')
        //         ->where('id', '=', $id)
        //         ->first();
        $posts = Post::where('id', $id)->first();
        // dd($posts);
        $view_data = ['post' => $posts];

        return view('posts.PostEdit', $view_data);
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
        $in = $request->input();
        $update_post = [
            'title' => $in['title'],
            'content' => $in['content'],
            'detail' => $in['detail'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // DB::table('posts')->where('id', $id)
        // ->update($update_post);
        Post::where('id', $id)->update($update_post);
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::table('posts')->where('id', $id)->delete();
        Post::where('id', $id)->delete();
        return redirect()->route('post.index');
    }
}
