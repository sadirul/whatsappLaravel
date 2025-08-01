<div class="bg-white shadow-sm lg:hidden fixed w-full z-30">
    <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center">
            <button id="mobile-menu-button" class="text-gray-500 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <span class="ml-3 font-semibold text-gray-800">{{ '@'.auth()->user()->username }}</span>
        </div>
        <div class="flex items-center">
            <button class="text-gray-500 focus:outline-none">
                <i class="fas fa-bell text-xl"></i>
            </button>
            <div class="ml-4 relative">
                <button class="flex items-center focus:outline-none">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=667eea&color=fff" alt="User"
                        class="h-8 w-8 rounded-full">
                </button>
            </div>
        </div>
    </div>
</div>
