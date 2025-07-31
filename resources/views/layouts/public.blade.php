<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Grossiste Ouaga International - Énergie Solaire & Électronique')</title>
    <meta name="description" content="@yield('description', 'Votre partenaire de confiance pour l\'énergie solaire et l\'électronique au Burkina Faso.')">
    
    <!-- SEO Meta Tags -->
    <meta name="keywords" content="@yield('keywords', 'énergie solaire, panneaux solaires, batteries, onduleurs, électronique, Burkina Faso, Ouagadougou, grossiste')">
    <meta name="author" content="Grossiste Ouaga International">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Grossiste Ouaga International",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('/images/logo/Logo.jpg') }}",
        "description": "Grossiste en énergie solaire et électronique au Burkina Faso",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Secteur 30",
            "addressLocality": "Ouagadougou",
            "addressCountry": "BF"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+226-65-03-37-00",
            "contactType": "customer service",
            "availableLanguage": "French"
        }
    }
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50 nav-sticky">
        <!-- Barre de contact -->
        <div class="bg-vert-energie text-white py-3">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-6">
                        <span class="flex items-center">📞 +226 65 03 37 00</span>
                        <span class="flex items-center">📧 grossisteouagainternational@gmail.com</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="https://wa.me/22665033700" class="hover:text-orange-burkina transition-colors flex items-center">
                            💬 WhatsApp
                        </a>
                        <a href="tel:+22665033700" class="hover:text-orange-burkina transition-colors flex items-center">
                            📞 Appeler
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation principale -->
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo avec style magnifique -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <div class="relative">
                            <img src="/images/logo/Logo.jpg" alt="Grossiste Ouaga International" 
                                 class="h-16 w-16 object-contain rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105"
                                 style="filter: drop-shadow(0 4px 8px rgba(46, 139, 87, 0.3));">
                            <div class="absolute inset-0 bg-gradient-to-tr from-vert-energie/20 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="ml-4">
                            <div class="text-2xl font-montserrat font-black text-vert-energie group-hover:text-bleu-tech transition-colors duration-300">
                                Grossiste Ouaga
                            </div>
                            <div class="text-sm font-medium text-gris-moderne group-hover:text-orange-burkina transition-colors duration-300">
                                International
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gris-moderne hover:text-vert-energie font-medium transition-colors duration-300 {{ request()->routeIs('home') ? 'text-vert-energie border-b-2 border-vert-energie' : '' }}">
                        Accueil
                    </a>
                    <a href="{{ route('products.index') }}" class="text-gris-moderne hover:text-vert-energie font-medium transition-colors duration-300 {{ request()->routeIs('products.*') ? 'text-vert-energie border-b-2 border-vert-energie' : '' }}">
                        Produits
                    </a>
                    <a href="{{ route('categories.index') }}" class="text-gris-moderne hover:text-vert-energie font-medium transition-colors duration-300 {{ request()->routeIs('categories.*') ? 'text-vert-energie border-b-2 border-vert-energie' : '' }}">
                        Catégories
                    </a>
                    <a href="{{ route('contact') }}" class="text-gris-moderne hover:text-vert-energie font-medium transition-colors duration-300 {{ request()->routeIs('contact') ? 'text-vert-energie border-b-2 border-vert-energie' : '' }}">
                        Contact
                    </a>
                </nav>
                
                <!-- Boutons d'action -->
                <div class="flex items-center space-x-3">
                    <a href="tel:+22665033700" class="btn-secondary hover-lift">
                        📞 Appeler
                    </a>
                    <a href="https://wa.me/22665033700" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-all hover-lift font-medium">
                        💬 WhatsApp
                    </a>
                </div>

                <!-- Menu mobile -->
                <button class="md:hidden text-gris-moderne hover:text-vert-energie transition-colors" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Menu mobile -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="py-4 border-t border-gray-200">
                    <a href="{{ route('home') }}" class="block py-3 text-gris-moderne hover:text-vert-energie transition-colors">Accueil</a>
                    <a href="{{ route('products.index') }}" class="block py-3 text-gris-moderne hover:text-vert-energie transition-colors">Produits</a>
                    <a href="{{ route('categories.index') }}" class="block py-3 text-gris-moderne hover:text-vert-energie transition-colors">Catégories</a>
                    <a href="{{ route('contact') }}" class="block py-3 text-gris-moderne hover:text-vert-energie transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gris-moderne text-white py-12 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-6">
                        <img src="/images/logo/Logo.jpg" alt="Grossiste Ouaga International" class="w-12 h-12 object-contain rounded-lg mr-3">
                        <div>
                            <div class="font-montserrat font-bold text-lg">Grossiste Ouaga</div>
                            <div class="text-sm text-gray-300">International</div>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4 leading-relaxed">Votre partenaire de confiance pour l'énergie solaire et l'électronique au Burkina Faso.</p>
                    <div class="flex space-x-3">
                        <a href="https://wa.me/22665033700" class="bg-green-500 p-3 rounded-lg hover:bg-green-600 transition-colors">💬</a>
                        <a href="tel:+22665033700" class="bg-orange-burkina p-3 rounded-lg hover:bg-orange-600 transition-colors">📞</a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-montserrat font-semibold mb-4 text-lg">Contact</h4>
                    <div class="space-y-3 text-gray-300">
                        <p class="flex items-center"><span class="mr-2">📞</span> +226 65 03 37 00</p>
                        <p class="flex items-center"><span class="mr-2">💬</span> +226 65 03 37 00 (WhatsApp)</p>
                        <p class="flex items-center"><span class="mr-2">📧</span> grossisteouagainternational@gmail.com</p>
                        <p class="flex items-center"><span class="mr-2">🏦</span> UBA: 410730007217</p>
                        <p class="flex items-center"><span class="mr-2">📱</span> Moov: 70103993</p>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-montserrat font-semibold mb-4 text-lg">Catégories</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('products.index', ['category' => 'panneaux-solaires']) }}" class="hover:text-vert-energie transition-colors">☀️ Panneaux Solaires</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'batteries']) }}" class="hover:text-vert-energie transition-colors">🔋 Batteries</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'onduleurs']) }}" class="hover:text-vert-energie transition-colors">⚡ Onduleurs</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'kits']) }}" class="hover:text-vert-energie transition-colors">📦 Kits Solaires</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-montserrat font-semibold mb-4 text-lg">Paiement</h4>
                    <div class="space-y-2 text-gray-300">
                        <p class="flex items-center"><span class="w-6 h-6 bg-orange-500 rounded mr-2 flex items-center justify-center text-xs">O</span> Orange Money</p>
                        <p class="flex items-center"><span class="w-6 h-6 bg-blue-600 rounded mr-2 flex items-center justify-center text-xs">M</span> Moov Money</p>
                        <p class="flex items-center"><span class="mr-2">🏦</span> Virement bancaire</p>
                        <p class="flex items-center"><span class="mr-2">💵</span> Espèces</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-600 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} Grossiste Ouaga International. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });
    </script>
</body>
</html>
