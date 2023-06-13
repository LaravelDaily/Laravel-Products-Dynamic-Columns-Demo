<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(':product Sizing Table', ['product' => $product->name]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            @foreach($sizes as $size)
                                <th class="px-4 py-2">{{ $size }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productSizingTable as $color => $colorData)
                            <tr>
                                <td class="border px-4 py-2">{{ $color }}</td>
                                @foreach($sizes as $size)
                                    <td class="border px-4 py-2">{{ $colorData->where('size.name', $size)->first()?->reference_number }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
