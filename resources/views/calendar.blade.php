<x-dashboard-layout>
    <x-slot name="content">
        <h1>CALENDAR</h1>
        <div class="flex gap-2">
            <a href="{{ asset('storage/1/500.jpeg')}}" data-lightbox="album" data-title="My caption"><img src="{{ asset('storage/1/500.jpeg')}}" width="150px"></a>
            <a href="{{ asset('storage/2/500.jpeg')}}" data-lightbox="album" data-title="My caption"><img src="{{ asset('storage/2/500.jpeg')}}" width="150px"></a>
            <a href="{{ asset('storage/3/500.jpeg')}}" data-lightbox="album" data-title="My caption"><img src="{{ asset('storage/3/500.jpeg')}}" width="150px"></a>
        </div>
    </x-slot>
</x-dasboard-layout>
