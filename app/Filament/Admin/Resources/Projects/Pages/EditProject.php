<?php

namespace App\Filament\Admin\Resources\Projects\Pages;

use App\Filament\Admin\Resources\Projects\ProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $image = $data['featured_image'] ?? null;

        $data['image_source'] = $image
            ? (str_starts_with($image, 'http') ? 'url' : 'upload')
            : 'none';

        $data['featured_image_url_input'] = $image && str_starts_with($image, 'http')
            ? $image
            : null;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
