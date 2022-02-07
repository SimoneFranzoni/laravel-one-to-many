<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    protected $fillable = ['title', 'content', 'slug'];

    //verifica unicità slug    
    public static function generateSlug($title){

        //Genera Slag
        $slug = Str::slug($title);
        //creo slug base almeno posso modificaree lo slug
        $slug_base = $slug;
        
        //verifica se è presente nel db
        //SELECT * FROM posts WWHERE slug = $slug -> first restituisce solo il primo risultato in un oggetto
        $post_presente = Post::where('slug',$slug)->first();

        //se è presente concateno un contatore
        $c = 1;
        while($post_presente){
            $slug = $slug_base . '-' . $c;
            $c++;
            $post_presente = Post::where('slug',$slug)->first();
        }
        
        return $slug;
    }

}
