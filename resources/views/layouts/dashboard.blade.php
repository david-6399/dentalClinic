<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" lang="en" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>:root { --brand-primary: {{ $c['theme']['primary'] }}; --brand-accent: {{ $c['theme']['accent'] }}; }</style>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900">



    <div class="flex h-screen">
        <livewire:dashboard.sidbar />
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen md:ml-0">
            {{ $slot }}
        </div>
    </div>

    <script>
        lucide.createIcons();

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleTheme() {
            const html = document.documentElement;
            html.classList.toggle('dark');

            // Save theme preference
            const isDark = html.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        function openAddPopup() {
            document.getElementById('addPopup').classList.remove('hidden');
        }

        function closeAddPopup() {
            document.getElementById('addPopup').classList.add('hidden');
        }

        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        // Initialize Charts
        function initCharts() {
            const brandPrimary = getComputedStyle(document.documentElement)
                .getPropertyValue('--brand-primary').trim();

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    datasets: [{
                        label: 'Collected fees',
                        data: [21800, 23600, 22400, 25100, 26800, 29400],
                        borderColor: brandPrimary,
                        backgroundColor: `${brandPrimary}1f`,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + (value / 1000).toFixed(0) + 'k';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Appointments by month
            const appointmentsCtx = document.getElementById('appointmentChart').getContext('2d');
            new Chart(appointmentsCtx, {
                type: 'bar',
                data: {
                    labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    datasets: [{
                            label: 'Booked',
                            data: [198, 214, 205, 226, 238, 252],
                            backgroundColor: brandPrimary,
                            borderRadius: 4
                        },
                        {
                            label: 'Completed',
                            data: [184, 201, 192, 211, 224, 237],
                            backgroundColor: '#f59e0b',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(156, 163, 175, 0.2)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Initialize charts when page loads
        window.addEventListener('load', initCharts);
    </script>
</body>

</html>
