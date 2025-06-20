<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        return view('posts.index');
    }

    public function fetch() {
        return response()->json(Post::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::create($validated);

        return response()->json($post, 201); // 201 Created
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);

        return response()->json($post);
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
