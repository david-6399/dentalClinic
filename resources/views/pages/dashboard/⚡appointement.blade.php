<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public array $appointmentData = [];
    public string $search = '';
    public string $statusFilter = '';
    public bool $showForm = false;
    public ?int $editingId = null;
    public string $patient = '';
    public string $appointmentDate = '';
    public string $appointmentTime = '';
    public string $treatment = '';
    public string $provider = '';
    public string $status = 'Confirmed';

    public function mount(): void
    {
        $today = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();
        $later = now()->addDays(2)->toDateString();

        $this->appointmentData = [
            ['id' => 1, 'patient' => 'Sofia Patel', 'date' => $today, 'time' => '08:30', 'treatment' => 'New patient exam', 'provider' => 'Dr. Carter', 'status' => 'Checked in'],
            ['id' => 2, 'patient' => 'Emily Carter', 'date' => $today, 'time' => '09:15', 'treatment' => 'Hygiene & polish', 'provider' => 'Dr. Nguyen', 'status' => 'In chair'],
            ['id' => 3, 'patient' => 'Marcus Lee', 'date' => $today, 'time' => '10:00', 'treatment' => 'Composite filling', 'provider' => 'Dr. Carter', 'status' => 'Confirmed'],
            ['id' => 4, 'patient' => 'Noah Williams', 'date' => $today, 'time' => '10:45', 'treatment' => 'Root canal review', 'provider' => 'Dr. Nguyen', 'status' => 'Confirmed'],
            ['id' => 5, 'patient' => 'Olivia Martin', 'date' => $today, 'time' => '11:30', 'treatment' => 'Dental cleaning', 'provider' => 'Dr. Carter', 'status' => 'Confirmed'],
            ['id' => 6, 'patient' => 'Ethan Brooks', 'date' => $tomorrow, 'time' => '08:45', 'treatment' => 'Crown consultation', 'provider' => 'Dr. Nguyen', 'status' => 'Confirmed'],
            ['id' => 7, 'patient' => 'Amelia Wilson', 'date' => $tomorrow, 'time' => '09:30', 'treatment' => 'Orthodontic check', 'provider' => 'Dr. Carter', 'status' => 'Confirmed'],
            ['id' => 8, 'patient' => 'Lucas Thompson', 'date' => $tomorrow, 'time' => '10:15', 'treatment' => 'Tooth extraction', 'provider' => 'Dr. Nguyen', 'status' => 'Confirmed'],
            ['id' => 9, 'patient' => 'Mia Robinson', 'date' => $tomorrow, 'time' => '13:00', 'treatment' => 'Whitening consultation', 'provider' => 'Dr. Carter', 'status' => 'Confirmed'],
            ['id' => 10, 'patient' => 'James Garcia', 'date' => $later, 'time' => '08:30', 'treatment' => 'Dental cleaning', 'provider' => 'Dr. Nguyen', 'status' => 'Confirmed'],
            ['id' => 11, 'patient' => 'Isabella Clark', 'date' => $later, 'time' => '09:15', 'treatment' => 'New patient exam', 'provider' => 'Dr. Carter', 'status' => 'Confirmed'],
            ['id' => 12, 'patient' => 'Benjamin Lewis', 'date' => $later, 'time' => '11:00', 'treatment' => 'Filling follow-up', 'provider' => 'Dr. Nguyen', 'status' => 'Confirmed'],
        ];
    }

    #[Computed]
    public function paginatedAppointments(): LengthAwarePaginator
    {
        $search = mb_strtolower(trim($this->search));
        $appointments = collect($this->appointmentData)
            ->filter(function (array $appointment) use ($search): bool {
                $searchable = mb_strtolower(implode(' ', [$appointment['patient'], $appointment['treatment'], $appointment['provider']]));
                $matchesSearch = $search === '' || str_contains($searchable, $search);
                $matchesStatus = $this->statusFilter === '' || $appointment['status'] === $this->statusFilter;

                return $matchesSearch && $matchesStatus;
            })
            ->sortBy(fn(array $appointment) => $appointment['date'] . ' ' . $appointment['time'])
            ->values();

        $perPage = 5;
        $page = $this->getPage();

        return new LengthAwarePaginator($appointments->forPage($page, $perPage)->values(), $appointments->count(), $perPage, $page, ['path' => request()->url(), 'pageName' => 'page']);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function openCreateForm(): void
    {
        $this->resetForm();
        $this->appointmentDate = now()->toDateString();
        $this->showForm = true;
    }

    public function editAppointment(int $id): void
    {
        $appointment = collect($this->appointmentData)->firstWhere('id', $id);

        if (!$appointment) {
            return;
        }

        $this->editingId = $id;
        $this->patient = $appointment['patient'];
        $this->appointmentDate = $appointment['date'];
        $this->appointmentTime = $appointment['time'];
        $this->treatment = $appointment['treatment'];
        $this->provider = $appointment['provider'];
        $this->status = $appointment['status'];
        $this->showForm = true;
    }

    public function saveAppointment(): void
    {
        $validated = $this->validate([
            'patient' => ['required', 'string', 'max:120'],
            'appointmentDate' => ['required', 'date'],
            'appointmentTime' => ['required', 'date_format:H:i'],
            'treatment' => ['required', 'string', 'max:120'],
            'provider' => ['required', 'string', 'max:120'],
            'status' => ['required', 'in:Confirmed,Checked in,In chair,Completed,Cancelled'],
        ]);

        $appointment = [
            'patient' => $validated['patient'],
            'date' => $validated['appointmentDate'],
            'time' => $validated['appointmentTime'],
            'treatment' => $validated['treatment'],
            'provider' => $validated['provider'],
            'status' => $validated['status'],
        ];

        if ($this->editingId !== null) {
            foreach ($this->appointmentData as $index => $existingAppointment) {
                if ($existingAppointment['id'] === $this->editingId) {
                    $this->appointmentData[$index] = ['id' => $this->editingId, ...$appointment];
                    break;
                }
            }
        } else {
            $appointment['id'] = (collect($this->appointmentData)->max('id') ?? 0) + 1;
            $this->appointmentData[] = $appointment;
        }

        $this->showForm = false;
        $this->resetForm();
        $this->resetPage();
    }

    public function deleteAppointment(int $id): void
    {
        $this->appointmentData = array_values(array_filter($this->appointmentData, fn(array $appointment) => $appointment['id'] !== $id));

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
        $this->patient = '';
        $this->appointmentDate = '';
        $this->appointmentTime = '';
        $this->treatment = '';
        $this->provider = '';
        $this->status = 'Confirmed';
    }

    public function render()
    {
        return $this->view()->layout('layouts::dashboard');
    }
};
?>

