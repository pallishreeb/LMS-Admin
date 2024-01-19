<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('title')->autofocus()->required(),
                Components\Select::make('category_id')
                ->label('Category')->relationship('category', 'name')->required(),
                Components\Textarea::make('description')->label('Description'),
                Components\TextInput::make('price')->label('Price'),
                Components\FileUpload::make('cover_pic')->image(),
                Components\Section::make()
                ->columns(1)
                ->schema([
                Components\Repeater::make('chapters')
                ->schema([
                    Components\TextInput::make('serial_number')->label('Serial Number'),
                    Components\TextInput::make('title')->autofocus()->required(),
                    Components\Textarea::make('description')->label('Description'),
                    Components\TextInput::make('duration')->autofocus()->required(),      
                    Components\FileUpload::make('video_file')->label('Video File')->maxSize('200000'),
                    Components\FileUpload::make('pdf')->label('PDF Attachment')->maxSize('200000'),
                    Components\Select::make('video_type')
                        ->options([
                            'mov' => 'mov',
                            'mp4' => 'mp4',
                        ])
                        ->required()->label('Video Type'),
                ])->columns(2)
                ])
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\ImageColumn::make('cover_pic'),
                Tables\Columns\TextColumn::make('category.name')->searchable(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
