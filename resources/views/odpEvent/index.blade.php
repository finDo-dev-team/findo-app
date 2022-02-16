<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evénements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <label>Titre</label>
                        <input type="text" id="search_title" value="{{ $search_title }}">
                    </div>
                    <div class="mt-2">
                        <label>Tag </label>
                        <input type="text" id="search_tag" value="{{ $search_tag }}">
                    </div>
                    <div class="mt-2">
                        <label>Date début</label>
                        <input type="date" id="search_date_start" value="{{ $search_date_min }}">
                    </div>
                    <div class="mt-2">
                        <label>Date fin</label>
                        <input type="date" id="search_date_end" value="{{ $search_date_max }}">
                    </div>
                    <button
                        class="mt-2 bg-white text-gray-800 border-gray-400 font-semibold
                            hover:bg-indigo-400 hover:text-white hover:border-transparent
                            py-2 px-4 border rounded shadow"
                        onclick="search()">Rechercher</button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">

            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($odpEvents as $event)
                    <div
                        class="mt-2 shadow-md rounded-lg bg-white max-h-56 overflow-hidden @if (Auth::user()->likedEvents->contains($event->id)) border border-indigo-500 @endif">
                        <div class="flex flex-row">
                            <div class="basis-2/3 p-2">
                                <p class="text-xl">{{ $event->title }}</p>
                                <a href="{{ route('odpEvents.show', ['odpEvent' => $event]) }}"
                                    class="text-indigo-500 underline">Plus d'infos</a>
                                <p class="text-gray-500 text-xs">tags:
                                    {{ Str::lower(Str::replace(';', ', ', $event->tags)) }}</p>
                                <p class="text-gray-700 text-sm">{!! Str::limit($event->date_description, 100) !!}</p>
                                <p class="text-gray-800">
                                    @if ($event->lead_text != null)
                                        {{ Str::limit($event->lead_text, 400) }}
                                    @else
                                        Ouvrez l'évènement pour plus d'informations !
                                    @endif
                                </p>
                            </div>
                            <div class="basis-1/3">
                                <a href="{{ route('odpEvents.show', ['odpEvent' => $event]) }}">
                                    <img src="{{ $event->cover_url }}" alt="{{ $event->cover_alt }}"
                                        class="shadow rounded-r-lg h-auto border-none" />
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function search() {
        let url = new URL(document.URL);

        let search_title = getElementValue("search_title")
        let search_tag = getElementValue("search_tag")
        let search_date_start = getElementValue("search_date_start")
        let search_date_end = getElementValue("search_date_end")

        if (search_title != "") url.searchParams.set("title", search_title)
        if (search_tag != "") url.searchParams.set("tag", search_tag)
        if (search_date_start != "") url.searchParams.set("date_min", search_date_start)
        if (search_date_end != "") url.searchParams.set("date_max", search_date_end)

        window.location.replace(url);
    }

    function getElementValue(id) {
        return document.getElementById(id).value
    }
</script>
