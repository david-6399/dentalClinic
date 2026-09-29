<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <!-- New appointment popup -->
    <div id="addPopup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 w-full max-w-md shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">New appointment</h2>
                <button onclick="closeAddPopup()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <i data-lucide="x" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                </button>
            </div>
            <form class="space-y-4">
                <div>
                    <label for="itemName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Patient name
                    </label>
                    <input type="text" id="itemName"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        placeholder="Enter patient name" />
                </div>
                <div>
                    <label for="itemDescription"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Visit notes
                    </label>
                    <textarea id="itemDescription" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white resize-none"
                        placeholder="Add treatment or visit notes"></textarea>
                </div>
                <div class="flex space-x-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        Save appointment
                    </button>
                    <button type="button" onclick="closeAddPopup()"
                        class="flex-1 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium py-3 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 h-full">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Dental Clinic</h1>
            <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                <i data-lucide="x" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
            </button>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{route('dashboard')}}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="font-medium">Overview</span>
            </a>
            <a href="{{route('dashboard.appointments')}}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200">
                <i data-lucide="calendar-days" class="w-5 h-5"></i>
                <span class="font-medium">Appointments</span>
            </a>
            <a href="{{route('dashboard.patients')}}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span class="font-medium">Patients</span>
            </a>
            <a href="{{route('dashboard.doctors')}}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200">
                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                <span class="font-medium">Doctors</span>
            </a>
            <button onclick="openAddPopup()"
                class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span class="font-medium">New appointment</span>
            </button>
        </nav>

        <div class="absolute bottom-4 left-4 right-4">
            <a href="#billing"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                <i data-lucide="receipt" class="w-5 h-5"></i>
                <span class="font-medium">Billing</span>
            </a>
        </div>
    </div>

    <!-- Mobile overlay -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden" onclick="toggleSidebar()">
    </div>

</div>
