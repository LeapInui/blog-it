<nav class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 
                        {{ request()->routeIs('dashboard') ? 'border-indigo-500 text-sm font-medium leading-5 text-gray-100' : 'border-transparent text-sm font-medium leading-5 text-gray-300' }} 
                        focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                        Dashboard
                    </a>

                    <a href="{{ route('user.show', auth()->user()->id) }}" 
                        class="inline-flex items-center px-1 pt-1 border-b-2 
                        {{ request()->is('user/' . auth()->user()->id) || request()->is('user/' . auth()->user()->id . '/comments') ? 'border-indigo-500 text-sm font-medium leading-5 text-gray-100' : 'border-transparent text-sm font-medium leading-5 text-gray-300' }} 
                        focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                        My Profile
                    </a>

                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('user.roles') }}" 
                            class="inline-flex items-center px-1 pt-1 border-b-2 
                            {{ request()->routeIs('admin.index') ? 'border-indigo-500 text-sm font-medium leading-5 text-gray-100' : 'border-transparent text-sm font-medium leading-5 text-gray-300' }} 
                            focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                            Admin Panel
                        </a>
                    @endif
                </div>
            </div>
            

            <!-- Notification & Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6" x-data="{ notificationOpen: false, profileOpen: false }">
                <!-- Notifications Dropdown -->
                <div class="relative">
                    <button @click="notificationOpen = !notificationOpen" class="relative flex items-center text-sm font-medium text-gray-300 hover:text-gray-100 focus:outline-none focus:text-gray-100 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9"></path>
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-0 right-0 inline-block w-2.5 h-2.5 bg-red-600 rounded-full"></span>
                        @endif
                    </button>

                    <!-- Notifications Dropdown Content -->
                    <div x-show="notificationOpen" @click.away="notificationOpen = false" x-transition.origin="top right" class="origin-top-right absolute right-0 mt-2 w-64 rounded-md shadow-lg bg-gray-700">
                        <div class="py-1 rounded-md shadow-xs">
                            <!-- Mark All as Read Button -->
                            <form method="POST" action="{{ route('notifications.markAllRead') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-100 ml-2">Mark All as Read</button>
                            </form>
                            @forelse(auth()->user()->unreadNotifications as $notification)
                            <div class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 transition duration-150 ease-in-out">
                                {{ $notification->data['message'] }}
                                <small class="block text-gray-500 text-xs">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @empty
                                <p class="block px-4 py-2 text-sm text-gray-400">No new notifications</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Profile Settings Dropdown -->
                <div class="ml-3 relative">
                    <button @click="profileOpen = !profileOpen" class="flex items-center text-sm font-medium text-gray-300 hover:text-gray-100 focus:outline-none focus:text-gray-100 transition duration-150 ease-in-out">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                    <div x-show="profileOpen" @click.away="profileOpen = false" x-transition.origin="top right" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                        <div class="py-1 rounded-md bg-gray-700 shadow-xs">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 transition duration-150 ease-in-out">
                                Profile Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 transition duration-150 ease-in-out">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
