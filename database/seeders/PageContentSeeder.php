<?php

namespace Database\Seeders;

use App\Models\PageSection;
use App\Services\PageContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JsonException;
use RuntimeException;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $legacy = $this->legacyContent();

        DB::transaction(function () use ($legacy): void {
            foreach (PageContent::definitions() as $pageKey => $page) {
                foreach ($page['sections'] as $sectionKey => $defaults) {
                    $overrides = $legacy[$pageKey][$sectionKey] ?? [];
                    $section = PageSection::query()->firstOrCreate(
                        ['page_key' => $pageKey, 'section_key' => $sectionKey],
                        [
                            'label' => $defaults['label'],
                            'title' => is_string($overrides['title'] ?? null) ? $overrides['title'] : $defaults['title'],
                            'description' => is_string($overrides['description'] ?? null) ? $overrides['description'] : $defaults['description'],
                            'enabled' => is_bool($overrides['enabled'] ?? null) ? $overrides['enabled'] : $defaults['enabled'],
                        ],
                    );

                    if ($section->wasRecentlyCreated) {
                        $section->items()->createMany(
                            collect($defaults['items'] ?? [])
                                ->values()
                                ->map(fn (array $item, int $index) => [
                                    'title' => $item['title'],
                                    'description' => $item['description'],
                                    'value' => $item['value'],
                                    'suffix' => $item['suffix'],
                                    'icon' => $item['icon'],
                                    'icon_color' => $item['icon_color'],
                                    'sort_order' => $index,
                                ])
                                ->all(),
                        );
                    }
                }
            }
        });
    }

    private function legacyContent(): array
    {
        $disk = Storage::disk('local');

        if (! $disk->exists('pages.json')) {
            return [];
        }

        try {
            $content = json_decode($disk->get('pages.json'), true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException('The legacy page content could not be imported because its JSON is invalid.', previous: $exception);
        }

        if (! is_array($content)) {
            throw new RuntimeException('The legacy page content must be a JSON object.');
        }

        return $content;
    }
}
