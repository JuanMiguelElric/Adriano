<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background: #0A3D62;
            color: #fff;
            padding: 20px;
        }
        .sidebar h4 {
            color: #C9A646;
            font-weight: bold;
            text-transform: uppercase;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background: #C9A646;
            color: #0A3D62;
            font-weight: bold;
        }
        .content {
            padding: 30px;
        }
        .btn-primary {
            background-color: #C9A646;
            border-color: #C9A646;
        }
        .btn-primary:hover {
            background-color: #b68f39;
            border-color: #b68f39;
        }
    </style>
        <!-- Scripts -->

                <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery (não é obrigatório no Bootstrap 5, mas pode ser útil para outras partes) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap Bundle (OBRIGATÓRIO, pois contém o Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
      
        </div>
    </body>
</html>
