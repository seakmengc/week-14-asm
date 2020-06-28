<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category');
        if (auth()->check()) {
            $request->validate([
                'filter_approved' => 'array',
                'filter_approved.*' => 'boolean',
            ]);

            if ($request->has('filter_approved'))
                $query->whereIn('is_approved', $request->filter_approved);
        } else {
            $query->whereIsApproved(1);
        }

        $posts = $query->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize("create", Post::class);

        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $this->authorize("create", Post::class);

        Post::create($request->validated());

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        // dd($post);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize("update", $post);

        $categories = Category::all();

        return view('posts.edit', compact(['post', 'categories']));
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize("update", $post);

        $post->update($request->validated());

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $this->authorize("delete", $post);

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function ajaxDestroy(Post $post)
    {
        $this->authorize("delete", $post);

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted'
        ]);
    }

    public function ajaxToggleApproved(Post $post)
    {
        $this->authorize('approve', $post);

        $post->is_approved = !$post->is_approved;
        $post->save();

        return response()->json([
            'success' => true,
            'message' => $post->is_approved ? 'Approved' : 'Disapproved'
        ]);
    }
}
