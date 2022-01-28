<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les événements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>Liste des événements</h3>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">

            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($odpEvents as $event)
                    <div class="mt-2 shadow-md rounded-lg bg-white max-h-56 overflow-hidden">
                        <div class="flex flex-row">
                            <div class="basis-2/3 p-2">
                                <p class="text-xl">{{ $event->title }}</p>
                                <p class="text-gray-500 text-xs">tags: {{ Str::lower(Str::replace(';', ', ', $event->tags)) }}</p>
                                <p class="text-gray-700 text-sm">{!! $event->date_description !!}</p>
                                <p class="text-gray-800">
                                    @if ($event->lead_text != null)
                                        {{ $event->lead_text }}
                                    @else
                                        Ouvrez l'évènement pour plus d'informations !
                                    @endif
                                </p>
                            </div>
                            <div class="basis-1/3">
                                <img src="{{ $event->cover_url }}" alt="{{ $event->cover_alt }}"
                                    class="shadow rounded-r-lg h-auto border-none" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<!--
    <div class="flex flex-row">
  <div class="basis-1/4">01</div>
  <div class="basis-1/4">02</div>
  <div class="basis-1/2">03</div>
</div>
-->
