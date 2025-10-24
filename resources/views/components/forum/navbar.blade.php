<nav class="flex items-center justify-between h-16">
                <div>
                    <a href="{{ route('home') }}">
                    
                       <x-forum.logo />
                    </a>
                    
                </div>
                
                <div class="flex gap-4">
                    @auth
                    <a href="{{ route('settings.profile') }}"
                        class="text-sm font-semibold">
                        {{ auth()->user()->username ?? auth()->user()->name ?? 'Mi perfil' }}
                    </a>
                    @endauth
                </div>
                
                <div>
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-black-700">
                    Log out &rarr;
                    </button>
                </form>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold">Log in &rarr;</a>
                    @endauth
                </div>
 </nav>