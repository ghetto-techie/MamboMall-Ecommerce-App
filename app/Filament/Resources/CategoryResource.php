<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Category Details')
                    ->description('Organize your product categories')
                    ->icon('heroicon-o-rectangle-group')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Category Name')
                                    ->placeholder('e.g., Electronics, Clothing')
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                        if ($operation === 'create') {
                                            $set('slug', Str::slug($state));
                                        }
                                    })
                                    ->required()
                                    ->columnSpan(2),
                                
                                Forms\Components\TextInput::make('slug')
                                    ->label('URL Slug')
                                    ->placeholder('auto-generated')
                                    ->disabled()
                                    ->hintAction(
                                        Forms\Components\Actions\Action::make('regenerate')
                                            ->icon('heroicon-o-arrow-path')
                                            ->action(function ($state, Set $set, $get) {
                                                $set('slug', Str::slug($get('name')));
                                            })
                                    )
                                    ->maxLength(255)
                                    ->unique(Category::class, 'slug', ignoreRecord: true)
                                    ->dehydrated()
                                    ->required(),
                            ]),
                        
                        Forms\Components\FileUpload::make('image')
                            ->label('Category Image')
                            ->image()
                            ->directory('categories')
                            ->imageEditor()
                            ->imagePreviewHeight('150')
                            ->imageCropAspectRatio('16:9')
                            ->panelLayout('integrated')
                            ->panelAspectRatio('16:9')
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                        
                        Toggle::make('is_active')
                            ->label('Active Status')
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(3)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name', 'asc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-category.png')),
                
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->weight('medium')
                    ->description(fn (Category $record) => $record->slug),
                
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                
                TextColumn::make('products_count')
                    ->label('Products')
                    ->counts('products')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->trueLabel('Active Categories')
                    ->falseLabel('Inactive Categories')
                    ->placeholder('All Categories'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->icon('heroicon-o-eye'),
                    EditAction::make()->icon('heroicon-o-pencil'),
                    DeleteAction::make()->icon('heroicon-o-trash'),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('gray')
                ->button()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('No categories found')
            ->emptyStateDescription('Create your first category')
            ->emptyStateIcon('heroicon-o-tag')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Create Category')
                    ->url(route('filament.admin.resources.categories.create'))
                    ->icon('heroicon-o-plus')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relation manager for products if needed
            // \App\Filament\Resources\CategoryResource\RelationManagers\ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}