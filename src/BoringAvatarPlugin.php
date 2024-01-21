<?php

namespace LaraZeus\Boredom;

use Filament\Contracts\Plugin;
use Filament\Panel;
use LaraZeus\Boredom\Enums\Variants;

class BoringAvatarPlugin implements Plugin
{
    protected ?Variants $variant = null;

    protected ?int $size = null;

    protected ?bool $square = false;

    protected ?array $colors = null;

    public function getId(): string
    {
        return 'zeus-boredom';
    }

    public function register(Panel $panel): void
    {
    }

    public static function make(): static
    {
        // @phpstan-ignore-next-line
        return new self();
    }

    public static function get(): static
    {
        // @phpstan-ignore-next-line
        return filament('zeus-boredom');
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function variant(?Variants $variant = null): static
    {
        $this->variant = $variant;

        return $this;
    }

    public function getVariant(): ?Variants
    {
        return $this->variant;
    }

    public function size(?int $size = null): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function colors(?array $colors): static
    {
        $this->colors = $colors;

        return $this;
    }

    public function getColors(): ?array
    {
        return $this->colors;
    }

    public function square(?bool $square = true): static
    {
        $this->square = $square;

        return $this;
    }

    public function isSquare(): ?bool
    {
        return $this->square;
    }
}
