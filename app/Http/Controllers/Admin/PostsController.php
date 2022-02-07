<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prendo tutti i post

        $posts = Post::orderBy('id', 'desc') -> paginate(10);
        return view('admin.posts.index', compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request -> validate(
            [
                //controllo lunghezza stringhe
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Il titolo è un campo obbligatorio',
                'title.max' => 'Il titolo deve essere lungo al massimo :max caratteri',
                'title.min' => 'Il titolo deve essere lungo minimo :min caratteri',
                'content.required' => 'Il contenuto è un campo obbligatorio',
            ]
        );

        // Per controllare se i dati arrivano
        //dd($request->all());
        $data = $request -> all();

        $new_post = new Post();
        $new_post -> fill($data);
        $new_post -> slug = Post::generateSlug($new_post -> title);
        $new_post -> save();
        return redirect() -> route('admin.posts.show', $new_post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        if($post){
            return view('admin.posts.show', compact('post'));
        }
        abort(404, 'E;rrore ricerca del post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // passando id so ha una gestione migliore dell'errore
    public function edit($id)
    {
        $post = Post::find($id);

        if($post){
            return view('admin.posts.edit', compact('post'));
        }
        abort(404, 'Post non presente nel database');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request -> validate(
            [
                //controllo lunghezza stringhe
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Il titolo è un campo obbligatorio',
                'title.max' => 'Il titolo deve essere lungo al massimo :max caratteri',
                'title.min' => 'Il titolo deve essere lungo minimo :min caratteri',
                'content.required' => 'Il contenuto è un campo obbligatorio',
            ]
        );

        $form_data = $request -> all();

        //se cambia il titolo cambio lo slug, altrimenti la funzoine generate slug crea uno slug nuovo anche se non cambio il titolo
        if($form_data['title'] != $post->title){
            $form_data['slug'] = Post::generateSlug($form_data['title']);
        }

        $post -> update($form_data);
        
        //ritorniamo alla show dopo aver modificato
        return redirect()->route('admin.posts.show', $post);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect() -> route('admin.posts.index')->with('deleted', 'Post eliminato correttamente');
    }
}
