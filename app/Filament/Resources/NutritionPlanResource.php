<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NutritionPlanResource\Pages;
use App\Filament\Resources\NutritionPlanResource\RelationManagers;
use App\Models\NutritionPlan;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NutritionPlanResource extends Resource
{
    protected static ?string $model = NutritionPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label('User')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('calories')
                ->label('Calories')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('protein')
                ->label('Protein (g)')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('carbs')
                ->label('Carbs (g)')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('fats')
                ->label('Fats (g)')
                ->numeric()
                ->required(),
            Forms\Components\Textarea::make('notes')
                ->label('Notes')
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('User Name') // اسم المستخدم
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('calories')
                ->label('Calories') // السعرات الحرارية
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('protein')
                ->label('Protein (g)') // البروتين بالجرام
                ->sortable(),
            Tables\Columns\TextColumn::make('carbs')
                ->label('Carbs (g)') // الكربوهيدرات بالجرام
                ->sortable(),
            Tables\Columns\TextColumn::make('fats')
                ->label('Fats (g)') // الدهون بالجرام
                ->sortable(),
            Tables\Columns\TextColumn::make('notes')
                ->label('Notes') // الملاحظات
                ->limit(50),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At') // تاريخ الإنشاء
                ->dateTime('M d, Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListNutritionPlans::route('/'),
            'create' => Pages\CreateNutritionPlan::route('/create'),
            'edit' => Pages\EditNutritionPlan::route('/{record}/edit'),
        ];
    }
}
