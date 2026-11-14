<?php

namespace App\Filament\Admin\Resources\Notes\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
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

                Radio::make('image_source')
                    ->label('منبع عکس شاخص')
                    ->options([
                        'none' => 'بدون عکس (استفاده از پیش‌فرض)',
                        'upload' => 'آپلود فایل',
                        'url' => 'آدرس URL',
                    ])
                    ->default(fn ($record) => $record?->featured_image
                        ? (str_starts_with($record->featured_image, 'http') ? 'url' : 'upload')
                        : 'none')
                    ->live()
                    ->columnSpanFull(),

                FileUpload::make('featured_image')
                    ->label('آپلود عکس')
                    ->image()
                    ->directory('featured')
                    ->disk('public')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->visible(fn (Get $get) => $get('image_source') === 'upload')
                    ->columnSpanFull(),

                TextInput::make('featured_image_url_input')
                    ->label('آدرس URL عکس')
                    ->url()
                    ->placeholder('https://example.com/image.webp')
                    ->visible(fn (Get $get) => $get('image_source') === 'url')
                    ->default(fn ($record) => $record?->featured_image && str_starts_with($record->featured_image, 'http')
                        ? $record->featured_image
                        : null)
                    ->columnSpanFull(),

                CheckboxList::make('noteCategories')
                    ->label('دسته‌ها')
                    ->relationship('noteCategories', 'title')
                    ->searchable()
                    ->columns(2)
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
