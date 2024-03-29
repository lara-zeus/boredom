<?php

namespace LaraZeus\Boredom\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use LaraZeus\Boredom\BoringAvatar;

trait HasBoringAvatar
{
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function avatarName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->name
        );
    }

    public function avatarUrl(): Attribute
    {
        return new Attribute(
            get: fn () => app()->make(BoringAvatar::class)->get(name: $this->avatar_name)
        );
    }
}
