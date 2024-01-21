<?php

namespace LaraZeus\Boredom;

use Filament\AvatarProviders\Contracts;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class BoringAvatarsProvider implements Contracts\AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
        // @phpstan-ignore-next-line
        return BoringAvatar::get(name: $record->email);
    }
}
