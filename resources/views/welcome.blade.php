<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
                <div class="grid grid-flow-row auto-rows-max">

            <div class="text-gray-60 text-lg">
                Bienvenue sur Findo !
            </div>
            @if (Route::has('login'))
                @auth
                    <div><a href="{{ url('/dashboard') }}"
                            class="text-gray-400 text-s underline">Accéder à
                            votre tableau de bord</a></div>
                @else
                    @if (Route::has('register'))
                        <div class="text-gray-400 dark:text-gray-100 text-s">
                            <a href="{{ route('register') }}" class="underline">Créez un compte</a> ou <a
                                href="{{ route('login') }}" class="underline">connectez vous</a> pour commencer.
                        </div>

                    @endif
                @endauth
            @endif

        </div>
    </x-auth-card>
</x-guest-layout>
