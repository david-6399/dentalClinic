<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public array $patientRecords = [
        ['id' => 1, 'name' => 'Olivia Martin', 'phone' => '(555) 018-2486', 'email' => 'olivia.martin@example.com', 'last_visit' => '2026-09-24', 'visits' => 12, 'last_treatment' => 'Dental cleaning'],
        ['id' => 2, 'name' => 'Marcus Lee', 'phone' => '(555) 014-7203', 'email' => 'marcus.lee@example.com', 'last_visit' => '2026-09-22', 'visits' => 9, 'last_treatment' => 'Composite filling'],
        ['id' => 3, 'name' => 'Sofia Patel', 'phone' => '(555) 017-5321', 'email' => 'sofia.patel@example.com', 'last_visit' => '2026-09-20', 'visits' => 8, 'last_treatment' => 'New patient exam'],
        ['id' => 4, 'name' => 'Noah Williams', 'phone' => '(555) 012-8054', 'email' => 'noah.williams@example.com', 'last_visit' => '2026-09-18', 'visits' => 7, 'last_treatment' => 'Root canal review'],
        ['id' => 5, 'name' => 'Emily Carter', 'phone' => '(555) 016-4408', 'email' => 'emily.carter@example.com', 'last_visit' => '2026-09-16', 'visits' => 6, 'last_treatment' => 'Hygiene & polish'],
        ['id' => 6, 'name' => 'Ethan Brooks', 'phone' => '(555) 011-9762', 'email' => 'ethan.brooks@example.com', 'last_visit' => '2026-09-12', 'visits' => 5, 'last_treatment' => 'Crown consultation'],
        ['id' => 7, 'name' => 'Amelia Wilson', 'phone' => '(555) 019-3367', 'email' => 'amelia.wilson@example.com', 'last_visit' => '2026-09-10', 'visits' => 4, 'last_treatment' => 'Orthodontic check'],
        ['id' => 8, 'name' => 'Lucas Thompson', 'phone' => '(555) 013-1580', 'email' => 'lucas.thompson@example.com', 'last_visit' => '2026-09-08', 'visits' => 3, 'last_treatment' => 'Tooth extraction'],
        ['id' => 9, 'name' => 'Mia Robinson', 'phone' => '(555) 015-2904', 'email' => 'mia.robinson@example.com', 'last_visit' => '2026-09-04', 'visits' => 2, 'last_treatment' => 'Whitening consultation'],
        ['id' => 10, 'name' => 'James Garcia', 'phone' => '(555) 010-7712', 'email' => 'james.garcia@example.com', 'last_visit' => '2026-08-29', 'visits' => 1, 'last_treatment' => 'Dental cleaning'],
        ['id' => 11, 'name' => 'Isabella Clark', 'phone' => '(555) 018-9035', 'email' => 'isabella.clark@example.com', 'last_visit' => '2026-08-25', 'visits' => 1, 'last_treatment' => 'New patient exam'],
        ['id' => 12, 'name' => 'Benjamin Lewis', 'phone' => '(555) 014-6110', 'email' => 'benjamin.lewis@example.com', 'last_visit' => '2026-08-21', 'visits' => 1, 'last_treatment' => 'Filling follow-up'],
    ];

    #[Computed]
    public function paginatedPatients(): LengthAwarePaginator
    {
        $search = mb_strtolower(trim($this->search));
        $patients = collect($this->patientRecords)->filter(fn(array $patient) => $search === '' || str_contains(mb_strtolower(implode(' ', [$patient['name'], $patient['phone'], $patient['email'], $patient['last_treatment']])), $search))->sortBy('name')->values();

        $perPage = 6;
        $page = $this->getPage();

        return new LengthAwarePaginator($patients->forPage($page, $perPage)->values(), $patients->count(), $perPage, $page, ['path' => request()->url(), 'pageName' => 'page']);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
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
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Patients</h1>
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
            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Patient directory</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Patients who have visited the clinic and
                        their visit history.</p>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Sample clinic records</span>
            </div>

            <section aria-label="Most frequent patients" class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
                @foreach (collect($this->patientRecords)->sortByDesc('visits')->take(4) as $featuredPatient)
                    <article wire:key="featured-patient-{{ $featuredPatient['id'] }}"
                        class="flex min-w-0 items-center gap-3 border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary-100 text-sm font-semibold text-primary-700 dark:bg-primary-900/50 dark:text-primary-200">
                            {{ collect(explode(' ', $featuredPatient['name']))->map(fn($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="truncate text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $featuredPatient['name'] }}</h3>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $featuredPatient['visits'] }}
                                clinic visits</p>
                        </div>
                    </article>
                @endforeach
            </section>

            <section
                class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
                aria-label="All patients">
                <div
                    class="flex flex-col gap-3 border-b border-gray-200 p-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">All patients</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $this->paginatedPatients->total() }}
                            patient records</p>
                    </div>
                    <label class="relative block w-full sm:w-72">
                        <span class="sr-only">Search patients</span>
                        <i data-lucide="search"
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"></i>
                        <input wire:model.live.debounce.300ms="search" type="search"
                            placeholder="Search name, contact or visit"
                            class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-9 pr-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                    </label>
                </div>

                <div class="space-y-3 p-4 md:hidden">
                    @forelse ($this->paginatedPatients as $patient)
                        <article wire:key="patient-mobile-{{ $patient['id'] }}"
                            class="border border-gray-200 p-4 dark:border-gray-700">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary-100 text-xs font-semibold text-primary-700 dark:bg-primary-900/50 dark:text-primary-200">
                                    {{ collect(explode(' ', $patient['name']))->map(fn($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="truncate text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $patient['name'] }}</h4>
                                    <p class="truncate text-sm text-gray-500 dark:text-gray-400">{{ $patient['phone'] }}
                                    </p>
                                </div>
                                <span
                                    class="shrink-0 rounded-full bg-primary-50 px-2 py-1 text-xs font-medium text-primary-700 dark:bg-primary-900/40 dark:text-primary-200">{{ $patient['visits'] }}
                                    visits</span>
                            </div>
                            <dl
                                class="mt-3 grid grid-cols-2 gap-x-3 gap-y-2 border-t border-gray-100 pt-3 text-sm dark:border-gray-700">
                                <div class="col-span-2 min-w-0">
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="truncate text-gray-800 dark:text-gray-200">{{ $patient['email'] }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Last visit</dt>
                                    <dd class="text-gray-800 dark:text-gray-200">
                                        {{ \Carbon\Carbon::parse($patient['last_visit'])->format('M j, Y') }}</dd>
                                </div>
                                <div class="min-w-0">
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Last treatment</dt>
                                    <dd class="truncate text-gray-800 dark:text-gray-200">
                                        {{ $patient['last_treatment'] }}</dd>
                                </div>
                            </dl>
                        </article>
                    @empty
                        <p class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">No patients match your
                            search.</p>
                    @endforelse
                </div>

                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full min-w-[850px] text-left">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Patient</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Contact</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Last visit</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Visits</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Last treatment</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($this->paginatedPatients as $patient)
                                <tr wire:key="patient-{{ $patient['id'] }}"
                                    class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-100 text-xs font-semibold text-primary-700 dark:bg-primary-900/50 dark:text-primary-200">
                                                {{ collect(explode(' ', $patient['name']))->map(fn($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                                            </div>
                                            <span
                                                class="text-sm font-medium text-gray-900 dark:text-white">{{ $patient['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-800 dark:text-gray-200">{{ $patient['phone'] }}</p>
                                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $patient['email'] }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($patient['last_visit'])->format('M j, Y') }}</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $patient['visits'] }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $patient['last_treatment'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">No
                                        patients match your search.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="flex flex-col gap-3 border-t border-gray-200 px-4 py-3 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if ($this->paginatedPatients->total() > 0)
                            Showing
                            {{ $this->paginatedPatients->firstItem() }}–{{ $this->paginatedPatients->lastItem() }} of
                            {{ $this->paginatedPatients->total() }} patients
                        @else
                            Showing 0 patients
                        @endif
                    </p>
                    <div class="flex items-center gap-2">
                        <button wire:click="previousPage" @disabled($this->paginatedPatients->onFirstPage())
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                            <span class="inline-flex items-center gap-1"><i data-lucide="chevron-left"
                                    class="h-4 w-4"></i><span class="hidden sm:inline">Previous</span></span>
                        </button>
                        <span
                            class="px-2 text-sm text-gray-600 dark:text-gray-300">{{ $this->paginatedPatients->currentPage() }}
                            / {{ max(1, $this->paginatedPatients->lastPage()) }}</span>
                        <button wire:click="nextPage" @disabled(!$this->paginatedPatients->hasMorePages())
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                            <span class="inline-flex items-center gap-1"><span class="hidden sm:inline">Next</span><i
                                    data-lucide="chevron-right" class="h-4 w-4"></i></span>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>
