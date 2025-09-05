<?php

namespace App\Providers\Filament;

use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            // ->brandLogo(asset('images/logo.svg')) // Add your logo path
            ->brandLogoHeight('2.5rem')
            // ->favicon(asset('images/favicon.ico'))
            ->colors([
                'primary' => Color::hex('#2563EB'), // More professional blue
                'secondary' => Color::hex('#8B5CF6'), // Sophisticated purple
                'accent' => Color::hex('#EC4899'), // Modern pink accent
                'gray' => Color::Zinc, // Professional neutral
            ])
            ->font('Montserrat', provider: \Filament\FontProviders\GoogleFontProvider::class)
            ->darkMode(true)
            ->spa()
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                OrderStats::class,
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            // ->viteTheme('resources/css/filament/admin/theme.css') // Custom theme
            ->sidebarFullyCollapsibleOnDesktop() // Modern sidebar layout
            ->globalSearchKeyBindings(['command+k', 'ctrl+k']) // Modern search shortcut
            ->navigationGroups([ // Organized menu groups
                'Shop',
                'Inventory',
                'Users',
                'Settings',
            ]);
    }
}
