<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class ClinicData
{
    private const DEFAULT_THEME = [
        'primary' => '#d4eb25',
        'accent' => '#06d409',
    ];

    public static function all(): array
    {
        $path = storage_path('app/clinic.json');
        $modifiedAt = is_file($path) ? @filemtime($path) : false;
        $cacheKey = 'clinic-data:'.($modifiedAt === false ? 'missing' : $modifiedAt);

        return Cache::remember($cacheKey, now()->addYear(), static function () use ($path): array {
            $contents = is_readable($path) ? @file_get_contents($path) : false;
            $data = is_string($contents) ? json_decode($contents, true) : null;
            $theme = is_array($data['theme'] ?? null) ? $data['theme'] : [];

            return [
                'theme' => [
                    'primary' => self::validColor($theme['primary'] ?? null, self::DEFAULT_THEME['primary']),
                    'accent' => self::validColor($theme['accent'] ?? null, self::DEFAULT_THEME['accent']),
                ],
            ];
        });
    }

    private static function validColor(mixed $color, string $fallback): string
    {
        return is_string($color) && preg_match('/\A#[0-9a-fA-F]{6}\z/', $color)
            ? $color
            : $fallback;
    }
}
