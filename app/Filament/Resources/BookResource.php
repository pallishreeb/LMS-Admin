<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Book Mangement';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('title')->autofocus()->required(),
                Components\Textarea::make('description')->label('Description'),
                Components\TextInput::make('language')->label('Language'),
                Components\TextInput::make('price')->label('Price'),
                Components\FileUpload::make('cover_pic')->image(),
                Components\FileUpload::make('pdf_book')->label('PDF Book')->maxSize('512000'),
                Components\TextInput::make('pages')->label('Pages'),
                Components\Select::make('category_id')
                ->label('Category')->relationship('category', 'name')->required(),
                        
            ]);  
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\ImageColumn::make('cover_pic'),
                Tables\Columns\TextColumn::make('language'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('category.name')->searchable(),
                Tables\Columns\TextColumn::make('pages'),
                Tables\Columns\CheckboxColumn::make('is_published')->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
