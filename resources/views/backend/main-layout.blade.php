<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larawise</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/358f25eac2.js" crossorigin="anonymous"></script>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-layout/main.css') }}">
    {{-- Choice JS --}}
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>


</head>
<body x-data="{ initialized: false, showSidenav: true, darkMode: false }">

    <div class="sidebarHW u-box-shadow-default">
        <div class="sidebarMenu" @click="showSidenav = !showSidenav" x-show="showSidenav" x-transition.duration.300ms>
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>

    <main x-init="init" :class="darkMode ? 'u-bg-dm-dark' : ''">
        @livewire('sidebar-wrapper')
        @livewire('topbar-wrapper')
    </main>
    <script>
        function init() {
            console.log('Document is ready!');

            this.darkMode = "{{ auth()->user()->dark_mode }}".toUpperCase() === 'FALSE' ? false : true;

            
        }

    </script>
</body>
</html>
