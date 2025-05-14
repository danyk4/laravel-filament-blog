<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(): View
    {
        // Latest post
        $latestPost = Post::query()
            ->where('active', '=', 1)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

        // Popular posts based on views
        $popularPosts = Post::query()
            ->withCount('views')
            ->where('active', '=', 1)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('views_count', 'desc')
            ->limit(3)
            ->get();

        // Recent categories with latest posts
        $recentCategories = Category::query()
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(3)
            ->get();

        // $posts = Post::query()
        //     ->where('active', '=', 1)
        //     ->whereDate('published_at', '<=', Carbon::now())
        //     ->orderBy('published_at', 'desc')
        //     ->paginate(10);

        return view('home', compact('latestPost', 'popularPosts', 'recentCategories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request): View
    {
        if (! $post->active || $post->published_at > Carbon::now()) {
            throw new NotFoundHttpException('Post not found');
        }

        $next = Post::query()
            ->where('active', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->where('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

        $prev = Post::query()
            ->where('active', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->where('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();

        $post->incrementUniqueView($request->ip(), $request->userAgent());

        return view('posts.show', compact('post', 'next', 'prev'));
    }

    public function byCategory(Category $category): View
    {
        // $posts = Post::query()
        //     ->join('category_post', 'posts.id', '=', 'category_post.post_id')
        //     ->where('category_post.category_id', '=', $category->id)
        //     ->where('active', '=', true)
        //     ->whereDate('published_at', '<=', Carbon::now())
        //     ->orderBy('published_at', 'desc')
        //     ->paginate(10);

        $posts = $category->exists() ?
                $category->posts()
                    ->where('active', true)
                    ->whereDate('published_at', '<=', Carbon::now())
                    ->orderBy('published_at', 'desc')
                    ->paginate(10) :
                [];

        return view('posts.index', compact('posts', 'category'));
    }

    public function search(Request $request): View
    {
        $s = $request->get('s');
        $posts = Post::query()
            ->where('active', '=', 1)
            ->whereDate('published_at', '<=', Carbon::now())
            ->where(function ($query) use ($s) {
                $query->where('title', 'like', "%$s%")
                    ->orWhere('body', 'like', "%$s%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('posts.search', compact('posts'));
    }
}
