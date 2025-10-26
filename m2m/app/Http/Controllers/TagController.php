<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $per = min($request->integer('per_page', 20), 100);
        return Tag::query()->orderBy('name')->paginate($per);
    }



    public function store(StoreTagRequest $request)
    {
        $data = $request->validated();
        $tag = Tag::create($data);

        return response()->json($tag->id, 201);
    }
}
