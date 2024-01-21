---
title: Installation
weight: 3
---

## Installation

Install @zeus Boredom by running the following commands in your Laravel project directory.

```bash
composer require lara-zeus/boredom
```

## Usage:

### set the avatar provider in your panel:

```php
->defaultAvatarProvider(
    \LaraZeus\Boredom\BoringAvatarsProvider::class
)
```

### register the plugin

```php
\LaraZeus\Boredom\BoringAvatarPlugin::make()
    ->variant(Variants::MARBLE)
    ->size(60)
    ->square()
    ->colors(['0A0310','49007E','FF005B','FF7D10','FFB238'])
```

## setup your User model

add the trait HasBoringAvatar to your User model:

`use HasBoringAvatar;`

and you can remove the method `getFilamentAvatarUrl`

to overwrite the name:

```php
public function avatarName(): Attribute
{
    return new Attribute(
        get: fn () => $this->name // or $this->>email or $this->>username or Str::random()
    );
}
```

to get the avatar outside filament:
`User::find(1)->avatar_url`

to use it in a resource:
`ImageColumn::make('avatar_url'),`