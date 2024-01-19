<?php

namespace App\Providers;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {

            // // First we register a custom navigation group
            // Filament::registerNavigationGroups(
            //     [
            //         NavigationGroup::make()
            //             ->label('Shop')
            //             ->collapsed(),
            //     ]
            // );

            // Then we register the links that will go into that navigation group
            Filament::registerNavigationItems(
                [
                    NavigationItem::make('Chat Messages')
                        ->url('/user-messages', shouldOpenInNewTab: false)
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->sort(1),
                ]
            );
        });
    }
}
