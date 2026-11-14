<?php

namespace App\Filament\Admin\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('نامک (Slug)')
                    ->helperText('اختیاری. اگر خالی بماند، از شناسه عددی استفاده می‌شود.')
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

                Textarea::make('excerpt')
                    ->label('خلاصه')
                    ->rows(2)
                    ->maxLength(500)
                    ->helperText('برای نمایش در کارت فهرست نمونه‌کارها')
                    ->columnSpanFull(),

                RichEditor::make('body')
                    ->label('توضیح کامل')
                    ->columnSpanFull(),

                TextInput::make('client')
                    ->label('کارفرما')
                    ->maxLength(255),

                TextInput::make('url')
                    ->label('لینک پروژه')
                    ->url()
                    ->maxLength(255),

                TagsInput::make('tech_stack')
                    ->label('تکنولوژی‌ها')
                    ->helperText('بعد از هر تکنولوژی Enter بزن')
                    ->columnSpanFull(),

                Toggle::make('featured')
                    ->label('نمایش در صفحه اصلی')
                    ->default(false),

                TextInput::make('sort_order')
                    ->label('ترتیب نمایش')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_published')
                    ->label('منتشر شده')
                    ->default(true),

                DateTimePicker::make('published_at')
                    ->label('تاریخ انتشار')
                    ->helperText('اگر خالی باشد، از تاریخ ساخت استفاده می‌شود.'),
            ]);
    }
}
