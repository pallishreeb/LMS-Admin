<?php

namespace App\Filament\Widgets\Dashboard;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Category;
use App\Models\Book;
use App\Models\Course;
class ResourceOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Categories', Category::count()),
            Card::make('Total Books',Book::count()),
            Card::make('Total Courses',Course::count()),
        ];
    }
}
