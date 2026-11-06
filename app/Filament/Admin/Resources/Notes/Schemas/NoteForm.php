<?php

namespace App\Filament\Admin\Resources\Notes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان')
                    ->helperText('اختیاری. یادداشت‌های کوتاه می‌توانند بدون عنوان باشند.')
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('نامک (Slug)')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('متن یادداشت')
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