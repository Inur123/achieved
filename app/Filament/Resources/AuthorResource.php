<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Models\Author;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $modelLabel = 'Author';

    protected static ?string $navigationGroup = 'Blog';





    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form field for author name
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Author Name'),

                // Form field for author photo (image upload)
                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->disk('public')  // Specify the disk for storing the image
                    ->label('Author Photo')
                    ->nullable()
                    ->optimize('webp'),  // Make the photo optional

                // Form field for author description (textarea)
                Forms\Components\Textarea::make('description')
                    ->label('Short Description')
                    ->nullable(),  // Make the description optional
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Author Name')
                    ->searchable(),

                // Display author photo (with URL from the disk)
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->disk('public')  // Ensure it uses the 'public' disk
                    ->getStateUsing(fn($record) => asset('storage/' . $record->photo)), // Access photo URL

                // Display a short description
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50), // Limit the display length for the description

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        if ($record->posts()->exists()) {
                            // Tampilkan Notifikasi di UI Filament
                            Notification::make()
                                ->title('Gagal Menghapus')
                                ->body('Author ini masih digunakan di Post dan tidak bisa dihapus.')
                                ->danger()
                                ->send();

                            // Batalkan penghapusan dengan exception
                            throw ValidationException::withMessages([
                                'delete' => 'Author masih digunakan di Post, penghapusan dibatalkan.'
                            ]);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->before(function ($records) {
                        foreach ($records as $record) {
                            if ($record->posts()->exists()) {
                                // Tampilkan Notifikasi di UI Filament
                                Notification::make()
                                    ->title('Gagal Menghapus Beberapa Author')
                                    ->body('Salah satu Author masih digunakan di Post, penghapusan dibatalkan.')
                                    ->danger()
                                    ->send();

                                // Batalkan bulk delete dengan exception
                                throw ValidationException::withMessages([
                                    'bulk_delete' => 'Salah satu Author masih digunakan di Post, penghapusan dibatalkan.'
                                ]);
                            }
                        }
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Here you can add any related models, if necessary (e.g., if the Author has related posts)
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
