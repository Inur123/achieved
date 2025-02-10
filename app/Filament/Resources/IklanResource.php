<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IklanResource\Pages;
use App\Filament\Resources\IklanResource\RelationManagers;
use App\Models\Iklan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IklanResource extends Resource
{
    protected static ?string $model = Iklan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Iklan';

    protected static ?string $slug = 'iklan';

    protected static ?string $navigationGroup = 'Ads';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->label('Iklan Name'),

            // Form field for author photo (image upload)
            Forms\Components\FileUpload::make('image')
                ->image()
                ->disk('public')  // Specify the disk for storing the image
                ->label('Iklan Photo')
                ->nullable()
                ->directory('iklans')
                ->optimize('webp'),  // Make the photo optional
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Iklan Name')
                    ->searchable(),

                // Display author photo (with URL from the disk)
                Tables\Columns\ImageColumn::make('image')
                    ->label('Iklan Photo')
                    ->disk('public')  // Ensure it uses the 'public' disk
                    ->getStateUsing(fn($record) => asset('storage/' . $record->image)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListIklans::route('/'),
            'create' => Pages\CreateIklan::route('/create'),
            'edit' => Pages\EditIklan::route('/{record}/edit'),
        ];
    }
}
