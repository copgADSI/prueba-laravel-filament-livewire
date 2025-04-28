<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->rule('regex:/^\d+(\.\d{1,2})?$/')
                    ->prefix('$'),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),

                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList'
                    ])
                    ->nullable(),

                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->integer()
                    ->minValue(0)
                    ->label('Stock'),

                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('products')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->disk('public')
                    ->width(50)
                    ->height(50)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Name'),

                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->searchable()
                    ->label('Category'),

                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->money('usd') // Formatea como dinero
                    ->label('Price'),

                Tables\Columns\TextColumn::make('stock')
                    ->sortable()
                    ->label('Stock'),

                Tables\Columns\BadgeColumn::make('is_out_of_stock')
                    ->label('Status')
                    ->colors([
                        'danger' => fn($record) => $record->stock <= 0,
                        'success' => fn($record) => $record->stock > 0,
                    ])
                    ->getStateUsing(fn($record) => $record->stock <= 0 ? 'Out of Stock' : 'Available'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->searchable()
                    ->preload(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
