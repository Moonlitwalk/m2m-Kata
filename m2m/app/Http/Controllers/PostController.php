<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per = min($request->integer('per_page', 10), 100);

        $q = Post::query()
            ->when($request->bolean('with_tags'), fn($qq) => $qq->with('tags:id,name'))
            ->withCount('tags')
            ->latest();


        return $q->paginate($per);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        return response()->json($post->id, 201);
    }

}