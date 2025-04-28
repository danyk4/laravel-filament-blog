<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\TextWidget;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    public function about(): View
    {
        $widget = TextWidget::query()
            ->where('key', '=', 'about-page')
            ->where('active', '=', true)
            ->first();

        if (!$widget) {
            throw new NotFoundHttpException('Page not found');
        }

        return view('about', ['widget' => $widget]);
    }
}
