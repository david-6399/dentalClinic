<?php

use App\Services\PageContent;
use Livewire\Component;

new class extends Component
{
    public string $selectedPage = 'home';

    public array $sections = [];

    public array $drafts = [];

    public function mount(): void
    {
        $this->sections = PageContent::forPage($this->selectedPage);
    }

    public function selectPage(string $page): void
    {
        $pages = PageContent::pages();

        if (! isset($pages[$page])) {
            abort(404);
        }

        $this->drafts[$this->selectedPage] = $this->sections;
        $this->selectedPage = $page;
        $this->sections = $this->drafts[$page] ?? PageContent::forPage($page);
        $this->resetValidation();
    }

    public function save(): void
    {
        $pages = PageContent::pages();

        if (! isset($pages[$this->selectedPage])) {
            abort(404);
        }

        $rules = [
            'selectedPage' => ['required', 'string', 'in:'.implode(',', array_keys($pages))],
        ];

        foreach ($pages[$this->selectedPage]['sections'] as $key => $section) {
            $rules["sections.{$key}.title"] = ['required', 'string', 'max:120'];
            $rules["sections.{$key}.description"] = ['nullable', 'string', 'max:1000'];
            $rules["sections.{$key}.enabled"] = ['required', 'boolean'];

            if (isset($section['items'])) {
                $rules["sections.{$key}.items"] = ['present', 'array', 'max:30'];
                $rules["sections.{$key}.items.*.id"] = ['nullable', 'integer', 'min:1'];
                $rules["sections.{$key}.items.*.title"] = ['required', 'string', 'max:120'];
                $rules["sections.{$key}.items.*.description"] = ['nullable', 'string', 'max:1000'];

                if (in_array($key, ['hero_stats', 'statistics'], true)) {
                    $rules["sections.{$key}.items.*.value"] = ['required', 'numeric', 'min:0', 'max:999999999'];
                    $rules["sections.{$key}.items.*.suffix"] = ['nullable', 'string', 'max:20'];
                }

                if (in_array($this->selectedPage, ['about', 'doctors'], true) && $key === 'values') {
                    $rules["sections.{$key}.items.*.icon"] = ['required', 'string', 'in:'.implode(',', array_keys(PageContent::icons()))];
                }

                if ($this->selectedPage === 'doctors' && $key === 'values') {
                    $rules["sections.{$key}.items.*.icon_color"] = ['required', 'regex:/\A#[0-9a-fA-F]{6}\z/'];
                }
            }
        }

        $validated = $this->validate($rules);
        PageContent::savePage($this->selectedPage, $validated['sections']);
        $this->sections = PageContent::forPage($this->selectedPage);
        $this->drafts[$this->selectedPage] = $this->sections;
        session()->flash('pages-saved', 'Your page changes are live.');
    }

    public function addItem(string $sectionKey): void
    { 
        if (! isset(PageContent::pages()[$this->selectedPage]['sections'][$sectionKey]['items'])) {
            abort(404);
        }

        $this->sections[$sectionKey]['items'][] = [
            'id' => null,
            'title' => '',
            'description' => '',
            'value' => '',
            'suffix' => '',
            'icon' => 'sparkles',
            'icon_color' => '#2563eb',
        ];
    }

    public function removeItem(string $sectionKey, int $index): void
    {
        if (! isset($this->sections[$sectionKey]['items'][$index])) {
            return;
        }

        unset($this->sections[$sectionKey]['items'][$index]);
        $this->sections[$sectionKey]['items'] = array_values($this->sections[$sectionKey]['items']);
    }

    public function toggleSection(string $sectionKey): void
    {
        if (! isset(PageContent::pages()[$this->selectedPage]['sections'][$sectionKey])
            || ! isset($this->sections[$sectionKey]['enabled'])) {
            abort(404);
        }

        $this->sections[$sectionKey]['enabled'] = ! $this->sections[$sectionKey]['enabled'];
    }

    public function moveItem(string $sectionKey, int $index, int $direction): void
    {
        $items = $this->sections[$sectionKey]['items'] ?? null;
        $target = $index + $direction;

        if (! is_array($items) || ! in_array($direction, [-1, 1], true) || ! isset($items[$index], $items[$target])) {
            return;
        }

        [$items[$index], $items[$target]] = [$items[$target], $items[$index]];
        $this->sections[$sectionKey]['items'] = $items;
    }

    public function render()
    {
        return $this->view()->layout('layouts::dashboard');
    }
};
?>

