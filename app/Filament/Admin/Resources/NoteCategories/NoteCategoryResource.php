<?php

namespace App\Filament\Admin\Resources\NoteCategories;

use App\Filament\Admin\Resources\NoteCategories\Pages\CreateNoteCategory;
use App\Filament\Admin\Resources\NoteCategories\Pages\EditNoteCategory;
use App\Filament\Admin\Resources\NoteCategories\Pages\ListNoteCategories;
use App\Filament\Admin\Resources\NoteCategories\Schemas\NoteCategoryForm;
use App\Filament\Admin\Resources\NoteCategories\Tables\NoteCategoriesTable;
use App\Models\NoteCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class NoteCategoryResource extends Resource
{
    protected static ?string $modelLabel = 'دسته یادداشت';

    protected static ?string $pluralModelLabel = 'دسته‌های یادداشت';

    protected static ?string $navigationLabel = 'دسته‌های یادداشت';

    protected static ?int $navigationSort = 5;

    protected static ?string $model = NoteCategory::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return NoteCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NoteCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNoteCategories::route('/'),
            'create' => CreateNoteCategory::route('/create'),
            'edit' => EditNoteCategory::route('/{record}/edit'),
        ];
    }
}
