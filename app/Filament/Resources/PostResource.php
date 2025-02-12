<?php

namespace App\Filament\Resources;

use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'Post';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->unique(ignoreRecord: true) // Mengabaikan unique untuk edit
                    ->maxLength(255)
                    ->required()
                    ->reactive()

                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->disabled(),

                TinyEditor::make('content')
                    ->nullable()
                    ->required(),


                TinyEditor::make('excerpt')
                    ->nullable()
                    ->required(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('thumbnails')
                    ->visibility('public')
                    ->nullable(),

                Forms\Components\Select::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),


                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                     ->required(),


                Forms\Components\SpatieTagsInput::make('name')
                    ->label('Tags')
                    ->nullable(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->nullable(),

                Forms\Components\Toggle::make('is_published')
                    ->label('Published')
                    ->default(false), // Tetap bisa diubah kapan saja

                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->id()),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public') // Gunakan disk 'public'
                    ->getStateUsing(fn($record) => asset('storage/' . $record->thumbnail)),
                Tables\Columns\TextColumn::make('author.name')->label('Author'),
                Tables\Columns\ImageColumn::make('author.photo')
                ->label('Author Photo')
                ->disk('public')  // Pastikan disk yang digunakan adalah 'public'
                ->getStateUsing(fn($record) => asset('storage/' . $record->author->photo)),
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\SpatieTagsColumn::make('name')->label('Tags'),
                Tables\Columns\TextColumn::make('excerpt')  // Add this line to display the excerpt
                    ->label('Excerpt')
                    ->limit(20),
                Tables\Columns\TextColumn::make('is_published')
                    ->label('Published')
                    ->getStateUsing(fn($record) => $record->is_published == 1 ? 'Publish' : 'No Publish')
                    ->color(fn($record) => $record->is_published == 1 ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('published_at')->dateTime(),
                Tables\Columns\TextColumn::make('visits'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
