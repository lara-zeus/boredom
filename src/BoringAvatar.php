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
        $allColors = self::getColors($colors);

        $variant = BoringAvatarPlugin::get()->getVariant() ?? $variant;
        $variantValue = $variant->value;

        $isSquare = (BoringAvatarPlugin::get()->isSquare()) ? '&square' : '';

        $fullName = Str::of($name)
            ->trim()
            ->replace(' ', '%20');

        $url = BoringAvatarPlugin::get()->getUrl();

        return "{$url}/{$variantValue}/{$size}/{$fullName}?colors={$allColors}{$isSquare}";
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
