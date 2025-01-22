<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    // Ikon dan Grup Navigasi
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Ikon menu

    // Formulir untuk Tambah/Edit
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk Name
                Forms\Components\TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state)); // Membuat slug otomatis setiap kali `name` berubah
                    }),

                // Field untuk Slug
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(Category::class, 'slug') // Slug harus unik
                    ->disabled() // Nonaktifkan input manual
                    ->dehydrated(fn ($state) => !empty($state)), // Pastikan slug disimpan ke database meskipun disabled
            ]);
    }

    // Tabel untuk Menampilkan Data
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom Nama Kategori
                Tables\Columns\TextColumn::make('name')
                    ->label('Category Name')
                    ->sortable()
                    ->searchable(),

                // Kolom Slug
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),

                // Kolom Tanggal Dibuat
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // Relasi (Jika Ada)
    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),  // Mengarahkan ke halaman daftar kategori
            'create' => Pages\CreateCategory::route('/create'), // Mengarahkan ke halaman create kategori
            'edit' => Pages\EditCategory::route('/{record}/edit'), // Mengarahkan ke halaman edit kategori
        ];
    }
}
