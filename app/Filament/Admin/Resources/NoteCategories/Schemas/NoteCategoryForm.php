<?php

namespace App\Filament\Admin\Resources\NoteCategories\Schemas;

use App\Models\NoteCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NoteCategoryForm
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
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('توضیح')
                    ->rows(2)
                    ->columnSpanFull(),

                Select::make('parent_id')
                    ->label('دسته والد')
                    ->options(fn ($record) => NoteCategory::query()
                        ->when($record, fn ($q) => $q->where('id', '!=', $record->id))
                        ->orderBy('title')
                        ->pluck('title', 'id')
                        ->prepend('— بدون والد (سطح اول) —', ''))
                    ->searchable()
                    ->nullable(),

                TextInput::make('sort_order')
                    ->label('ترتیب')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
