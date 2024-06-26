<!DOCTYPE html>
<html lang="en" class="scroll-side">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Management System PT. Javas Teknologi Integrator</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        .toast-alert {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    @include('layouts.inc.style')
    @stack('style')
</head>

<body>
    @if(session('message'))
        @php
            $type = session('type', 'info');
        @endphp
        <x-toast-alert :type="$type" :message="session('message')" />
    @endif
    {{-- @include('components.navbar')  --}}
    <x-navbar></x-navbar>

    <main class="flex h-screen" x-data="{ popOpenDelete: false }">
        @include('components.sidebar')
        <section class="flex-1 w-full ps-[240px]">
            <div class="pt-[120px] px-6 h-full">
                @yield('content')
            </div>
        </section>
    </main>

    @include('layouts.inc.script')
    @stack('script')
</body>

</html>