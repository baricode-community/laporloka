@extends('layouts.base') {{-- Ini memanggil Navbar & Footer --}}

@section('title', 'Buat Laporan Baru')

@section('content')
    {{-- Background Decoration --}}
    <div class="fixed inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]">
        <div class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)]"></div>
    </div>

    <div class="relative isolate pt-24 pb-20"> {{-- pt-24 memberi jarak dari Navbar --}}
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <livewire:create-report />
            </div>
        </div>
    </div>
@endsection
