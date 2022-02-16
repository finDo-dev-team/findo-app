<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __($odpEvent->title) }}
        </h2>
        <h3 class=" text-sm text-gray-900 leading-tight">
            {{ __($odpEvent->address_name) }}
        </h3>
        <div class="text-xs text-gray-700">
            {!! $odpEvent->date_description !!}
        </div>
        <div>
            <form method="POST" action="{{ route('likeEvent', [$odpEvent]) }}">
                @csrf
                @if (Auth::user()->likedEvents->contains($odpEvent->id))
                    <button type="submit"
                        class="
                            bg-indigo-500 text-white font-semibold
                            hover:bg-transparent hover:border-red-600 hover:text-red-600
                            py-1 px-2 border rounded
                            ">
                        <span>❤️</span>
                        <span class="text-xs font-extrabold">({{ $odpEvent->likedBy->count() }})</span>
                    </button>
                @else
                    <button type="submit"
                        class="
                            bg-transparent text-indigo-500 border-indigo-500 font-semibold
                            hover:bg-indigo-500 hover:text-white hover:border-transparent
                            py-1 px-2 border rounded">
                        <span>❤️</span>
                        <span class="text-xs">({{ $odpEvent->likedBy->count() }})</span>
                    </button>
                @endif

            </form>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="shadow-md overflow-hidden">
                    <div class="mx-auto max-h-full w-6" style="width: 30rem">
                        <img src="{{ $odpEvent->cover_url }}" alt="{{ $odpEvent->cover_alt }}"
                            class="rounded-2xl">
                    </div>
                    <table class="table-auto min-w-full divide-y divide-neutral-700  mt-2">
                        <thead class="bg-white">
                            <tr>
                                <th colspan="2"
                                    class="px-6 py-3 text-left text-xl font-medium uppercase tracking-wider">
                                    Informations
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-neutral-400">
                            @foreach ($odpEvent->getAttributes() as $key => $value)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-sm text-black">
                                            <b>{{ $key }}</b>
                                        </div>
                                    </td>
                                    <td class="flex items-center text-sm font-medium text-gray-900">
                                        {!! $value !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
