<?php

namespace App\Filament\Admin\Resources\NoteCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NoteCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('عنوان')->searchable()->sortable(),
                TextColumn::make('parent.title')->label('والد')->placeholder('—')->sortable(),
                TextColumn::make('slug')->label('نامک')->toggleable(),
                TextColumn::make('notes_count')->counts('notes')->label('تعداد یادداشت‌ها'),
                TextColumn::make('sort_order')->label('ترتیب')->sortable(),
                IconColumn::make('children_count')->label('زیردسته')->counts('children')->boolean(),
            ])
            ->filters([
                SelectFilter::make('parent_id')
                    ->label('والد')
                    ->relationship('parent', 'title'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
