<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard | Setaman Bogor')</title>
    <!-- Tailwind CSS CDN -->
    
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <!-- Sidebar (Kiri) -->
    <aside id="admin-sidebar" class="hidden md:block fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 flex flex-col flex-shrink-0 transition-transform duration-300">
        <!-- Logo & Title Area -->
        <div class="h-20 flex flex-col justify-center px-6 border-b border-gray-200">
            <h1 class="font-bold text-gray-900 text-lg">Admin Panel</h1>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Setaman Bogor</p>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 py-6 flex flex-col gap-2">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->is('admin/dashboard') ? 'bg-brand text-white font-semibold' : 'text-gray-600 hover:bg-brand-light hover:text-brand font-medium' }} text-sm transition">
                <i class="fas fa-th-large w-5 text-center"></i>
                Dashboard
            </a>
            <a href="{{ url('/admin/products') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->is('admin/products*') ? 'bg-brand text-white font-semibold' : 'text-gray-600 hover:bg-brand-light hover:text-brand font-medium' }} text-sm transition">
                <i class="fas fa-box w-5 text-center"></i>
                Kelola Produk
            </a>
            <a href="{{ url('/admin/articles') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->is('admin/articles*') ? 'bg-brand text-white font-semibold' : 'text-gray-600 hover:bg-brand-light hover:text-brand font-medium' }} text-sm transition">
                <i class="fas fa-newspaper w-5 text-center"></i>
                Kelola Artikel
            </a>
            <a href="{{ url('/admin/orders') }}" class="flex items-center gap-3 px-6 py-3 {{ request()->is('admin/orders*') ? 'bg-brand text-white font-semibold' : 'text-gray-600 hover:bg-brand-light hover:text-brand font-medium' }} text-sm transition">
                <i class="fas fa-shopping-cart w-5 text-center"></i>
                Kelola Pesanan
            </a>
        </nav>

        <!-- Bottom Actions -->
        <div class="p-6 border-t border-gray-200 space-y-4">
            <a href="javascript:void(0)" class="flex items-center gap-3 text-gray-600 hover:text-brand font-medium text-sm transition">
                <i class="far fa-question-circle w-5 text-center"></i>
                Bantuan
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full mt-4">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full bg-black hover:bg-gray-800 text-white font-bold py-3 rounded-md transition text-xs uppercase tracking-wider cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper (Kanan) -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- Topbar Header -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 flex-shrink-0 z-10">
            <button id="sidebarToggle" class="text-gray-600 hover:text-brand mr-4">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h2 class="flex items-center font-black text-gray-900 text-lg tracking-wider hidden sm:flex"><img src="{{ asset('img/logosetaman.png') }}" alt="Logo" class="h-8 mr-2">SETAMAN BOGOR ADMIN</h2>
            <div class="flex items-center gap-6 ml-auto">
                <!-- Search Box -->
                <div class="relative hidden lg:block">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" placeholder="Search..." class="border border-gray-300 rounded-md py-1.5 pl-8 pr-4 text-sm focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand w-64">
                </div>
                
                <!-- Icons -->
                <div class="flex items-center gap-4 text-gray-500">
                    <button class="hover:text-brand transition relative">
                        <i class="far fa-bell text-lg"></i>
                        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    <button class="hover:text-brand transition">
                        <i class="fas fa-cog text-lg"></i>
                    </button>
                </div>

                <!-- Admin Profile Pic -->
                <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden border border-gray-300 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Admin" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- Scrollable Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8">
            @yield('content')
        </main>
    </div>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            const sidebar = document.getElementById('admin-sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
