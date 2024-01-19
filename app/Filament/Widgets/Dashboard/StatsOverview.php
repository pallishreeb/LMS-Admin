<?php

namespace App\Filament\Widgets\Dashboard;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Category;
use App\Models\Book;
use App\Models\Course;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getCards(): array
    {
        return [
            Card::make('Users', User::count()),


        ];
    }
}
