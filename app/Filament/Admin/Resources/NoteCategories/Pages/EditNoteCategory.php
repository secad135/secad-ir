<?php

namespace App\Filament\Admin\Resources\NoteCategories\Pages;

use App\Filament\Admin\Resources\NoteCategories\NoteCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNoteCategory extends EditRecord
{
    protected static string $resource = NoteCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
