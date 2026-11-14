<?php

namespace App\Filament\Admin\Resources\NoteCategories\Pages;

use App\Filament\Admin\Resources\NoteCategories\NoteCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNoteCategories extends ListRecords
{
    protected static string $resource = NoteCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
