<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($odpEvent->title) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="shadow-md overflow-hidden">
                    <div class="mx-auto max-h-full w-6" style="width: 30rem">
                        <img src="{{ $odpEvent->cover_url }}" alt="{{ $odpEvent->cover_alt }}"
                            class="rounded-full">
                    </div>

                    <table class="table-auto min-w-full divide-y divide-black mt-2">
                        <thead class="bg-white">
                            <tr>
                                <th colspan="2" class="px-6 py-3 text-left text-xl font-medium uppercase tracking-wider">
                                    Informations
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-black">
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
</x-app-layout>
