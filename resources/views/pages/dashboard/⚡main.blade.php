<?php

use Livewire\Component;


new class extends Component {
    public function render()
    {
        return $this->view()->layout('layouts::dashboard');
    }
};
?>

<div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
    
    <!-- Header -->
    <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <button onclick="toggleSidebar()"
                    class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                    <i data-lucide="menu" class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
                </button>

                <div class="relative hidden sm:block">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                    <input type="text" placeholder="Search patients, appointments..."
                        class="pl-10 pr-4 py-2 w-80 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" />
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <button onclick="toggleTheme()"
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <i data-lucide="sun" class="w-5 h-5 text-gray-600 dark:text-gray-400 dark:hidden"></i>
                    <i data-lucide="moon" class="w-5 h-5 text-gray-600 dark:text-gray-400 hidden dark:block"></i>
                </button>

                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors relative">
                    <i data-lucide="bell" class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                </button>

                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">CM</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Clinic Manager</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Practice administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 overflow-y-auto">
        <div id="overview" class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Clinic overview</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Sample clinic data for appointments, patient
                    care and collections.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Appointments today</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">28</p>
                            <div class="flex items-center mt-2">
                                <i data-lucide="arrow-up" class="w-4 h-4 text-green-500"></i>
                                <span class="text-sm ml-1 text-green-500">+4</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">vs. daily
                                    average</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="calendar-check" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Active patients</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">1,284</p>
                            <div class="flex items-center mt-2">
                                <i data-lucide="arrow-up" class="w-4 h-4 text-green-500"></i>
                                <span class="text-sm ml-1 text-green-500">+6.2%</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">this quarter</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="users" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Chair utilization</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">84%</p>
                            <div class="flex items-center mt-2">
                                <i data-lucide="arrow-up" class="w-4 h-4 text-green-500"></i>
                                <span class="text-sm ml-1 text-green-500">+7%</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">vs. last
                                    month</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="armchair" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p id="billing" class="text-sm text-gray-600 dark:text-gray-400">Outstanding
                                balance</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">$3,240</p>
                            <div class="flex items-center mt-2">
                                <i data-lucide="arrow-up" class="w-4 h-4 text-green-500"></i>
                                <span class="text-sm ml-1 text-green-500">12 accounts</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-1">awaiting
                                    payment</span>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="receipt" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div id="reports" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Treatment revenue chart -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Treatment revenue
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Collected fees over the last
                                six months</p>
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 rounded-lg">6M</button>
                            <button
                                class="px-3 py-1 text-xs font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">1Y</button>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Appointment activity chart -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Appointment
                                activity</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Booked and completed visits by month</p>
                        </div>
                        <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <i data-lucide="more-vertical" class="w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                        </button>
                    </div>
                    <div class="h-64">
                        <canvas id="appointmentChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Additional Stats and Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Treatment mix -->
                <div id="treatment-mix"
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Treatment mix</h2>
                        <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <i data-lucide="more-vertical" class="w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Preventive care</span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">42%</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">84 visits</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Restorative</span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">28%</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">56 visits</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Cosmetic
                                    dentistry</span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">18%</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">36 visits</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Urgent care</span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">12%</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">24 visits</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient care activity -->
                <div id="patients"
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Patient care activity
                        </h2>
                        <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <i data-lucide="more-vertical" class="w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-10 h-10 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-primary-700 dark:text-primary-300">JD</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Emily
                                    Carter</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Checked in for a
                                    hygiene visit</p>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">2 min
                                ago</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-green-700 dark:text-green-300">JS</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Marcus
                                    Lee</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Treatment plan
                                    approved</p>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">5 min
                                ago</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-orange-700 dark:text-orange-300">MJ</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Sofia
                                    Patel</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Payment recorded:
                                    $185.00</p>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">10 min
                                ago</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-purple-700 dark:text-purple-300">AB</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Noah
                                    Williams</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Recall appointment
                                    scheduled</p>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">15 min
                                ago</span>
                        </div>
                    </div>
                </div>

                <!-- Chair availability -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Chair availability
                    </h2>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Operatory 1 · in
                                    use</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">80%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full transition-all duration-300"
                                    style="width: 80%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Operatory 2 · in
                                    use</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">60%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full transition-all duration-300"
                                    style="width: 60%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Operatory 3 ·
                                    available</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">25%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full transition-all duration-300"
                                    style="width: 25%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Operatory 4 · in
                                    use</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">70%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-purple-500 h-2 rounded-full transition-all duration-300"
                                    style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming appointments -->
            <div id="appointments"
                class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Upcoming appointments
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Next scheduled visits for today</p>
                    </div>
                    <button
                        class="px-4 py-2 text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 border border-primary-200 dark:border-primary-700 rounded-lg hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                        View schedule
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white">Time
                                </th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white">
                                    Patient</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white">
                                    Treatment</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white">
                                    Provider</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-900 dark:text-white">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                            <i data-lucide="clock-3"
                                                class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">8:30 AM</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">45 min</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-gray-600 dark:text-gray-400">Sofia Patel</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">New patient exam</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">Dr. Carter</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full">
                                        Checked in
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                            <i data-lucide="clock-3"
                                                class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">9:15 AM</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">60 min</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-gray-600 dark:text-gray-400">Emily Carter</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">Hygiene &amp; polish</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">Dr. Nguyen</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 rounded-full">
                                        In chair
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                                            <i data-lucide="clock-3"
                                                class="w-5 h-5 text-purple-600 dark:text-purple-400"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">10:00 AM</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">40 min</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-gray-600 dark:text-gray-400">Marcus Lee</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">Composite filling</td>
                                <td class="py-4 px-4 text-gray-900 dark:text-white">Dr. Carter</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full">
                                        Confirmed
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