<div class="flex min-h-screen min-w-0 flex-col">
    <header
        class="flex items-center justify-between border-b border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-900 sm:px-6">
        <div class="flex min-w-0 items-center gap-3 sm:gap-4">
            <button onclick="toggleSidebar()" class="rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-800 md:hidden"
                aria-label="Open navigation">
                <x-heroicon name="rectangle-stack" class="h-5 w-5 text-gray-600 dark:text-gray-400" />
            </button>
            <div class="min-w-0">
                <p class="truncate text-xs text-gray-500 dark:text-gray-400 sm:text-sm">Dental Clinic / Website</p>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Customize pages</h1>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="toggleTheme()" class="rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                aria-label="Toggle theme">
                <x-heroicon name="sun" class="h-5 w-5 text-gray-600 dark:hidden" />
                <x-heroicon name="moon" class="hidden h-5 w-5 text-gray-400 dark:block" />
            </button>
            <div class="hidden items-center gap-3 sm:flex">
                <div
                    class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-500 text-sm font-medium text-white">
                    CM</div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Clinic Manager</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Practice administrator</p>
                </div>
            </div>
        </div>
    </header>

    <main class="min-w-0 flex-1 overflow-y-auto p-4 sm:p-6">
        <div class="mx-auto w-full max-w-7xl space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Website content</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Update section headings and descriptions, or hide a section from your public website.
                    </p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route(PageContent::pages()[$selectedPage]['route']) }}" target="_blank" rel="noopener"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <x-heroicon name="arrow-top-right-on-square" class="h-4 w-4" />
                        Preview page
                    </a>
                    <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:cursor-wait disabled:opacity-60">
                        <x-heroicon name="bookmark" class="h-4 w-4" wire:loading.remove wire:target="save" />
                        <x-heroicon name="arrow-path" class="h-4 w-4 animate-spin" wire:loading wire:target="save" />
                        <span wire:loading.remove wire:target="save">Save changes</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                </div>
            </div>

            @if (session()->has('pages-saved'))
                <div role="status"
                    class="flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 dark:border-green-800 dark:bg-green-900/20 dark:text-green-300">
                    <x-heroicon name="check" class="h-4 w-4" />
                    {{ session('pages-saved') }}
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-[240px_minmax(0,1fr)]">
                <nav aria-label="Website pages"
                    class="h-fit rounded-xl border border-gray-200 bg-white p-3 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="px-3 pb-2 pt-1 text-xs font-semibold uppercase tracking-wide text-gray-400">Pages</p>
                    @foreach (PageContent::pages() as $pageKey => $page)
                        <button type="button" wire:click="selectPage('{{ $pageKey }}')"
                            @class([
                                'flex w-full items-center gap-3 rounded-lg px-3 py-3 text-left text-sm font-medium transition',
                                'bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300' => $selectedPage === $pageKey,
                                'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/60' => $selectedPage !== $pageKey,
                            ])>
                            <x-heroicon
                                :name="['home' => 'home', 'services' => 'briefcase', 'doctors' => 'user-group', 'contact' => 'chat-bubble-left-right', 'about' => 'question-mark-circle'][$pageKey]"
                                class="h-4 w-4" />
                            <span>{{ $page['label'] }}</span>
                            <span class="ml-auto text-xs text-gray-400">{{ count($page['sections']) }}</span>
                        </button>
                    @endforeach
                </nav>

                <section wire:key="page-sections-{{ $selectedPage }}" class="min-w-0 space-y-4" aria-label="{{ PageContent::pages()[$selectedPage]['label'] }} page sections">
                    <div class="flex items-center justify-between gap-3 px-1">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ PageContent::pages()[$selectedPage]['label'] }} page
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ collect($sections)->where('enabled', true)->count() }} of {{ count($sections) }} sections visible
                            </p>
                        </div>
                    </div>

                    @foreach ($sections as $key => $section)
                        <article wire:key="section-{{ $selectedPage }}-{{ $key }}" 
                        @class([
                            'rounded-xl border bg-white shadow-sm transition dark:bg-gray-800',
                            'border-gray-200 dark:border-gray-700' => $section['enabled'],
                            'border-dashed border-gray-300 opacity-75 dark:border-gray-600' => ! $section['enabled'],
                        ])>
                            <div class="flex flex-col gap-4 border-b border-gray-100 px-4 py-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-primary-300">
                                        <x-heroicon name="rectangle-stack" class="h-4 w-4" />
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $section['label'] }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $section['enabled'] ? 'Visible on your website' : 'Hidden from your website' }}
                                            @if (isset($section['items']))
                                                · {{ count($section['items']) }} items
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <button type="button" wire:click="toggleSection('{{ $key }}')" role="switch"
                                    aria-checked="{{ $section['enabled'] ? 'true' : 'false' }}"
                                    aria-label="Toggle {{ strtolower($section['label']) }} section visibility"
                                    class="inline-flex cursor-pointer items-center gap-3 self-start rounded focus:outline-none focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 sm:self-auto">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                        {{ $section['enabled'] ? 'Active' : 'Inactive' }}
                                    </span>
                                    <span aria-hidden="true" @class([
                                        'relative h-6 w-11 rounded-full transition after:absolute after:left-1 after:top-1 after:h-4 after:w-4 after:rounded-full after:bg-white after:transition after:content-[\'\']',
                                        'bg-primary-600 after:translate-x-5' => $section['enabled'],
                                        'bg-gray-300 dark:bg-gray-600' => ! $section['enabled'],
                                    ])></span>
                                </button>
                            </div>

                            <div class="grid gap-4 p-4 sm:grid-cols-2 sm:px-6 sm:py-5">
                                <div class="sm:col-span-2">
                                    <label for="section-title-{{ $key }}"
                                        class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Heading</label>
                                    <textarea id="section-title-{{ $key }}" rows="2"
                                        wire:model="sections.{{ $key }}.title"
                                        class="w-full resize-y rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-primary-900"></textarea>
                                    @error("sections.{$key}.title")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="section-description-{{ $key }}"
                                        class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea id="section-description-{{ $key }}" rows="3"
                                        wire:model="sections.{{ $key }}.description"
                                        placeholder="Add a short description for this section"
                                        class="w-full resize-y rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm leading-6 text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-primary-900"></textarea>
                                    @error("sections.{$key}.description")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                @if (isset($section['items']))
                                    <div class="sm:col-span-2 border-t border-gray-100 pt-5 dark:border-gray-700">
                                        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                            <div>
                                                <h5 class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $selectedPage === 'contact' && $key === 'faq' ? 'Questions & answers' : 'Section items' }}
                                                </h5>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    Add, edit, remove, and reorder the items shown in this section.
                                                </p>
                                            </div>
                                            <button type="button" wire:click="addItem('{{ $key }}')" 
                                                class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                                                <x-heroicon name="plus" class="h-4 w-4" />
                                                Add item 
                                            </button>
                                        </div>

                                        <div class="space-y-3">
                                            @foreach ($section['items'] as $itemIndex => $item)
                                                <div wire:key="section-{{ $key }}-item-{{ $item['id'] ?? 'new-'.$itemIndex }}"
                                                    class="rounded-lg border border-gray-200 bg-gray-50/70 p-4 dark:border-gray-700 dark:bg-gray-900/40">
                                                    <div class="mb-4 flex items-center justify-between">
                                                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                                            {{ $selectedPage === 'contact' && $key === 'faq' ? 'Question '.($itemIndex + 1) : 'Item '.($itemIndex + 1) }}
                                                        </span>
                                                        <div class="flex items-center gap-1">
                                                            <button type="button" wire:click="moveItem('{{ $key }}', {{ $itemIndex }}, -1)"
                                                                @disabled($itemIndex === 0)
                                                                aria-label="Move item up"
                                                                class="rounded-md p-2 text-gray-500 transition hover:bg-white hover:text-gray-900 disabled:cursor-not-allowed disabled:opacity-40 dark:hover:bg-gray-800 dark:hover:text-white">
                                                                <x-heroicon name="arrow-up" class="h-4 w-4" />
                                                            </button>
                                                            <button type="button" wire:click="moveItem('{{ $key }}', {{ $itemIndex }}, 1)"
                                                                @disabled($itemIndex === count($section['items']) - 1)
                                                                aria-label="Move item down"
                                                                class="rounded-md p-2 text-gray-500 transition hover:bg-white hover:text-gray-900 disabled:cursor-not-allowed disabled:opacity-40 dark:hover:bg-gray-800 dark:hover:text-white">
                                                                <x-heroicon name="arrow-down" class="h-4 w-4" />
                                                            </button>
                                                            <button type="button" wire:click="removeItem('{{ $key }}', {{ $itemIndex }})"
                                                                aria-label="Remove item"
                                                                class="rounded-md p-2 text-red-500 transition hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/20" wire:confirm="Are you sure you want to remove this item?">
                                                                <x-heroicon name="trash" class="h-4 w-4" />
                                                            </button>
                                                        </div>
                                                    </div>

                                                    @if (isset($item['id']))
                                                        <input type="hidden" wire:model="sections.{{ $key }}.items.{{ $itemIndex }}.id">
                                                    @endif

                                                    <div class="space-y-4">
                                                        <div>
                                                            <label for="item-title-{{ $key }}-{{ $itemIndex }}"
                                                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ $selectedPage === 'contact' && $key === 'faq' ? 'Question' : (in_array($key, ['hero_stats', 'statistics'], true) ? 'Label' : 'Heading') }}
                                                            </label>
                                                            <input id="item-title-{{ $key }}-{{ $itemIndex }}" type="text"
                                                                wire:model="sections.{{ $key }}.items.{{ $itemIndex }}.title"
                                                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-primary-900">
                                                            @error("sections.{$key}.items.{$itemIndex}.title")
                                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        @if (in_array($key, ['hero_stats', 'statistics'], true))
                                                            <div class="grid gap-4 sm:grid-cols-2">
                                                                <div>
                                                                    <label for="item-value-{{ $key }}-{{ $itemIndex }}"
                                                                        class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Value</label>
                                                                    <input id="item-value-{{ $key }}-{{ $itemIndex }}" type="number" min="0" step="any"
                                                                        wire:model="sections.{{ $key }}.items.{{ $itemIndex }}.value"
                                                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-primary-900">
                                                                    @error("sections.{$key}.items.{$itemIndex}.value")
                                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div>
                                                                    <label for="item-suffix-{{ $key }}-{{ $itemIndex }}"
                                                                        class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Suffix (optional)</label>
                                                                    <input id="item-suffix-{{ $key }}-{{ $itemIndex }}" type="text"
                                                                        wire:model="sections.{{ $key }}.items.{{ $itemIndex }}.suffix"
                                                                        placeholder="+, %, /5"
                                                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none transition focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-primary-900">
                                                                </div>
                                                            </div>
                                                        @else
                                                        <div>
                                                            <label for="item-description-{{ $key }}-{{ $itemIndex }}"
                                                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                {{ $selectedPage === 'contact' && $key === 'faq' ? 'Answer' : 'Description' }}
                                                            </label>
                                                            <textarea id="item-description-{{ $key }}-{{ $itemIndex }}" rows="3"
                                                                wire:model="sections.{{ $key }}.items.{{ $itemIndex }}.description"
                                                                class="w-full resize-y rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm leading-6 text-gray-900 outline-none transition focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-primary-900"></textarea>
                                                            @error("sections.{$key}.items.{$itemIndex}.description")
                                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        @endif

                                                        @if (in_array($selectedPage, ['about', 'doctors'], true) && $key === 'values')
                                                            <div class="grid gap-4 sm:grid-cols-2">
                                                                <div>
                                                                    <label for="item-icon-{{ $key }}-{{ $itemIndex }}"
                                                                        class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Heroicon</label>
                                                                    <div class="flex items-center gap-3">
                                                                        <select id="item-icon-{{ $key }}-{{ $itemIndex }}"
                                                                            wire:model="sections.{{ $key }}.items.{{ $itemIndex }}.icon"
                                                                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                                                            @foreach (PageContent::icons() as $iconName => $iconLabel)
                                                                                <option value="{{ $iconName }}">{{ $iconLabel }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-white text-gray-700 shadow-sm dark:bg-gray-800 dark:text-gray-200">
                                                                            <x-heroicon :name="$item['icon'] ?? 'sparkles'" class="h-6 w-6" />
                                                                        </span>
                                                                    </div>
                                                                    @error("sections.{$key}.items.{$itemIndex}.icon")
                                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                    @enderror
                                                                </div>

                                                                @if ($selectedPage === 'doctors')
                                                                    <div>
                                                                        <label for="item-icon-color-{{ $key }}-{{ $itemIndex }}"
                                                                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Icon color</label>
                                                                        <div class="flex items-center gap-3">
                                                                            <input id="item-icon-color-{{ $key }}-{{ $itemIndex }}" type="color"
                                                                                wire:model="sections.{{ $key }}.items.{{ $itemIndex }}.icon_color"
                                                                                class="h-10 w-16 cursor-pointer rounded-lg border border-gray-300 bg-white p-1 dark:border-gray-600 dark:bg-gray-700">
                                                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                                                {{ $item['icon_color'] ?? '#2563eb' }}
                                                                            </span>
                                                                        </div>
                                                                        @error("sections.{$key}.items.{$itemIndex}.icon_color")
                                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error("sections.{$key}.items")
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach

                    <div class="flex justify-end pt-2">
                        <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                            class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 disabled:cursor-wait disabled:opacity-60">
                            <x-heroicon name="bookmark" class="h-4 w-4" />
                            Save changes
                        </button>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>
