---
name: zeus-boredom
description: Use when configuring Boring Avatars as the default Filament avatar provider or generating user avatar URLs with lara-zeus/boredom.
---

# Lara Zeus Boredom

## Overview & Requirements
`lara-zeus/boredom` integrates Boring Avatars into FilamentPHP v5 panels with per-panel variant, size, shape, color palette, and avatar service URL configuration.
- **PHP**: `^8.2`
- **Filament**: `^5.0`
- **Dependencies**: `spatie/laravel-package-tools ^1.16`
- **Package Name**: `lara-zeus/boredom` (Service Provider: `LaraZeus\Boredom\BoredomServiceProvider`)

## Installation
```bash
composer require lara-zeus/boredom
```

## Configuration & Migrations
No migrations or config files are published. All options are configured fluently on `BoringAvatarPlugin` per Filament panel.

## Filament Panel Registration
Register both `->defaultAvatarProvider(...)` and `BoringAvatarPlugin::make()` in your `PanelProvider`:
```php
use Filament\Panel;
use LaraZeus\Boredom\BoringAvatarPlugin;
use LaraZeus\Boredom\BoringAvatarsProvider;
use LaraZeus\Boredom\Enums\Variants;

public function panel(Panel $panel): Panel
{
    return $panel
        ->defaultAvatarProvider(BoringAvatarsProvider::class)
        ->plugins([
            BoringAvatarPlugin::make()
                ->variant(Variants::MARBLE)
                ->size(60)
                ->square()
                ->url('https://source.boringavatars.com')
                ->colors(['0A0310', '49007E', 'FF005B', 'FF7D10', 'FFB238']),
        ]);
}
```

Available `Variants` cases: `MARBLE`, `BEAM`, `PIXEL`, `SUNSET`, `RING`, `BAUHAUS` (defaults to `Variants::BEAM` in `BoringAvatar::get()`).

## Core Usage & Examples

### User Model Trait (`HasBoringAvatar`)
Add `HasBoringAvatar` to your `User` model (and remove any conflicting `getFilamentAvatarUrl()` method):
```php
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use LaraZeus\Boredom\Concerns\HasBoringAvatar;

class User extends Authenticatable
{
    use HasBoringAvatar;

    // Optional: customize the seed used for avatar_url (defaults to $this->name)
    public function avatarName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->email,
        );
    }
}
```

### Accessing Avatar URLs Outside Panels & in Tables
```php
// On a model using HasBoringAvatar
$url = $user->avatar_url;

// In a Filament Table column
use Filament\Tables\Columns\ImageColumn;

ImageColumn::make('avatar_url');

// Direct URL generation (requires active panel context for BoringAvatarPlugin::get())
use LaraZeus\Boredom\BoringAvatar;

BoringAvatar::get(name: 'Jane Doe');
```

## Common Pitfalls / Anti-Patterns
- **Missing `->url(...)` on `BoringAvatarPlugin`**: `BoringAvatar::get()` interpolates `BoringAvatarPlugin::get()->getUrl()` directly (`"{$url}/{$variantValue}/..."`); if omitted, the URL starts with `/beam/...` instead of a valid host.
- **Calling `BoringAvatar::get()` or `$user->avatar_url` outside a booted Filament panel**: `BoringAvatar::get()` calls `BoringAvatarPlugin::get()` (`filament('zeus-boredom')`), which requires a Filament panel to be active/current.
- **Keep `getFilamentAvatarUrl()` from `FilamentUser`**: `HasBoringAvatar` already defines `getFilamentAvatarUrl()`; remove any duplicate definition on your `User` model.
