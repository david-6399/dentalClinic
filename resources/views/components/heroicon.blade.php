@props(['name' => 'sparkles'])

<svg {{ $attributes->merge(['class' => 'h-6 w-6']) }} xmlns="http://www.w3.org/2000/svg" fill="none"
    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
    @switch($name)
        @case('shield-check')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4.5 6v5.25c0 4.2 2.85 8.1 7.5 9.75 4.65-1.65 7.5-5.55 7.5-9.75V6L12 3Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4" />
            @break
        @case('heart')
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z" />
            @break
        @case('chart-bar')
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7.5 14.25v3.75m4.5-8.25V18m4.5-12v12" />
            @break
        @case('clock')
            <circle cx="12" cy="12" r="9" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
            @break
        @case('user-group')
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.75a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v1.5h12v-1.5ZM12 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm7.5 1.5a2.25 2.25 0 1 0 0-4.5m-15 4.5a2.25 2.25 0 1 1 0-4.5" />
            @break
        @case('book-open')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5v13m0-13C10.5 6.5 8.75 6 6.5 6S3 6.5 3 6.5v13s1.25-.5 3.5-.5 4 .5 5.5 1.5Zm0 0C13.5 6.5 15.25 6 17.5 6S21 6.5 21 6.5v13s-1.25-.5-3.5-.5-4 .5-5.5 1.5Z" />
            @break
        @case('check-badge')
            <path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4m4.5 2a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
            @break
        @case('calendar-days')
            <rect x="3" y="4.5" width="18" height="16.5" rx="2" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3v3m9-3v3M3 9h18M7.5 12.75h.01m4.49 0h.01m4.49 0h.01m-9 3h.01m4.49 0h.01" />
            @break
        @case('stethoscope')
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 3v5a6 6 0 0 0 12 0V3M4 3h4m8 0h4m-10 0v2m4-2v2m3 9v2a4 4 0 0 0 8 0v-1" />
            <circle cx="20" cy="13" r="2" />
            @break
        @case('heart-pulse')
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h4l3-8 4 16 3-8h4" />
            @break
        @case('sparkles')
            <path stroke-linecap="round" stroke-linejoin="round" d="m12 3 1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3Zm7 11 1 3 3 1-3 1-1 3-1-3-3-1 3-1 1-3Z" />
            @break
        @case('star')
            <path stroke-linecap="round" stroke-linejoin="round" d="m12 3 2.7 5.47 6.04.88-4.37 4.26 1.03 6.02L12 16.78l-5.4 2.85 1.03-6.02-4.37-4.26 6.04-.88L12 3Z" />
            @break
        @case('arrow-up')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5V4.5m0 0-6 6m6-6 6 6" />
            @break
        @case('arrow-down')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m0 0 6-6m-6 6-6-6" />
            @break
        @case('trash')
            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.35 9m-4.78 0L9.26 9m9.97-3.21c.36.05.72.1 1.08.16m-1.08-.16L18.16 19.67a2.25 2.25 0 0 1-2.24 2.08H8.08a2.25 2.25 0 0 1-2.24-2.08L4.77 5.95m14.46-.16a48.11 48.11 0 0 0-3.48-.44m-12.5.6c.36-.06.72-.11 1.08-.16m0 0a48.11 48.11 0 0 1 3.48-.44m7.94 0V4.5c0-1.24-1.01-2.25-2.25-2.25h-3c-1.24 0-2.25 1.01-2.25 2.25v.45m7.5 0a48.67 48.67 0 0 0-7.5 0" />
            @break
        @case('plus')
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            @break
        @case('check')
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 4.5 4.5 10.5-10.5" />
            @break
        @case('x-mark')
            <path stroke-linecap="round" stroke-linejoin="round" d="m6 6 12 12M18 6 6 18" />
            @break
        @case('sun')
            <circle cx="12" cy="12" r="4" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25v1.5m0 16.5v1.5m9.75-9.75h-1.5m-16.5 0h-1.5m16.64-6.89-1.06 1.06M6.17 17.83l-1.06 1.06m13.78 0-1.06-1.06M6.17 6.17 5.11 5.11" />
            @break
        @case('moon')
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 14.25A8.25 8.25 0 0 1 9.75 3 8.25 8.25 0 1 0 21 14.25Z" />
            @break
        @case('home')
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 9.19-8.25a.84.84 0 0 1 1.12 0L21.75 12M4.5 10.5v9.75h5.25v-6h4.5v6h5.25V10.5" />
            @break
        @case('briefcase')
            <rect x="3" y="7.5" width="18" height="13.5" rx="2" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V5.25A2.25 2.25 0 0 1 10.5 3h3a2.25 2.25 0 0 1 2.25 2.25V7.5m-12 4.5h15m-9 0v2.25h3V12" />
            @break
        @case('chat-bubble-left-right')
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 10.5h.01m3.74 0h.01m3.74 0h.01M3 20.25l1.61-4.03A8.25 8.25 0 1 1 20.25 12c0 4.56-3.69 8.25-8.25 8.25H3Z" />
            @break
        @case('question-mark-circle')
            <circle cx="12" cy="12" r="9" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9a2.25 2.25 0 1 1 3.82 1.61c-.86.82-1.57 1.28-1.57 2.64m0 3h.01" />
            @break
        @case('rectangle-stack')
            <rect x="3" y="3.75" width="18" height="13.5" rx="2" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12M7.5 7.5h9m-9 4.5h6" />
            @break
        @case('arrow-top-right-on-square')
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5h6v6m0-6-9 9m6 0v5.25A2.25 2.25 0 0 1 14.25 21h-9A2.25 2.25 0 0 1 3 18.75v-9A2.25 2.25 0 0 1 5.25 7.5H10.5" />
            @break
        @case('bookmark')
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 3.75h12v17.25l-6-4.5-6 4.5V3.75Z" />
            @break
        @case('arrow-path')
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.02 7.98A6 6 0 0 0 6 12m0 0 2.25-2.25M6 12l-2.25-2.25m4.23 8.27A6 6 0 0 0 18 12m0 0-2.25 2.25M18 12l2.25 2.25" />
            @break
        @case('tooth')
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 4.5c1.5-.75 3-.75 4.5 0s3 .75 4.5 0c1.5-.75 3 0 3 2.25 0 3-1.5 4.5-2.25 7.5-.75 3-1.5 5.25-3 5.25-1.5 0-1.5-4.5-2.25-4.5s-.75 4.5-2.25 4.5c-1.5 0-2.25-2.25-3-5.25S4.5 9.75 4.5 6.75c0-2.25 1.5-3 3-2.25Z" />
            @break
        @case('document-text')
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75h6l4.5 4.5v12H7.5A2.25 2.25 0 0 1 5.25 18V6A2.25 2.25 0 0 1 7.5 3.75Zm6 0v4.5H18m-9 4.5h6m-6 3h6" />
            @break
        @default
            <path stroke-linecap="round" stroke-linejoin="round" d="m12 3 1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3Z" />
    @endswitch
</svg>
