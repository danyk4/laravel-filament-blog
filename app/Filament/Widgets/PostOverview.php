<?php

namespace App\Filament\Widgets;

use App\Models\PostView;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    // protected int | string | array $columnSpan = 3;

    public ?Model $record = null;

    protected function getViewData(): array
    {
        return [
            'viewsCount' => PostView::query()
                ->where('post_id', '=', $this->record->id)
                ->count(),
        ];
    }

    protected static string $view = 'filament.widgets.post-overview';
}
