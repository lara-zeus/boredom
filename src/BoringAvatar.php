<?php

namespace LaraZeus\Boredom;

use Illuminate\Support\Str;
use LaraZeus\Boredom\Enums\Variants;

class BoringAvatar
{
    public static function get(
        ?string $name = null,
        Variants $variant = Variants::BEAM,
        ?array $colors = null,
        int $size = 80,
        bool $square = false,
    ): string {

        $size = BoringAvatarPlugin::get()->getSize() ?? $size;

        $colors = BoringAvatarPlugin::get()->getColors() ?? $colors;
        $colors = $colors ?? ['#45B39D', '#F1948A', '#FDAC4B', '#0E0239', '#FFF9F5'];
        $colors = self::getColors($colors);

        $variant = BoringAvatarPlugin::get()->getVariant() ?? $variant;
        $variant = $variant->value;

        $square = (BoringAvatarPlugin::get()->isSquare()) ? 'square' : '';

        $name = Str::of($name)
            ->trim()
            ->replace(' ', '%20');

        $url = 'https://source.boringavatars.com';

        return "{$url}/{$variant}/{$size}/{$name}?colors={$colors}&{$square}";
    }

    /**
     * Convert colors array to string.
     *
     * @param  array  $colors  The colors of the avatar.
     * @return string The URL of the avatar.
     */
    private static function getColors(array $colors): string
    {
        return collect($colors)
            ->map(function ($color) {
                if (Str::startsWith($color, '#')) {
                    return str_replace('#', '', $color);
                }

                return $color;
            })
            ->implode(',');
    }
}
