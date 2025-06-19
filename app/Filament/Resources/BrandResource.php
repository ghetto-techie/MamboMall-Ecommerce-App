<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
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

class BrandResource extends Resource
{
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $model = Brand::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Brand Details')
                    ->description('Create and manage brand information')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Brand Name')
                                    ->placeholder('e.g., Apple, Samsung')
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
                                    ->unique(Brand::class, 'slug', ignoreRecord: true)
                                    ->dehydrated()
                                    ->required(),
                            ]),
                        
                        Forms\Components\FileUpload::make('image')
                            ->label('Brand Logo')
                            ->image()
                            ->directory('brands')
                            ->imageEditor()
                            ->imagePreviewHeight('150')
                            ->imageCropAspectRatio('1:1')
                            ->panelLayout('integrated')
                            ->panelAspectRatio('1:1')
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
                    ->label('Logo')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-brand.png')),
                
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->weight('medium')
                    ->description(fn (Brand $record) => $record->slug),
                
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
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
                    ->trueLabel('Active Brands')
                    ->falseLabel('Inactive Brands')
                    ->placeholder('All Brands'),
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
            ->emptyStateHeading('No brands found')
            ->emptyStateDescription('Create your first brand')
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Create Brand')
                    ->url(route('filament.admin.resources.brands.create'))
                    ->icon('heroicon-o-plus')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Relation managers
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}