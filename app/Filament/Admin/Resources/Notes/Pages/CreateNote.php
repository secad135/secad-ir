<?php

namespace App\Filament\Admin\Resources\Notes\Pages;

use App\Filament\Admin\Resources\Notes\NoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNote extends CreateRecord
{
    protected static string $resource = NoteResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->combineImageData($data);
    }

    private function combineImageData(array $data): array
    {
        $source = $data['image_source'] ?? 'none';

        if ($source === 'url') {
            $data['featured_image'] = $data['featured_image_url_input'] ?? null;
        } elseif ($source === 'none') {
            $data['featured_image'] = null;
        }

        unset($data['image_source'], $data['featured_image_url_input']);

        return $data;
    }
}
