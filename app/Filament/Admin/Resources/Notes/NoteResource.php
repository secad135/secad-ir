<?php

namespace App\Filament\Admin\Resources\Notes;

use App\Filament\Admin\Resources\Notes\Pages\CreateNote;
use App\Filament\Admin\Resources\Notes\Pages\EditNote;
use App\Filament\Admin\Resources\Notes\Pages\ListNotes;
use App\Filament\Admin\Resources\Notes\Schemas\NoteForm;
use App\Filament\Admin\Resources\Notes\Tables\NotesTable;
use App\Models\Note;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NoteResource extends Resource
{
    protected static ?string $modelLabel = 'یادداشت';
    protected static ?string $pluralModelLabel = 'یادداشت‌ها';
    protected static ?string $navigationLabel = 'یادداشت‌ها';
    protected static ?int $navigationSort = 3;
    protected static ?string $model = Note::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return NoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NotesTable::configure($table);
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
            'index' => ListNotes::route('/'),
            'create' => CreateNote::route('/create'),
            'edit' => EditNote::route('/{record}/edit'),
        ];
    }
}
