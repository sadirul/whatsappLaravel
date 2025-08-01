<div id="sidebar" class="sidebar bg-gray-800 text-white w-64 fixed h-full lg:block">
    <div class="p-4 flex items-center border-b border-gray-700">
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=667eea&color=fff" alt="Logo"
            class="h-10 w-10 rounded-full">
        <span class="ml-3 font-semibold text-lg">{{ auth()->user()->name }}</span>
    </div>

    <nav class="mt-6">
        <div>
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            <a href="{{ route('whatsapp.instance.index') }}"
                class="flex items-center px-4 py-3 {{ request()->routeIs('whatsapp.instance.index') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fab fa-whatsapp mr-3"></i>
                WhatsApp Instance
            </a>

            {{-- <a href="#"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-cog mr-3"></i>
            Settings
        </a> --}}

            <a href="{{ route('logout') }}"
                class="flex items-center px-4 py-3 {{ request()->routeIs('logout') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </a>
        </div>
    </nav>

</div>
