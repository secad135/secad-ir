<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان مقاله')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('نامک (Slug)')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                Textarea::make('excerpt')
                    ->label('خلاصه')
                    ->rows(2)
                    ->maxLength(500)
                    ->helperText('برای نمایش در کارت فهرست بلاگ')
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('متن مقاله')
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('منتشر شده')
                    ->default(true),

                DateTimePicker::make('published_at')
                    ->label('تاریخ انتشار'),
            ]);
    }
}