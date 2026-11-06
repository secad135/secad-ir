<?php

namespace App\Filament\Admin\Resources\Notes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class NotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('عنوان')
                    ->formatStateUsing(fn ($record) => $record->title ?? 'یادداشت #' . $record->id)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('body')
                    ->label('متن')
                    ->limit(60)
                    ->formatStateUsing(fn ($state) => strip_tags($state)),

                IconColumn::make('is_published')
                    ->label('منتشر شده')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->label('تاریخ انتشار')
                    ->dateTime('Y-m-d')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('ساخته شده')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('وضعیت انتشار'),
            ])
            ->defaultSort('created_at', 'desc')
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