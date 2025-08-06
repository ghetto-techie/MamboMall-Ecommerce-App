<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    // protected static ?string $navigationGroup = 'Shop';
    // protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Discount Coupon';
    protected static ?string $pluralModelLabel = 'Discount Coupons';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(50)
                            ->columnSpan(1),
                        
                        Forms\Components\Select::make('type')
                            ->options([
                                'fixed' => 'Fixed Amount',
                                'percent' => 'Percentage Discount',
                            ])
                            ->required()
                            ->live()
                            ->columnSpan(1),
                    ]),
                
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix(fn (Forms\Get $get) => 
                                $get('type') === 'fixed' ? 'Ksh' : null
                            )
                            ->suffix(fn (Forms\Get $get) => 
                                $get('type') === 'percent' ? '%' : null
                            )
                            ->columnSpan(1),
                            
                        Forms\Components\TextInput::make('min_order')
                            ->label('Minimum Order')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Ksh')
                            ->nullable()
                            ->columnSpan(1),
                    ]),
                
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('max_discount')
                            ->label('Maximum Discount')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Ksh')
                            ->nullable()
                            ->hidden(fn (Forms\Get $get) => $get('type') !== 'percent')
                            ->columnSpan(1),
                            
                        Forms\Components\TextInput::make('usage_limit')
                            ->numeric()
                            ->minValue(1)
                            ->nullable()
                            ->helperText('Leave empty for unlimited uses')
                            ->columnSpan(1),
                    ]),
                
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->required()
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->closeOnDateSelection()
                            ->columnSpan(1),
                            
                        Forms\Components\DatePicker::make('end_date')
                            ->required()
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->closeOnDateSelection()
                            ->after('start_date')
                            ->columnSpan(1),
                    ]),
                
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false)
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Coupon $record) => 
                        $record->is_active ? 'Active' : 'Inactive',
                    ),
                    
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fixed' => 'success',
                        'percent' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => 
                        $state === 'fixed' ? 'Fixed Amount' : 'Percentage'
                    ),
                    
                Tables\Columns\TextColumn::make('value')
                    ->formatStateUsing(fn (string $state, Coupon $record): string => 
                        $record->type === 'fixed' ? 
                        'Ksh ' . number_format($state, 2) : 
                        $state . '%'
                    )
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('min_order')
                    ->formatStateUsing(fn ($state) => 
                        $state ? 'Ksh ' . number_format($state, 2) : 'None'
                    )
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('max_discount')
                    ->formatStateUsing(fn ($state) => 
                        $state ? 'Ksh ' . number_format($state, 2) : 'None'
                    )
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('used_count')
                    ->badge()
                    ->color(fn (int $state): string => 
                        $state > 0 ? 'warning' : 'gray'
                    )
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('usage_limit')
                    ->formatStateUsing(fn ($state) => 
                        $state ?: '∞'
                    )
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('validity')
                    ->state(function (Coupon $record) {
                        $start = $record->start_date->format('d M');
                        $end = $record->end_date->format('d M Y');
                        return "{$start} - {$end}";
                    })
                    ->badge()
                    ->color(fn (Coupon $record) => 
                        $record->end_date->isPast() ? 'danger' : 'success'
                    ),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => 
                        $query->where('is_active', true)
                    ),
                    
                Tables\Filters\Filter::make('expired')
                    ->label('Expired Coupons')
                    ->query(fn (Builder $query): Builder => 
                        $query->whereDate('end_date', '<', now())
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->successNotificationTitle('Coupon updated'),
                    
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->successNotificationTitle('Coupon deleted'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('end_date', 'desc')
            ->groups([
                Tables\Grouping\Group::make('is_active')
                    ->label('Status')
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}