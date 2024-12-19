<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserProgressResource\Pages;
use App\Filament\Resources\UserProgressResource\RelationManagers;
use App\Models\UserProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserProgressResource extends Resource
{
    protected static ?string $model = UserProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name') // عرض اسم المستخدم
                ->required(),
            Forms\Components\DatePicker::make('date')
                ->label('Date')
                ->required(),
            Forms\Components\TextInput::make('weight')
                ->label('Weight (kg)')
                ->numeric()
                ->nullable(),
            Forms\Components\TextInput::make('body_fat_percentage')
                ->label('Body Fat (%)')
                ->numeric()
                ->step(0.01)
                ->nullable(),
            Forms\Components\Textarea::make('notes')
                ->label('Notes')
                ->rows(4)
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('User')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('date')
                ->label('Date')
                ->date('Y-m-d') // تنسيق التاريخ
                ->sortable(),
            Tables\Columns\TextColumn::make('weight')
                ->label('Weight (kg)')
                ->sortable(),
            Tables\Columns\TextColumn::make('body_fat_percentage')
                ->label('Body Fat (%)')
                ->sortable(),
            Tables\Columns\TextColumn::make('notes')
                ->label('Notes')
                ->limit(30),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime('Y-m-d H:i:s'), // تنسيق التاريخ والوقت
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
            'index' => Pages\ListUserProgress::route('/'),
            'create' => Pages\CreateUserProgress::route('/create'),
            'edit' => Pages\EditUserProgress::route('/{record}/edit'),
        ];
    }
}
