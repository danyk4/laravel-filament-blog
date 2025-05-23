<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Widgets\PostOverview;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(2048)
                        ->live()
                        ->afterStateUpdated(fn(Set $set, $state) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(2048),
                    Forms\Components\RichEditor::make('body')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('meta_title')
                            ->maxLength(255),
                    Forms\Components\TextInput::make('meta_description')
                        ->maxLength(255),
                    Forms\Components\Toggle::make('active')
                        ->required(),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->required(),
                ])->columnSpan(8),

                Section::make()
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail'),
                    Forms\Components\Select::make('categories')
                        ->multiple()
                        ->relationship('categories', 'title')
                        ->required(),
                ])->columnSpan(4),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(['title', 'body'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('thumbnail'),
                Tables\Columns\ToggleColumn::make('active')->sortable(),
                // ->boolean(),
                // Tables\Columns\TextColumn::make('published_at')
                //     ->dateTime()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('user.name')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultPaginationPageOption(50);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PostOverview::class,
        ];
    }
}
