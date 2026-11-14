<?php

namespace App\Filament\Admin\Resources\NoteCategories\Pages;

use App\Filament\Admin\Resources\NoteCategories\NoteCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNoteCategory extends CreateRecord
{
    protected static string $resource = NoteCategoryResource::class;
}
