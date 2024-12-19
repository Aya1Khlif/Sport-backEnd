<?php

namespace App\Filament\Widgets;

use App\Models\NutritionPlan;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use App\Models\WorkoutSession;

class SportStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'إحصائيات الرياضة';

    protected function getData(): array
    {
        // بيانات الجلسات الرياضية
        $data = WorkoutSession::selectRaw('user_id, count(*) as session_count')
            ->groupBy('user_id')
            ->pluck('session_count', 'user_id');

        // عدد المستخدمين
        $usersCount = User::count();

        // عدد الخطط
        $plansCount = NutritionPlan::count();

        return [
            'labels' => $data->keys()->toArray(), // المفاتيح (user_id) كعلامات
            'datasets' => [
                [
                    'label' => 'عدد الجلسات',
                    'data' => $data->values()->toArray(), // القيم (عدد الجلسات)
                    'backgroundColor' => '#1E40AF',
                ],
                [
                    'label' => 'عدد المستخدمين',
                    'data' => [$usersCount], // يجب أن تكون مصفوفة
                    'backgroundColor' => '#2196F3',
                ],
                [
                    'label' => 'عدد الخطط',
                    'data' => [$plansCount], // يجب أن تكون مصفوفة
                    'backgroundColor' => '#FFC107',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // نوع المخطط
    }
}
