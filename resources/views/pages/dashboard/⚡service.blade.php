<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';
    public string $viewMode = 'table';
    public array $services = [
        ['id' => 1, 'name' => 'Dental Checkup', 'category' => 'Preventive care', 'description' => 'Full oral examination with digital X-rays and gum health assessment.', 'price' => 2000, 'duration' => 30, 'status' => 'Available'],
        ['id' => 2, 'name' => 'Teeth Cleaning', 'category' => 'Preventive care', 'description' => 'Professional scaling and polishing with fluoride treatment.', 'price' => 3500, 'duration' => 45, 'status' => 'Available'],
        ['id' => 3, 'name' => 'Teeth Whitening', 'category' => 'Cosmetic dentistry', 'description' => 'In-office whitening treatment for a brighter smile.', 'price' => 12000, 'duration' => 60, 'status' => 'Available'],
        ['id' => 4, 'name' => 'Orthodontics Consultation', 'category' => 'Orthodontics', 'description' => 'Bite assessment and personalized braces or aligner treatment plan.', 'price' => 5000, 'duration' => 45, 'status' => 'Available'],
        ['id' => 5, 'name' => 'Dental Implants', 'category' => 'Oral surgery', 'description' => 'Implant placement consultation and treatment planning.', 'price' => 50000, 'duration' => 90, 'status' => 'Available'],
        ['id' => 6, 'name' => 'Pediatric Dentistry', 'category' => 'Pediatric dentistry', 'description' => 'Gentle examination and preventive care for children.', 'price' => 3000, 'duration' => 40, 'status' => 'Available'],
        ['id' => 7, 'name' => 'Composite Filling', 'category' => 'Restorative dentistry', 'description' => 'Tooth-colored filling to restore a tooth affected by decay.', 'price' => 4500, 'duration' => 50, 'status' => 'Available'],
        ['id' => 8, 'name' => 'Root Canal Treatment', 'category' => 'Endodontics', 'description' => 'Treatment to remove infected tissue and preserve the tooth.', 'price' => 18000, 'duration' => 90, 'status' => 'Unavailable'],
    ];
    public bool $showForm = false;
    public ?int $editingId = null;
    public string $name = '';
    public string $category = '';
    public string $description = '';
    public string $price = '';
    public string $duration = '';
    public string $status = 'Available';

    #[Computed]
    public function paginatedServices(): LengthAwarePaginator
    {
        $search = mb_strtolower(trim($this->search));
        $services = collect($this->services)->filter(fn(array $service) => $search === '' || str_contains(mb_strtolower(implode(' ', [$service['name'], $service['category'], $service['description'], $service['status']])), $search))->sortBy('name')->values();

        $perPage = 6;
        $page = $this->getPage();

        return new LengthAwarePaginator($services->forPage($page, $perPage)->values(), $services->count(), $perPage, $page, ['path' => request()->url(), 'pageName' => 'page']);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function setViewMode(string $mode): void
    {
        if (in_array($mode, ['table', 'grid'], true)) {
            $this->viewMode = $mode;
        }
    }

    public function openCreateForm(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function editService(int $id): void
    {
        $service = collect($this->services)->firstWhere('id', $id);

        if (!$service) {
            return;
        }

        $this->editingId = $id;
        $this->name = $service['name'];
        $this->category = $service['category'];
        $this->description = $service['description'];
        $this->price = (string) $service['price'];
        $this->duration = (string) $service['duration'];
        $this->status = $service['status'];
        $this->showForm = true;
    }

    public function saveService(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999'],
            'duration' => ['required', 'integer', 'min:5', 'max:600'],
            'status' => ['required', 'in:Available,Unavailable'],
        ]);

        $service = [...$validated, 'price' => (float) $validated['price'], 'duration' => (int) $validated['duration']];

        if ($this->editingId !== null) {
            foreach ($this->services as $index => $existingService) {
                if ($existingService['id'] === $this->editingId) {
                    $this->services[$index] = ['id' => $this->editingId, ...$service];
                    break;
                }
            }
        } else {
            $service['id'] = (collect($this->services)->max('id') ?? 0) + 1;
            $this->services[] = $service;
        }

        $this->closeForm();
        $this->resetPage();
    }

    public function deleteService(int $id): void
    {
        $this->services = array_values(array_filter($this->services, fn(array $service) => $service['id'] !== $id));
        $this->resetPage();
    }

    public function closeForm(): void
    {
        $this->showForm = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->resetValidation();
        $this->editingId = null;
        $this->name = '';
        $this->category = '';
        $this->description = '';
        $this->price = '';
        $this->duration = '';
        $this->status = 'Available';
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
                <i data-lucide="menu" class="h-5 w-5 text-gray-600 dark:text-gray-400"></i>
            </button>
            <div class="min-w-0">
                <p class="truncate text-xs text-gray-500 dark:text-gray-400 sm:text-sm">Dental Clinic / Directory</p>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Services</h1>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="toggleTheme()" class="rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                aria-label="Toggle theme">
                <i data-lucide="sun" class="h-5 w-5 text-gray-600 dark:hidden"></i>
                <i data-lucide="moon" class="hidden h-5 w-5 text-gray-400 dark:block"></i>
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
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Service directory</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage treatments, pricing and
                        availability.</p>
                </div>
                <button wire:click="openCreateForm"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                    <i data-lucide="plus" class="h-4 w-4"></i> Create service
                </button>
            </div>

            <div
                class="rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800 dark:border-blue-900 dark:bg-blue-950/40 dark:text-blue-200">
                Demonstration records only. Changes are temporary and are not saved to a database.
            </div>

            <section
                class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
                aria-label="Services list">
                <div
                    class="flex flex-col gap-4 border-b border-gray-200 p-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">All services</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $this->paginatedServices->total() }}
                            treatments</p>
                    </div>
                    <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:items-center">
                        <label class="relative block w-full sm:w-64">
                            <span class="sr-only">Search services</span>
                            <i data-lucide="search"
                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"></i>
                            <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search services"
                                class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-9 pr-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        </label>
                        <div class="inline-flex w-full rounded-lg border border-gray-300 p-1 dark:border-gray-600 sm:w-auto"
                            role="group" aria-label="Display mode">
                            <button wire:click="setViewMode('table')"
                                aria-pressed="{{ $viewMode === 'table' ? 'true' : 'false' }}" title="Table view"
                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition sm:flex-none {{ $viewMode === 'table' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-500 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/60' }}"><i
                                    data-lucide="list" class="h-4 w-4"></i><span class="sm:hidden">Table</span></button>
                            <button wire:click="setViewMode('grid')"
                                aria-pressed="{{ $viewMode === 'grid' ? 'true' : 'false' }}" title="Grid view"
                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-md px-3 py-2 text-sm font-medium transition sm:flex-none {{ $viewMode === 'grid' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-500 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700/60' }}"><i
                                    data-lucide="layout-grid" class="h-4 w-4"></i><span
                                    class="sm:hidden">Grid</span></button>
                        </div>
                    </div>
                </div>

                @if ($viewMode === 'table')
                    <div class="space-y-3 p-4 md:hidden">
                        @forelse ($this->paginatedServices as $service)
                            <article wire:key="service-mobile-{{ $service['id'] }}"
                                class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <h4 class="truncate text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ $service['name'] }}</h4>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $service['category'] }}</p>
                                    </div>
                                    <span
                                        class="shrink-0 rounded-full px-2 py-1 text-xs font-medium {{ $service['status'] === 'Available' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }}">{{ $service['status'] }}</span>
                                </div>
                                <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">{{ $service['description'] }}
                                </p>
                                <dl
                                    class="mt-3 grid grid-cols-2 gap-3 border-t border-gray-100 pt-3 text-sm dark:border-gray-700">
                                    <div>
                                        <dt class="text-xs text-gray-500 dark:text-gray-400">Price</dt>
                                        <dd class="font-semibold text-gray-900 dark:text-white">
                                            {{ number_format($service['price'], 0) }} DZD</dd>
                                    </div>
                                    <div>
                                        <dt class="text-xs text-gray-500 dark:text-gray-400">Duration</dt>
                                        <dd class="text-gray-800 dark:text-gray-200">{{ $service['duration'] }} min
                                        </dd>
                                    </div>
                                </dl>
                                <div
                                    class="mt-3 flex justify-end gap-2 border-t border-gray-100 pt-2 dark:border-gray-700">
                                    <button wire:click="editService({{ $service['id'] }})"
                                        class="inline-flex items-center gap-1 rounded-md px-2 py-1.5 text-sm font-medium text-blue-700 hover:bg-blue-50 dark:text-blue-300 dark:hover:bg-blue-950/50"><i
                                            data-lucide="pencil" class="h-4 w-4"></i> Edit</button>
                                    <button wire:click="deleteService({{ $service['id'] }})"
                                        wire:confirm="Delete this service?"
                                        class="inline-flex items-center gap-1 rounded-md px-2 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 dark:text-red-300 dark:hover:bg-red-950/50"><i
                                            data-lucide="trash-2" class="h-4 w-4"></i> Delete</button>
                                </div>
                            </article>
                        @empty
                            <p class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">No services match your
                                search.</p>
                        @endforelse
                    </div>
                    <div class="hidden overflow-x-auto md:block">
                        <table class="w-full min-w-[900px] text-left">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                        Service</th>
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                        Price</th>
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                        Duration</th>
                                    <th
                                        class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($this->paginatedServices as $service)
                                    <tr wire:key="service-{{ $service['id'] }}"
                                        class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                        <td class="max-w-sm px-6 py-4">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $service['name'] }}</p>
                                            <p class="mt-1 line-clamp-2 text-xs text-gray-500 dark:text-gray-400">
                                                {{ $service['description'] }}</p>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                            {{ $service['category'] }}</td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ number_format($service['price'], 0) }} DZD</td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                            {{ $service['duration'] }} min</td>
                                        <td class="whitespace-nowrap px-6 py-4"><span
                                                class="rounded-full px-2.5 py-1 text-xs font-medium {{ $service['status'] === 'Available' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }}">{{ $service['status'] }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex justify-end gap-1">
                                                <button wire:click="editService({{ $service['id'] }})"
                                                    title="Edit service" aria-label="Edit {{ $service['name'] }}"
                                                    class="rounded-md p-2 text-gray-500 transition hover:bg-blue-50 hover:text-blue-700 dark:text-gray-400 dark:hover:bg-blue-950/50 dark:hover:text-blue-300"><i
                                                        data-lucide="pencil" class="h-5 w-5"></i></button>
                                                <button wire:click="deleteService({{ $service['id'] }})"
                                                    wire:confirm="Delete this service?" title="Delete service"
                                                    aria-label="Delete {{ $service['name'] }}"
                                                    class="rounded-md p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-700 dark:text-gray-400 dark:hover:bg-red-950/50 dark:hover:text-red-300"><i
                                                        data-lucide="trash-2" class="h-5 w-5"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">No
                                            services match your search.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-3 p-4 sm:grid-cols-2 xl:grid-cols-3 sm:p-6">
                        @forelse ($this->paginatedServices as $service)
                            <article wire:key="service-grid-{{ $service['id'] }}"
                                class="flex min-w-0 flex-col rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex min-w-0 items-start gap-3"><span
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-cyan-50 text-cyan-700 dark:bg-cyan-950/50 dark:text-cyan-300"><i
                                                data-lucide="badge-plus" class="h-5 w-5"></i></span>
                                        <div class="min-w-0">
                                            <h4
                                                class="break-words text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $service['name'] }}</h4>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                {{ $service['category'] }}</p>
                                        </div>
                                    </div><span
                                        class="shrink-0 rounded-full px-2 py-1 text-xs font-medium {{ $service['status'] === 'Available' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }}">{{ $service['status'] }}</span>
                                </div>
                                <p class="mt-4 flex-1 text-sm leading-5 text-gray-600 dark:text-gray-300">
                                    {{ $service['description'] }}</p>
                                <div
                                    class="mt-4 flex items-end justify-between gap-3 border-t border-gray-100 pt-3 dark:border-gray-700">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Price</p>
                                        <p class="mt-1 text-base font-semibold text-gray-900 dark:text-white">
                                            {{ number_format($service['price'], 0) }} <span
                                                class="text-xs font-normal">DZD</span></p>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $service['duration'] }} min</p>
                                    </div>
                                    <div class="flex gap-1"><button wire:click="editService({{ $service['id'] }})"
                                            title="Edit {{ $service['name'] }}"
                                            aria-label="Edit {{ $service['name'] }}"
                                            class="rounded-md p-2 text-gray-500 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-400 dark:hover:bg-blue-950/50 dark:hover:text-blue-300"><i
                                                data-lucide="pencil" class="h-5 w-5"></i></button><button
                                            wire:click="deleteService({{ $service['id'] }})"
                                            wire:confirm="Delete this service?" title="Delete {{ $service['name'] }}"
                                            aria-label="Delete {{ $service['name'] }}"
                                            class="rounded-md p-2 text-gray-500 hover:bg-red-50 hover:text-red-700 dark:text-gray-400 dark:hover:bg-red-950/50 dark:hover:text-red-300"><i
                                                data-lucide="trash-2" class="h-5 w-5"></i></button></div>
                                </div>
                            </article>
                        @empty
                            <p class="col-span-full py-8 text-center text-sm text-gray-500 dark:text-gray-400">No
                                services match your search.</p>
                        @endforelse
                    </div>
                @endif

                <div
                    class="flex flex-col gap-3 border-t border-gray-200 px-4 py-3 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if ($this->paginatedServices->total() > 0)
                            Showing
                            {{ $this->paginatedServices->firstItem() }}–{{ $this->paginatedServices->lastItem() }} of
                            {{ $this->paginatedServices->total() }} services
                        @else
                            Showing 0 services
                        @endif
                    </p>
                    <div class="flex items-center gap-2">
                        <button wire:click="previousPage" aria-label="Previous page" @disabled($this->paginatedServices->onFirstPage())
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700"><span
                                class="inline-flex items-center gap-1"><i data-lucide="chevron-left"
                                    class="h-4 w-4"></i><span class="hidden sm:inline">Previous</span></span></button>
                        <span
                            class="px-2 text-sm text-gray-600 dark:text-gray-300">{{ $this->paginatedServices->currentPage() }}
                            / {{ max(1, $this->paginatedServices->lastPage()) }}</span>
                        <button wire:click="nextPage" aria-label="Next page" @disabled(!$this->paginatedServices->hasMorePages())
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700"><span
                                class="inline-flex items-center gap-1"><span class="hidden sm:inline">Next</span><i
                                    data-lucide="chevron-right" class="h-4 w-4"></i></span></button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    @if ($showForm)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-950/50 p-4"
            wire:click.self="closeForm" role="dialog" aria-modal="true" aria-labelledby="service-form-title">
            <section
                class="max-h-[90vh] w-full max-w-xl overflow-y-auto rounded-xl bg-white p-5 shadow-xl dark:bg-gray-800 sm:p-6">
                <div class="mb-5 flex items-start justify-between gap-4">
                    <div>
                        <h2 id="service-form-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $editingId ? 'Edit service' : 'Create service' }}</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Enter the treatment details and
                            pricing.</p>
                    </div><button wire:click="closeForm"
                        class="rounded-md p-1 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                        aria-label="Close form"><i data-lucide="x" class="h-5 w-5"></i></button>
                </div>
                <form wire:submit="saveService" class="space-y-4">
                    <div><label for="service-name"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Service
                            name</label><input id="service-name" wire:model="name" type="text"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div><label for="service-category"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label><input
                            id="service-category" wire:model="category" type="text"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div><label for="service-description"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="service-description" wire:model="description" rows="3"
                            class="w-full resize-y rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white"></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div><label for="service-price"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Price
                                (DZD)</label><input id="service-price" wire:model="price" type="number"
                                min="0" step="100"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div><label for="service-duration"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Duration
                                (minutes)</label><input id="service-duration" wire:model="duration" type="number"
                                min="5" max="600" step="5"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div><label for="service-status"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label><select
                            id="service-status" wire:model="status"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            <option>Available</option>
                            <option>Unavailable</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div
                        class="flex flex-col-reverse gap-2 border-t border-gray-200 pt-4 dark:border-gray-700 sm:flex-row sm:justify-end">
                        <button type="button" wire:click="closeForm"
                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">Cancel</button><button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700"><i
                                data-lucide="check" class="h-4 w-4"></i> Save service</button></div>
                </form>
            </section>
        </div>
    @endif
</div>
