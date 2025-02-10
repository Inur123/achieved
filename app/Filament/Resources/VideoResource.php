<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Video';

    protected static ?string $navigationGroup = 'Ads';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('title')
                ->label('Judul Video')
                ->required(),

                Forms\Components\TextInput::make('url')
                    ->label('URL Video (Embed)')
                    ->required()
                    ->placeholder('Masukkan URL YouTube')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Cek apakah URL adalah format standar YouTube
                        if (preg_match('/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([\w-]+)/', $state, $matches)) {
                            $set('url', 'https://www.youtube.com/embed/' . $matches[1]);
                        }
                        // Cek apakah URL adalah format pendek YouTube (youtu.be)
                        elseif (preg_match('/(?:https?:\/\/)?youtu\.be\/([\w-]+)/', $state, $matches)) {
                            $set('url', 'https://www.youtube.com/embed/' . $matches[1]);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Video')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('url Video')
                    ->searchable(),


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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
