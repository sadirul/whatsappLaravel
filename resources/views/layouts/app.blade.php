<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: absolute;
                z-index: 50;
                height: 100vh;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.open {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Navbar or Header -->
    @include('partials.mobile-header')
    <div id="overlay" class="overlay"></div>
    @include('partials.sidebar')

    <!-- Page Content -->
    <main class="p-4">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Scripts -->
    @stack('scripts') {{-- Extra JS from child views --}}
</body>

</html>
