<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Enums\ThemeMode;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile(\App\Filament\Pages\Auth\EditProfile::class)
            ->brandLogo(asset('assets/images/siapindo/logo-porserosi.png'))
            ->brandLogoHeight('3rem')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->font('Poppins')
            ->defaultThemeMode(ThemeMode::Dark)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
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
            ]);
    }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.end',
            fn (): string => Blade::render('
                <script>
                    document.documentElement.classList.add("dark");
                    document.documentElement.classList.remove("light");
                    localStorage.setItem("theme", "dark");
                </script>
                <style>
                    /* Hide theme switcher */
                    .fi-theme-switcher {
                        display: none !important;
                    }

                    /* Premium Dark Space Background */
                    .fi-body {
                        background-color: #06060c !important;
                        background-image: radial-gradient(circle at top right, rgba(245, 158, 11, 0.03), transparent 600px),
                                          radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.03), transparent 600px) !important;
                    }

                    /* Sidebar: Obsidian with sleek borders */
                    .fi-sidebar {
                        background-color: #0c0c16 !important;
                        border-right: 1px solid rgba(255, 255, 255, 0.05) !important;
                    }
                    .fi-sidebar-header {
                        background-color: #0c0c16 !important;
                        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
                    }
                    
                    /* Topbar/Header */
                    .fi-topbar, .fi-topbar-container {
                        background-color: #0c0c16 !important;
                        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
                    }
                    
                    /* Section / Cards / Containers: Luxurious Glassmorphism */
                    .fi-section, 
                    .fi-ta-ctn, 
                    .fi-wi-stats-overview-stat-card,
                    .fi-wi-widget,
                    .fi-modal-window {
                        background: rgba(17, 17, 34, 0.75) !important;
                        backdrop-filter: blur(20px) !important;
                        -webkit-backdrop-filter: blur(20px) !important;
                        border: 1px solid rgba(255, 255, 255, 0.06) !important;
                        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5) !important;
                        border-radius: 1.25rem !important;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }

                    .fi-wi-stats-overview-stat-card:hover {
                        transform: translateY(-2px) !important;
                        border-color: rgba(245, 158, 11, 0.2) !important;
                        box-shadow: 0 25px 50px -12px rgba(245, 158, 11, 0.1) !important;
                    }
                    
                    /* Tables & Header */
                    .fi-ta-header-cell {
                        background-color: rgba(12, 12, 22, 0.6) !important;
                        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
                    }
                    .fi-ta-header-cell-label {
                        color: #94a3b8 !important; 
                        font-weight: 600 !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.05em !important;
                        font-size: 0.75rem !important;
                    }
                    .fi-ta-row {
                        background-color: transparent !important;
                        border-bottom: 1px solid rgba(255, 255, 255, 0.03) !important;
                        transition: background-color 0.2s ease !important;
                    }
                    .fi-ta-row:hover {
                        background-color: rgba(255, 255, 255, 0.015) !important;
                    }
                    .fi-ta-cell {
                        background-color: transparent !important;
                    }
                    .fi-ta-text-item-label {
                        color: #e2e8f0 !important; /* Premium off-white */
                    }
                    
                    /* Page Header Title & Breadcrumbs */
                    .fi-header-heading {
                        color: #ffffff !important;
                        font-weight: 800 !important;
                        letter-spacing: -0.02em !important;
                    }
                    .fi-breadcrumbs-item-label {
                        color: #94a3b8 !important;
                        font-weight: 500 !important;
                    }
                    .fi-breadcrumbs-item-label:hover {
                        color: #fbbf24 !important; 
                    }
                    
                    /* Forms & Labels */
                    .fi-fo-field-wrp-label label {
                        color: #e2e8f0 !important;
                        font-weight: 500 !important;
                    }
                    
                    /* Inputs: Clean obsidian fields */
                    .fi-input-wrp {
                        background-color: rgba(6, 6, 12, 0.6) !important;
                        border-color: rgba(255, 255, 255, 0.08) !important;
                        border-radius: 0.875rem !important;
                        transition: all 0.2s ease !important;
                    }
                    .fi-input-wrp:focus-within {
                        border-color: #f59e0b !important;
                        box-shadow: 0 0 0 1px #f59e0b, 0 0 10px rgba(245, 158, 11, 0.15) !important;
                    }
                    .fi-input {
                        color: #ffffff !important; 
                    }
                    .fi-input::placeholder {
                        color: #4b5563 !important;
                    }
                    
                    /* Active Sidebar Item Button: Golden/Amber premium glow */
                    .fi-sidebar-item-button-active,
                    .fi-sidebar-item-button.fi-active,
                    a.fi-sidebar-item-button[class*="active"],
                    button.fi-sidebar-item-button[class*="active"] {
                        background: linear-gradient(90deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.02) 100%) !important;
                        color: #fbbf24 !important;
                        border-left: 3px solid #fbbf24 !important;
                        border-top-left-radius: 0 !important;
                        border-bottom-left-radius: 0 !important;
                        font-weight: 600 !important;
                    }
                    .fi-sidebar-item-button-active .fi-sidebar-item-icon,
                    .fi-sidebar-item-button.fi-active svg,
                    a.fi-sidebar-item-button[class*="active"] svg,
                    button.fi-sidebar-item-button[class*="active"] svg {
                        color: #fbbf24 !important;
                    }

                    .fi-sidebar-item-button {
                        border-left: 3px solid transparent !important;
                        transition: all 0.2s ease !important;
                    }
                    .fi-sidebar-item-button:hover:not(.fi-active) {
                        background-color: rgba(255, 255, 255, 0.02) !important;
                        border-left: 3px solid rgba(255, 255, 255, 0.2) !important;
                    }

                    /* Sidebar Group / List resets */
                    .fi-sidebar-group,
                    .fi-sidebar-group-items,
                    .fi-sidebar-list {
                        background-color: transparent !important;
                    }
                    
                    /* Buttons */
                    .fi-btn-color-primary {
                        background-color: #f59e0b !important; 
                        color: #06060c !important; 
                        font-weight: 700 !important;
                        border-radius: 0.875rem !important;
                        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2) !important;
                    }
                    .fi-btn-color-primary:hover {
                        background-color: #fbbf24 !important;
                        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4) !important;
                        transform: translateY(-1px) !important;
                    }

                    /* ========================================================= */
                    /* ACTION BUTTONS (CONSISTENT COLOR CODING)                  */
                    /* ========================================================= */

                    /* 1. VIEW ACTION (BLUE / INFO) */
                    .fi-link-color-gray,
                    .fi-link-color-info,
                    .fi-ta-action[class*="view"],
                    [data-action="view"],
                    button[wire\:click*="view"],
                    a[href*="/view"],
                    a[class*="view-action"],
                    button[class*="view-action"] {
                        color: #3b82f6 !important;
                    }
                    .fi-link-color-gray:hover,
                    .fi-link-color-info:hover,
                    .fi-ta-action[class*="view"]:hover,
                    a[href*="/view"]:hover,
                    a[class*="view-action"]:hover,
                    button[class*="view-action"]:hover {
                        color: #60a5fa !important;
                    }
                    .fi-btn-color-info,
                    button[class*="btn-view"] {
                        background-color: #3b82f6 !important;
                        color: white !important;
                    }
                    .fi-btn-color-info:hover,
                    button[class*="btn-view"]:hover {
                        background-color: #2563eb !important;
                        box-shadow: 0 0 12px rgba(59, 130, 246, 0.4) !important;
                    }

                    /* 2. EDIT ACTION (ORANGE / WARNING) */
                    .fi-link-color-warning,
                    .fi-ta-action[class*="edit"],
                    [data-action="edit"],
                    button[wire\:click*="edit"],
                    a[href*="/edit"],
                    a[class*="edit-action"],
                    button[class*="edit-action"] {
                        color: #f97316 !important;
                    }
                    .fi-link-color-warning:hover,
                    .fi-ta-action[class*="edit"]:hover,
                    a[href*="/edit"]:hover,
                    a[class*="edit-action"]:hover,
                    button[class*="edit-action"]:hover {
                        color: #fb923c !important;
                    }
                    .fi-btn-color-warning,
                    button[class*="btn-edit"] {
                        background-color: #f97316 !important;
                        color: white !important;
                    }
                    .fi-btn-color-warning:hover,
                    button[class*="btn-edit"]:hover {
                        background-color: #ea580c !important;
                        box-shadow: 0 0 12px rgba(249, 115, 22, 0.4) !important;
                    }

                    /* 3. DELETE ACTION (RED / DANGER) */
                    .fi-link-color-danger,
                    .fi-ta-action[class*="delete"],
                    .fi-ta-action[class*="destroy"],
                    [data-action="delete"],
                    button[wire\:click*="delete"],
                    a[class*="delete-action"],
                    button[class*="delete-action"],
                    button[class*="destroy-action"] {
                        color: #ef4444 !important;
                    }
                    .fi-link-color-danger:hover,
                    .fi-ta-action[class*="delete"]:hover,
                    .fi-ta-action[class*="destroy"]:hover,
                    button[wire\:click*="delete"]:hover,
                    button[class*="delete-action"]:hover,
                    button[class*="destroy-action"]:hover {
                        color: #f87171 !important;
                    }
                    .fi-btn-color-danger,
                    button[class*="btn-delete"],
                    button[class*="btn-destroy"] {
                        background-color: #ef4444 !important;
                        color: white !important;
                    }
                    .fi-btn-color-danger:hover,
                    button[class*="btn-delete"]:hover,
                    button[class*="btn-destroy"]:hover {
                        background-color: #dc2626 !important;
                        box-shadow: 0 0 12px rgba(239, 68, 68, 0.4) !important;
                    }

                    /* Ensure Action Icons inherit color properly */
                    .fi-ta-actions svg, 
                    .fi-link svg {
                        color: currentColor !important;
                    }

                    /* Login Page Styling */
                    .fi-simple-main {
                        background: rgba(17, 17, 34, 0.6) !important;
                        backdrop-filter: blur(20px) !important;
                        -webkit-backdrop-filter: blur(20px) !important;
                        border: 1px solid rgba(255, 255, 255, 0.08) !important;
                        border-radius: 2rem !important;
                        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6) !important;
                    }
                    .fi-simple-main::before {
                        content: "";
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-image: url("/assets/images/menugallery/tiga.webp");
                        background-size: cover;
                        background-position: center;
                        filter: brightness(0.2) blur(6px);
                        z-index: -1;
                    }
                    .fi-simple-header-heading {
                        color: white !important;
                        font-weight: 900 !important;
                        letter-spacing: -0.025em !important;
                        text-transform: uppercase !important;
                        margin-top: 1.5rem !important;
                    }
                    .fi-simple-header-subheading {
                        color: #94a3b8 !important;
                    }
                    .fi-btn {
                        border-radius: 1rem !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.1em !important;
                        font-weight: 900 !important;
                        transition: all 0.3s ease !important;
                    }
                    .fi-btn:hover {
                        transform: translateY(-2px) !important;
                    }
                    .fi-simple-header img {
                        margin: 0 auto !important;
                        filter: drop-shadow(0 0 15px rgba(255,255,255,0.25)) !important;
                    }
                </style>
            '),
        );
    }
}