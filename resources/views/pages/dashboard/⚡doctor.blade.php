<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';
    public array $doctors = [
        ['idubu' => 1, 'name' => 'Dr. Ahmed Benali', 'specialty' => 'Implantology', 'email' => 'ahmed.benali@novadental.com', 'phone' => '+213 555 010 241', 'experience' => 15, 'patients' => 248, 'status' => 'Active'],
        ['id' => 2, 'name' => 'Dr. Sarah Meziani', 'specialty' => 'Orthodontics', 'email' => 'sarah.meziani@novadental.com', 'phone' => '+213 555 010 392', 'experience' => 10, 'patients' => 186, 'status' => 'Active'],
        ['id' => 3, 'name' => 'Dr. Karim Hadj', 'specialty' => 'Pediatric dentistry', 'email' => 'karim.hadj@novadental.com', 'phone' => '+213 555 010 517', 'experience' => 8, 'patients' => 143, 'status' => 'Active'],
        ['id' => 4, 'name' => 'Dr. Lina Cherif', 'specialty' => 'Cosmetic dentistry', 'email' => 'lina.cherif@novadental.com', 'phone' => '+213 555 010 628', 'experience' => 12, 'patients' => 201, 'status' => 'Active'],
        ['id' => 5, 'name' => 'Dr. Yacine Amrani', 'specialty' => 'Endodontics', 'email' => 'yacine.amrani@novadental.com', 'phone' => '+213 555 010 733', 'experience' => 7, 'patients' => 112, 'status' => 'On leave'],
        ['id' => 6, 'name' => 'Dr. Nadia Bensaid', 'specialty' => 'Periodontics', 'email' => 'nadia.bensaid@novadental.com', 'phone' => '+213 555 010 846', 'experience' => 11, 'patients' => 174, 'status' => 'Active'],
        ['id' => 7, 'name' => 'Dr. Rami Khelifi', 'specialty' => 'Oral surgery', 'email' => 'rami.khelifi@novadental.com', 'phone' => '+213 555 010 951', 'experience' => 9, 'patients' => 158, 'status' => 'Active'],
        ['id' => 8, 'name' => 'Dr. Maya Touati', 'specialty' => 'General dentistry', 'email' => 'maya.touati@novadental.com', 'phone' => '+213 555 010 164', 'experience' => 6, 'patients' => 96, 'status' => 'Active'],
    ];
    public bool $showForm = false;
    public ?int $editingId = null;
    public string $name = '';
    public string $specialty = '';
    public string $email = '';
    public string $phone = '';
    public string $experience = '';
    public string $status = 'Active';

    #[Computed]
    public function paginatedDoctors(): LengthAwarePaginator
    {
        $search = mb_strtolower(trim($this->search));
        $doctors = collect($this->doctors)->filter(fn(array $doctor) => $search === '' || str_contains(mb_strtolower(implode(' ', [$doctor['name'], $doctor['specialty'], $doctor['email'], $doctor['phone'], $doctor['status']])), $search))->sortBy('name')->values();

        $perPage = 6;
        $page = $this->getPage();

        return new LengthAwarePaginator($doctors->forPage($page, $perPage)->values(), $doctors->count(), $perPage, $page, ['path' => request()->url(), 'pageName' => 'page']);
    }

    #[Computed]
    public function activeDoctors(): int
    {
        return collect($this->doctors)->where('status', 'Active')->count();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function openCreateForm(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function editDoctor(int $id): void
    {
        $doctor = collect($this->doctors)->firstWhere('id', $id);

        if (!$doctor) {
            return;
        }

        $this->editingId = $id;
        $this->name = $doctor['name'];
        $this->specialty = $doctor['specialty'];
        $this->email = $doctor['email'];
        $this->phone = $doctor['phone'];
        $this->experience = (string) $doctor['experience'];
        $this->status = $doctor['status'];
        $this->showForm = true;
    }

    public function saveDoctor(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:120'],
            'specialty' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'experience' => ['required', 'integer', 'min:0', 'max:70'],
            'status' => ['required', 'in:Active,On leave'],
        ]);

        $doctor = [...$validated, 'experience' => (int) $validated['experience'], 'patients' => 0];

        if ($this->editingId !== null) {
            foreach ($this->doctors as $index => $existingDoctor) {
                if ($existingDoctor['id'] === $this->editingId) {
                    $this->doctors[$index] = ['id' => $this->editingId, 'patients' => $existingDoctor['patients'], ...$doctor];
                    break;
                }
            }
        } else {
            $doctor['id'] = (collect($this->doctors)->max('id') ?? 0) + 1;
            $this->doctors[] = $doctor;
        }

        $this->closeForm();
        $this->resetPage();
    }

    public function deleteDoctor(int $id): void
    {
        $this->doctors = array_values(array_filter($this->doctors, fn(array $doctor) => $doctor['id'] !== $id));
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
        $this->specialty = '';
        $this->email = '';
        $this->phone = '';
        $this->experience = '';
        $this->status = 'Active';
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
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Doctors</h1>
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
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Medical team</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your clinic’s doctors and
                        specialties.</p>
                </div>
                <button wire:click="openCreateForm"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                    <i data-lucide="plus" class="h-4 w-4"></i> Add doctor
                </button>
            </div>

            <section aria-label="Doctor statistics" class="grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <article
                    class="flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-50 text-blue-700 dark:bg-blue-950/50 dark:text-blue-300"><i
                            data-lucide="users" class="h-5 w-5"></i></span>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total doctors</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ count($doctors) }}</p>
                    </div>
                </article>
                <article
                    class="flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-lg bg-green-50 text-green-700 dark:bg-green-950/50 dark:text-green-300"><i
                            data-lucide="user-check" class="h-5 w-5"></i></span>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Available</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">{{ $this->activeDoctors }}
                        </p>
                    </div>
                </article>
                <article
                    class="flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-lg bg-cyan-50 text-cyan-700 dark:bg-cyan-950/50 dark:text-cyan-300"><i
                            data-lucide="stethoscope" class="h-5 w-5"></i></span>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Specialties</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ collect($doctors)->pluck('specialty')->unique()->count() }}</p>
                    </div>
                </article>
                <article
                    class="flex items-center gap-4 rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-lg bg-amber-50 text-amber-700 dark:bg-amber-950/50 dark:text-amber-300"><i
                            data-lucide="briefcase-medical" class="h-5 w-5"></i></span>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Patient panel</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ number_format(collect($doctors)->sum('patients')) }}</p>
                    </div>
                </article>
            </section>

            <div
                class="rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800 dark:border-blue-900 dark:bg-blue-950/40 dark:text-blue-200">
                Demonstration records only. Changes are temporary and are not saved to a database.
            </div>

            <section
                class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
                aria-label="Doctors list">
                <div
                    class="flex flex-col gap-3 border-b border-gray-200 p-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">All doctors</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $this->paginatedDoctors->total() }}
                            team members</p>
                    </div>
                    <label class="relative block w-full sm:w-72">
                        <span class="sr-only">Search doctors</span>
                        <i data-lucide="search"
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"></i>
                        <input wire:model.live.debounce.300ms="search" type="search"
                            placeholder="Search name or specialty"
                            class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-9 pr-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                    </label>
                </div>

                <div class="space-y-3 p-4 md:hidden">
                    @forelse ($this->paginatedDoctors as $doctor)
                        <article wire:key="doctor-mobile-{{ $doctor['id'] }}"
                            class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary-100 text-xs font-semibold text-primary-700 dark:bg-primary-900/50 dark:text-primary-200">
                                    {{ collect(explode(' ', str_replace('Dr. ', '', $doctor['name'])))->map(fn($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="truncate text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $doctor['name'] }}</h4>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $doctor['specialty'] }}
                                    </p>
                                </div>
                                <span
                                    class="shrink-0 rounded-full px-2 py-1 text-xs font-medium {{ $doctor['status'] === 'Active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' }}">{{ $doctor['status'] }}</span>
                            </div>
                            <dl
                                class="mt-3 grid grid-cols-2 gap-x-3 gap-y-2 border-t border-gray-100 pt-3 text-sm dark:border-gray-700">
                                <div class="col-span-2 min-w-0">
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="truncate text-gray-800 dark:text-gray-200">{{ $doctor['email'] }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Experience</dt>
                                    <dd class="text-gray-800 dark:text-gray-200">{{ $doctor['experience'] }} years</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Patients</dt>
                                    <dd class="text-gray-800 dark:text-gray-200">
                                        {{ number_format($doctor['patients']) }}</dd>
                                </div>
                            </dl>
                            <div class="mt-3 flex justify-end gap-2 border-t border-gray-100 pt-2 dark:border-gray-700">
                                <button wire:click="editDoctor({{ $doctor['id'] }})"
                                    class="inline-flex items-center gap-1 rounded-md px-2 py-1.5 text-sm font-medium text-blue-700 hover:bg-blue-50 dark:text-blue-300 dark:hover:bg-blue-950/50"><i
                                        data-lucide="pencil" class="h-4 w-4"></i> Edit</button>
                                <button wire:click="deleteDoctor({{ $doctor['id'] }})"
                                    wire:confirm="Delete this doctor?"
                                    class="inline-flex items-center gap-1 rounded-md px-2 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 dark:text-red-300 dark:hover:bg-red-950/50"><i
                                        data-lucide="trash-2" class="h-4 w-4"></i> Delete</button>
                            </div>
                        </article>
                    @empty
                        <p class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">No doctors match your
                            search.</p>
                    @endforelse
                </div>

                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full min-w-[850px] text-left">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Doctor</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Specialty</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Contact</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Experience</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Patients</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($this->paginatedDoctors as $doctor)
                                <tr wire:key="doctor-{{ $doctor['id'] }}"
                                    class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-100 text-xs font-semibold text-primary-700 dark:bg-primary-900/50 dark:text-primary-200">
                                                {{ collect(explode(' ', str_replace('Dr. ', '', $doctor['name'])))->map(fn($part) => mb_substr($part, 0, 1))->take(2)->implode('') }}
                                            </div><span
                                                class="text-sm font-medium text-gray-900 dark:text-white">{{ $doctor['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $doctor['specialty'] }}</td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-800 dark:text-gray-200">{{ $doctor['phone'] }}</p>
                                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $doctor['email'] }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $doctor['experience'] }} years</td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ number_format($doctor['patients']) }}</td>
                                    <td class="whitespace-nowrap px-6 py-4"><span
                                            class="rounded-full px-2.5 py-1 text-xs font-medium {{ $doctor['status'] === 'Active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' }}">{{ $doctor['status'] }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex justify-end gap-1">
                                            <button wire:click="editDoctor({{ $doctor['id'] }})" title="Edit doctor"
                                                aria-label="Edit {{ $doctor['name'] }}"
                                                class="rounded-md p-2 text-gray-500 transition hover:bg-blue-50 hover:text-blue-700 dark:text-gray-400 dark:hover:bg-blue-950/50 dark:hover:text-blue-300"><i
                                                    data-lucide="pencil" class="h-5 w-5"></i></button>
                                            <button wire:click="deleteDoctor({{ $doctor['id'] }})"
                                                wire:confirm="Delete this doctor?" title="Delete doctor"
                                                aria-label="Delete {{ $doctor['name'] }}"
                                                class="rounded-md p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-700 dark:text-gray-400 dark:hover:bg-red-950/50 dark:hover:text-red-300"><i
                                                    data-lucide="trash-2" class="h-5 w-5"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="px-6 py-12 text-center text-sm text-gray-500 dark:text-gray-400">No
                                        doctors match your search.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="flex flex-col gap-3 border-t border-gray-200 px-4 py-3 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if ($this->paginatedDoctors->total() > 0)
                            Showing
                            {{ $this->paginatedDoctors->firstItem() }}–{{ $this->paginatedDoctors->lastItem() }} of
                            {{ $this->paginatedDoctors->total() }} doctors
                        @else
                            Showing 0 doctors
                        @endif
                    </p>
                    <div class="flex items-center gap-2">
                        <button wire:click="previousPage" aria-label="Previous page" @disabled($this->paginatedDoctors->onFirstPage())
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700"><span
                                class="inline-flex items-center gap-1"><i data-lucide="chevron-left"
                                    class="h-4 w-4"></i><span class="hidden sm:inline">Previous</span></span></button>
                        <span
                            class="px-2 text-sm text-gray-600 dark:text-gray-300">{{ $this->paginatedDoctors->currentPage() }}
                            / {{ max(1, $this->paginatedDoctors->lastPage()) }}</span>
                        <button wire:click="nextPage" aria-label="Next page" @disabled(!$this->paginatedDoctors->hasMorePages())
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
            wire:click.self="closeForm" role="dialog" aria-modal="true" aria-labelledby="doctor-form-title">
            <section
                class="max-h-[90vh] w-full max-w-xl overflow-y-auto rounded-xl bg-white p-5 shadow-xl dark:bg-gray-800 sm:p-6">
                <div class="mb-5 flex items-start justify-between gap-4">
                    <div>
                        <h2 id="doctor-form-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $editingId ? 'Edit doctor' : 'Add doctor' }}</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Enter the doctor’s professional
                            details.</p>
                    </div>
                    <button wire:click="closeForm"
                        class="rounded-md p-1 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                        aria-label="Close form"><i data-lucide="x" class="h-5 w-5"></i></button>
                </div>
                <form wire:submit="saveDoctor" class="space-y-4">
                    <div><label for="doctor-name"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Full
                            name</label><input id="doctor-name" wire:model="name" type="text"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div><label for="doctor-specialty"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Specialty</label><input
                            id="doctor-specialty" wire:model="specialty" type="text"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        @error('specialty')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div><label for="doctor-email"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label><input
                                id="doctor-email" wire:model="email" type="email"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div><label for="doctor-phone"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label><input
                                id="doctor-phone" wire:model="phone" type="tel"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div><label for="doctor-experience"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Years of
                                experience</label><input id="doctor-experience" wire:model="experience"
                                type="number" min="0" max="70"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('experience')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div><label for="doctor-status"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label><select
                                id="doctor-status" wire:model="status"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                                <option>Active</option>
                                <option>On leave</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div
                        class="flex flex-col-reverse gap-2 border-t border-gray-200 pt-4 dark:border-gray-700 sm:flex-row sm:justify-end">
                        <button type="button" wire:click="closeForm"
                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">Cancel</button>
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700"><i
                                data-lucide="check" class="h-4 w-4"></i> Save doctor</button>
                    </div>
                </form>
            </section>
        </div>
    @endif
</div>
