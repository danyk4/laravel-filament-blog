<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $categories = Category::query()
        //     ->join('category_post', 'categories.id', '=', 'category_post.category_id')
        //     ->select('categories.title', 'categories.slug', DB::raw('count(*) as total'))
        //     ->groupBy([
        //         'categories.title', 'categories.slug',
        //     ])
        //     ->orderByDesc('total')
        //     ->get();

        $categories = Category::query()
            ->select('categories.title', 'categories.slug')
            ->whereHas('posts')
            ->withCount(['posts' => function ($query) {
                $query->where('active', true);
            }])
            ->orderBy('posts_count', 'desc')
            ->get();

        return view('components.sidebar', compact('categories'));
    }
}