<div class="flex min-h-screen flex-col">
    <header
        class="flex items-center justify-between border-b border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-800 md:hidden"
                aria-label="Open navigation">
                <i data-lucide="menu" class="h-5 w-5 text-gray-600 dark:text-gray-400"></i>
            </button>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Dental Clinic / Schedule</p>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Appointments</h1>
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
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Appointment schedule</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Review and manage upcoming patient visits.
                    </p>
                </div>
                <button wire:click="openCreateForm"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    <i data-lucide="plus" class="h-4 w-4"></i>
                    New appointment
                </button>
            </div>

            <div
                class="rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800 dark:border-blue-900 dark:bg-blue-950/40 dark:text-blue-200">
                Demonstration records only. Changes are temporary and are not saved to a database.
            </div>

            <section
                class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
                aria-label="Appointments list">
                <div
                    class="flex flex-col gap-3 border-b border-gray-200 p-4 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">All appointments</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $this->paginatedAppointments->total() }} scheduled visits</p>
                    </div>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <label class="relative">
                            <span class="sr-only">Search appointments</span>
                            <i data-lucide="search"
                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"></i>
                            <input wire:model.live.debounce.300ms="search" type="search"
                                placeholder="Search patient or treatment"
                                class="w-full rounded-lg border border-gray-300 bg-white py-2 pl-9 pr-3 text-sm text-gray-900 placeholder:text-gray-400 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white sm:w-64">
                        </label>
                        <label>
                            <span class="sr-only">Filter by status</span>
                            <select wire:model.live="statusFilter"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-200 sm:w-40">
                                <option value="">All statuses</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Checked in">Checked in</option>
                                <option value="In chair">In chair</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="space-y-3 p-4 md:hidden">
                    @forelse ($this->paginatedAppointments as $appointment)
                        @php
                            $mobileStatusClasses = match ($appointment['status']) {
                                'Checked in' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                'In chair' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                                'Completed' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                'Cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                            };
                        @endphp
                        <article wire:key="appointment-mobile-{{ $appointment['id'] }}"
                            class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <h4 class="truncate text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $appointment['patient'] }} </h4>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $appointment['treatment'] }}</p>
                                </div>
                                <span
                                    class="shrink-0 rounded-full px-2.5 py-1 text-xs font-medium {{ $mobileStatusClasses }}">{{ $appointment['status'] }}</span>
                            </div>
                            <dl class="mt-3 grid grid-cols-2 gap-x-3 gap-y-2 text-sm">
                                <div>
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Date &amp; time</dt>
                                    <dd class="mt-0.5 text-gray-800 dark:text-gray-200">
                                        {{ \Carbon\Carbon::parse($appointment['date'])->format('M j') }} ·
                                        {{ \Carbon\Carbon::createFromFormat('H:i', $appointment['time'])->format('g:i A') }}
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500 dark:text-gray-400">Provider </dt>
                                    <dd class="mt-0.5 text-gray-800 dark:text-gray-200">{{ $appointment['provider'] }}
                                    </dd>
                                </div>
                            </dl>
                            <div class="mt-3 flex justify-end gap-2 border-t border-gray-100 pt-2 dark:border-gray-700">
                                <button wire:click="editAppointment({{ $appointment['id'] }})"
                                    class="inline-flex items-center gap-1 rounded-md px-2 py-1.5 text-sm font-medium text-blue-700 hover:bg-blue-50 dark:text-blue-300 dark:hover:bg-blue-950/50">
                                    <i data-lucide="pencil" class="h-4 w-4"></i> Edit
                                </button>
                                <button wire:click="deleteAppointment({{ $appointment['id'] }})"
                                    wire:confirm="Delete this appointment?"
                                    class="inline-flex items-center gap-1 rounded-md px-2 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50 dark:text-red-300 dark:hover:bg-red-950/50">
                                    <i data-lucide="trash-2" class="h-4 w-4"></i> Delete
                                </button>
                            </div>
                        </article>
                    @empty
                        <p class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">No appointments found.</p>
                    @endforelse
                </div>

                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full min-w-[850px] text-left">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Date &amp; time</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Patient</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Treatment</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Provider</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($this->paginatedAppointments as $appointment)
                                @php
                                    $statusClasses = match ($appointment['status']) {
                                        'Checked in'
                                            => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                        'In chair'
                                            => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                                        'Completed'
                                            => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                        'Cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };
                                @endphp
                                <tr wire:key="appointment-{{ $appointment['id'] }}"
                                    class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($appointment['date'])->format('M j, Y') }}</p>
                                        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::createFromFormat('H:i', $appointment['time'])->format('g:i A') }}
                                        </p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $appointment['patient'] }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $appointment['treatment'] }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $appointment['provider'] }}</td>
                                    <td class="whitespace-nowrap px-6 py-4"><span
                                            class="rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClasses }}">{{ $appointment['status'] }}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex justify-end gap-1">
                                            <button wire:click="editAppointment({{ $appointment['id'] }})"
                                                title="Edit appointment"
                                                aria-label="Edit appointment for {{ $appointment['patient'] }}"
                                                class="rounded-md p-2 text-gray-500 transition hover:bg-blue-50 hover:text-blue-700 dark:text-gray-400 dark:hover:bg-blue-950/50 dark:hover:text-blue-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>

                                            </button>
                                            <button wire:click="deleteAppointment({{ $appointment['id'] }})"
                                                wire:confirm="Delete this appointment?" title="Delete appointment"
                                                aria-label="Delete appointment for {{ $appointment['patient'] }}"
                                                class="rounded-md p-2 text-gray-500 transition hover:bg-red-50 hover:text-red-700 dark:text-gray-400 dark:hover:bg-red-950/50 dark:hover:text-red-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>


                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <i data-lucide="calendar-x" class="mx-auto h-8 w-8 text-gray-400"></i>
                                        <p class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No
                                            appointments found</p>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try another search or
                                            create a new appointment.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="flex flex-col gap-3 border-t border-gray-200 px-4 py-3 dark:border-gray-700 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if ($this->paginatedAppointments->total() > 0)
                            Showing
                            {{ $this->paginatedAppointments->firstItem() }}–{{ $this->paginatedAppointments->lastItem() }}
                            of {{ $this->paginatedAppointments->total() }} appointments
                        @else
                            Showing 0 appointments
                        @endif
                    </p>
                    <div class="flex items-center gap-2">
                        <button wire:click="previousPage" @disabled($this->paginatedAppointments->onFirstPage())
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                            <span class="inline-flex items-center gap-1"><i data-lucide="chevron-left"
                                    class="h-4 w-4"></i> Previous</span>
                        </button>
                        <span class="px-2 text-sm text-gray-600 dark:text-gray-300">Page
                            {{ $this->paginatedAppointments->currentPage() }} of
                            {{ max(1, $this->paginatedAppointments->lastPage()) }}</span>
                        <button wire:click="nextPage" @disabled(!$this->paginatedAppointments->hasMorePages())
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-40 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
                            <span class="inline-flex items-center gap-1">Next <i data-lucide="chevron-right"
                                    class="h-4 w-4"></i></span>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    @if ($showForm)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-950/50 p-4"
            wire:click.self="closeForm" role="dialog" aria-modal="true" aria-labelledby="appointment-form-title">
            <section class="w-full max-w-xl rounded-xl bg-white p-6 shadow-xl dark:bg-gray-800">
                <div class="mb-5 flex items-start justify-between gap-4">
                    <div>
                        <h2 id="appointment-form-title" class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $editingId ? 'Edit appointment' : 'New appointment' }}</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Enter the patient visit details.</p>
                    </div>
                    <button wire:click="closeForm"
                        class="rounded-md p-1 text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                        aria-label="Close form"><i data-lucide="x" class="h-5 w-5"></i></button>
                </div>

                <form wire:submit="saveAppointment" class="space-y-4">
                    <div>
                        <label for="patient"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Patient</label>
                        <input id="patient" wire:model="patient" type="text"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        @error('patient')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="appointmentDate"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input id="appointmentDate" wire:model="appointmentDate" type="date"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('appointmentDate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="appointmentTime"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Time</label>
                            <input id="appointmentTime" wire:model="appointmentTime" type="time"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('appointmentTime')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="treatment"
                            class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Treatment</label>
                        <input id="treatment" wire:model="treatment" type="text"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                        @error('treatment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="provider"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Provider</label>
                            <input id="provider" wire:model="provider" type="text"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            @error('provider')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status"
                                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select id="status" wire:model="status"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                                <option>Confirmed</option>
                                <option>Checked in</option>
                                <option>In chair</option>
                                <option>Completed</option>
                                <option>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-4 dark:border-gray-700">
                        <button type="button" wire:click="closeForm"
                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">Cancel</button>
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white hover:bg-primary-700">
                            <i data-lucide="check" class="h-4 w-4"></i>
                            {{ $editingId ? 'Save changes' : 'Create appointment' }}
                        </button>
                    </div>
                </form>
            </section>
        </div>
    @endif
</div>
