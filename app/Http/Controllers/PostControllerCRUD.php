<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActualizarPostRequest;
use App\Http\Requests\GuardarPostRequest;

class PostControllerCRUD extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view ('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $user = DB::select('select * from users');
        // $user = DB::select('select * from users where id = ?', [1]);
        // $user = DB::table('users')->where('role', 'admin')->get();
        // dd($user);
        return view('post.create'); // Llama a la vista create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarPostRequest $request)
    {

       echo "estoy en function store() de PostControllerCrud"; 

        echo 'Title'.$request->input('title').'<br>';
        echo 'Title'.$request->title.'<br>';
        echo 'Title'.request('title'); 

        //dd($request); // Desgrana el $request y lo pinta en pantalla

        // Validación de los input del formulario
        // $request->validate([
        // 'title' => 'required|unique:posts|min:5|max:255',
        // ]);

        Post::Create([
            'title' => $request->title,
            'url_clean' => $request->url_clean,
            'content' => $request->content,
            'posted' => 'not',
            'user_id' =>  User::all()->random()->id,
            'category_id' => Category::all()->random()->id
        ]);

        // $post = new Post; 

        // $post->title = $request->title;
        // $post->url_clean = $request->url_clean;  
        // $post->content = $request->content; 
        // $post->posted = 'not'; // Por defecto las publicaciones no están posteadas, requiren de supervisión
        // $post->user_id = User::all()->random()->id; // Para que la FK user_id funcione, elegimos al azar
        // $post->category_id = Category::all()->random()->id; // Para que la FK category_id funcione, elegimos al azar

        // $post->save(); 

        // return back()->with('status', 'Post creado con éxito');
        return redirect()->route('postCRUD.index')->with('status', '<h1>Post creado con éxito</h1>');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     // $post=Post::find($id);
    //     $post=Post::findorfail($id);

    //     return view('post.show', ['post' => $post]);
    // }

    public function show(Post $postCRUD)
    {
        // $post=Post::find($id);
        
        return view('post.show', ['post' => $postCRUD]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $postCRUD)

    {
        return view('post.edit', ['post' => $postCRUD]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActualizarPostRequest $request, Post $postCRUD)
    {
        // $postCRUD->title = $request->title;
        // $postCRUD->url_clean = $request->url_clean;
        // $postCRUD->content = $request->content;

        // $postCRUD->update();

        $postCRUD->update($request->all());

        // return view('post.show', ['post' => $postCRUD]);
        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $postCRUD)
    {
        $postCRUD->delete();
        return back()->with('status', 'Post eliminado con éxito');
    }
}