# Lara Zeus Boredom (`lara-zeus/boredom`)

FilamentPHP v5 Boring Avatars integration providing a panel avatar provider, configurable plugin, URL generator, and Eloquent user trait.

## Key Classes
- **Panel Plugin**: `LaraZeus\Boredom\BoringAvatarPlugin` (ID: `'zeus-boredom'`, configures `variant()`, `size()`, `colors()`, `square()`, `url()`)
- **Avatar Provider**: `LaraZeus\Boredom\BoringAvatarsProvider` (implements `Filament\AvatarProviders\Contracts\AvatarProvider`)
- **URL Builder**: `LaraZeus\Boredom\BoringAvatar` (`BoringAvatar::get(...)`)
- **Model Trait**: `LaraZeus\Boredom\Concerns\HasBoringAvatar` (adds `getFilamentAvatarUrl()`, `avatarName()`, `avatarUrl()` attributes)
- **Enum**: `LaraZeus\Boredom\Enums\Variants` (`MARBLE`, `BEAM`, `PIXEL`, `SUNSET`, `RING`, `BAUHAUS`)
- **Service Provider**: `LaraZeus\Boredom\BoredomServiceProvider` (`$name = 'zeus-boredom'`)

## Rules & Anti-Patterns
- **Register `BoringAvatarPlugin` and set `->url(...)`**: `BoringAvatar::get()` reads settings from `BoringAvatarPlugin::get()` and prefixes the path with `getUrl()`; omitting the plugin registration or `->url('https://...')` breaks avatar URL generation.
- **Set `->defaultAvatarProvider(BoringAvatarsProvider::class)`**: Registering the plugin alone does not replace Filament's default avatar provider; set `->defaultAvatarProvider(BoringAvatarsProvider::class)` on the `Panel` (or use `HasBoringAvatar` on the User model).
- **Email vs Name seed**: `BoringAvatarsProvider` passes `$record->email` to `BoringAvatar::get()`, while `HasBoringAvatar` uses `$this->avatar_name` (defaults to `$this->name`). Override `avatarName(): Attribute` on the model if you want a custom seed.
