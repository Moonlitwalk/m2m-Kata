<?php

namespace App\Http\Controllers;
use App\Models\{Post, Tag};
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function attach(Post $post, Tag $tag)
    {
        $post->tags()->syncWithoutDetaching([$tag->id]);
        return response()->noContent();
    }




    public function detach(Post $post, Tag $tag)
    {
        $post->tags()->detach([$tag->id]);
        return response()->noContent();
    }
}
