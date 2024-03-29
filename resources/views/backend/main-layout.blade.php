<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Larawise</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" 
        x-data="{ mainAppSettings: '' }"
        x-init="() => {
            async function logAppSettings() {
                const response = await fetch('/app-settings'); // Directly specify the URL
                const appSettings = await response.json();
                // Assuming you want to assign the fetched data to the Alpine.js data property
                this.mainAppSettings = `{{ asset('img/logo') }}/${appSettings.sidebar_logo_img}`;

                $el.href=`{{ asset('img/logo') }}/${appSettings.sidebar_logo_img}`
            }
            logAppSettings();
        }"
    >
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/358f25eac2.js" crossorigin="anonymous"></script>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-layout/main.css') }}">
    {{-- Light Box --}}
    {{-- <link rel="stylesheet" href="{{ asset('js/lightbox/dist/css/lightbox.min.css') }}"> --}}
    <script src="https://cdn.jsdelivr.net/npm/fslightbox"></script>
    {{-- Select2 --}}
    <link href="{{ asset('js/select2/select2.min.css') }}" rel="stylesheet"/>
</head>
<body 
    x-data="{ 
        initialized: false, 
        showSidenav: true, 
        darkMode: false ,

        screenWidth: function screenWidth() {
            if(window.screen.width <= 700){
                this.showSidenav = false
            }
        }
    }"
>

    @if (session('login-success'))
        <div class="modal-center" x-data="{showModalTaC: true}" x-show="showModalTaC" style="z-index: 2">
            <div class="modal-box">
                <div class="modal-content">
                    <h4 class="u-fw-b">Terms and Conditions</h6>
                        <div class="u-mt-15">
                            <h5>Lorem ipsuwpariatur iste quidem error dolores facere, quod, facilis voluptates quae praesentium suscipit rerum quis et sapiente aliquid maiores aperiam reiciendis iusto doloribus iure quisquam at. Aspernatur, dignissimos. A quo officia accusamus, eos nemo voluptates quaerat dolorem eveniet molestias, similique libero.</h5>
                            <h5 class="u-mt-15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, commodi vero, ipsam perspiciatis mollitia animi, rerum sequi voluptatum blanditiis id accusantium facere laboriosam est veritatis.</h5>
                        </div>
                        <div class="u-flex-space-between">
                            <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-mt-15 u-border-1-default" type="button" @click="showModalTaC = false; ">Close</button>
                        </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <div class="sidebarHW u-box-shadow-default">
        <div class="sidebarMenu" @click="showSidenav = !showSidenav" x-show="showSidenav" x-transition.duration.300ms>
            <i class="fa-solid fa-bars"></i>
        </div>
    </div> --}}

    <main x-init="init" :class="darkMode ? 'u-bg-dm-dark' : ''">
        @livewire('sidebar-wrapper')
        @livewire('topbar-wrapper')
    </main>

    {{-- Sweetalert2 --}}
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- FSLightbox --}}
    <script src="{{ asset('js/fslightbox/fslightbox.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    <script>
        function init() {
            this.darkMode = "{{ auth()->user()->dark_mode }}".toUpperCase() === 'FALSE' ? false : true;      
        }
    </script>
    @yield('my_script')
</body>
</html>
