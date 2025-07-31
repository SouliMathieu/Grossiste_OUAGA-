<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration - Grossiste Ouaga International')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS Dropzone LOCAL -->
    <link rel="stylesheet" href="{{ asset('assets/css/dropzone.min.css') }}" />
</head>
<body class="bg-gray-100">
    <!-- Votre contenu existant... -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                        <div class="w-8 h-8 bg-vert-energie rounded-lg flex items-center justify-center text-white font-bold">GO</div>
                        <span class="ml-2 font-montserrat font-bold text-lg">Administration</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-vert-energie" target="_blank">🌐 Voir le site</a>
                    <span class="text-gray-600">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-sm min-h-screen">
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-vert-energie text-white' : '' }}">📊 Tableau de bord</a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.categories.*') ? 'bg-vert-energie text-white' : '' }}">📁 Catégories</a>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.products.*') ? 'bg-vert-energie text-white' : '' }}">📦 Produits</a>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.orders.*') ? 'bg-vert-energie text-white' : '' }}">📋 Commandes</a>
                </div>
            </nav>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 p-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>

    <!-- JS Dropzone SIMPLE LOCAL -->
    <script src="{{ asset('assets/js/dropzone-simple.js') }}"></script>
    <script>
        console.log('✅ SimpleDropzone chargé avec succès');
    </script>

    @stack('scripts')
</body>
</html>
