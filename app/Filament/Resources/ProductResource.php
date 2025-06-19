<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Actions\Action;
use Filament\Notifications\Collection;
use Filament\Support\Enums\ActionSize;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 4; // Position in the Filament sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Product Information')
                            ->schema([
                                TextInput::make('name')
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                        $set('slug', Str::slug($state));
                                    })
                                    ->required(),

                                TextInput::make('slug')
                                    ->maxLength(255)
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Product::class, 'slug', ignoreRecord: true),

                                Forms\Components\MarkdownEditor::make('description')
                                    ->fileAttachmentsDirectory('products')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Section::make('Product Images')
                            ->schema([
                                FileUpload::make('images')
                                    ->multiple()
                                    ->directory('products')
                                    ->maxFiles(5)
                                    ->reorderable()
                                    ->image()
                                    ->imageEditor()
                                    ->columnSpanFull()
                            ]),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Pricing')
                            ->schema([
                                TextInput::make('price')
                                    ->label('Price')
                                    ->prefix('KES')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0)
                                    ->maxValue(999999.99),
                            ]),

                        Section::make('Category & Brand')
                            ->schema([
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),
                                        TextInput::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required(),
                                        FileUpload::make('image')
                                            ->image()
                                            ->directory('categories'),
                                        Toggle::make('is_active')
                                            ->default(true),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                        $category = Category::create($data);
                                        return $category->id;
                                    })
                                    ->createOptionAction(
                                        fn(Action $action) => $action
                                            ->modalHeading('Create New Category')
                                            ->modalSubmitActionLabel('Save Category')
                                            ->size(ActionSize::Small)
                                    ),

                                Select::make('brand_id')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),
                                        TextInput::make('slug')
                                            ->disabled()
                                            ->dehydrated()
                                            ->required(),
                                        FileUpload::make('logo')
                                            ->image()
                                            ->directory('brands'),
                                        Toggle::make('is_active')
                                            ->default(true),
                                    ])
                                    ->createOptionUsing(function (array $data) {
                                        $brand = Brand::create($data);
                                        return $brand->id;
                                    })
                                    ->createOptionAction(
                                        fn(Action $action) => $action
                                            ->modalHeading('Create New Brand')
                                            ->modalSubmitActionLabel('Save Brand')
                                            ->size(ActionSize::Small)
                                    ),
                            ]),

                        Section::make('Status Flags')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true)
                                    ->required(),

                                Toggle::make('in_stock')
                                    ->label('In Stock')
                                    ->default(true)
                                    ->required(),

                                Toggle::make('is_featured')
                                    ->label('Featured')
                                    ->required(),

                                Toggle::make('on_sale')
                                    ->label('On Sale')
                                    ->required(),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\ImageColumn::make('images')
                    ->stacked()
                    ->limit(1)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Product $record) => $record->slug)
                    ->wrap(),

                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('brand.name')
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('price')
                    ->money('KES')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('in_stock')
                    ->label('Stock')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\IconColumn::make('on_sale')
                    ->label('Sale')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),

                Tables\Filters\TernaryFilter::make('in_stock')
                    ->label('In Stock'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured'),

                Tables\Filters\TernaryFilter::make('on_sale')
                    ->label('On Sale'),

                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Product Category')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('brand_id')
                    ->relationship('brand', 'name')
                    ->label('Brand')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn(Collection $records) => $records->each->update(['is_active' => true])),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn(Collection $records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Add relations if needed
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'description'];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => $record->category?->name,
            'Brand' => $record->brand?->name,
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): ?string
    {
        return static::getUrl('edit', ['record' => $record]);
    }

    public static function getGlobalSearchResultImage(Model $record): ?string
    {
        // Assuming 'images' is an array or a single image path
        if (is_array($record->images)) {
            return $record->images[0] ?? null;
        }
        return $record->images;
    }
}       
