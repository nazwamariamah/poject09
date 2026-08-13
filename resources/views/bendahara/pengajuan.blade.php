<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Pengajuan Terverifikasi
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('bendahara.partials.list-pengajuan', ['pengajuans' => $pengajuans])
        </div>
    </div>
</x-app-layout>
