@extends('layouts.dashboard')

@section('content')
<div class="p-6">

    <!-- HEADER -->
    <div class="bg-white p-6 rounded-xl shadow mb-5">
        <h1 class="text-2xl font-bold">{{ $forum->judul }}</h1>

        <div class="text-gray-500 text-sm mt-1">
            Oleh: {{ $forum->user->name }} · {{ $forum->created_at->diffForHumans() }}
        </div>

        <p class="mt-4 text-gray-700 leading-relaxed">{{ $forum->konten }}</p>

        @if($forum->lampiran)
            <a href="{{ asset('storage/' . $forum->lampiran) }}"
               class="mt-3 inline-block text-blue-600 underline"
               download>
                Download Lampiran
            </a>
        @endif
    </div>

    <!-- BALASAN -->
    <h2 class="text-xl font-semibold mb-3">Balasan</h2>

    @forelse($forum->replies as $reply)
        <div class="bg-white p-4 rounded-xl shadow mb-3">
            <div class="flex justify-between text-sm text-gray-500 mb-2">
                <span>{{ $reply->user->name }}</span>
                <span>{{ $reply->created_at->diffForHumans() }}</span>
            </div>

            <p class="text-gray-700">{{ $reply->pesan }}</p>

            @if($reply->lampiran)
                <a href="{{ asset('storage/' . $reply->lampiran) }}"
                   class="mt-2 inline-block text-blue-600 underline text-sm"
                   download>
                    Download Lampiran
                </a>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Belum ada balasan.</p>
    @endforelse


    <!-- FORM BALAS -->
    <div class="bg-white p-6 rounded-xl shadow mt-6">
        <h3 class="text-lg font-semibold mb-4">Tulis Balasan</h3>

        <form action="{{ route('forum.reply', $forum->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <textarea name="pesan" rows="4" class="w-full p-3 border rounded-lg" required></textarea>

            <div class="mt-3">
                <label class="font-medium">Lampiran (opsional)</label>
                <input type="file" name="lampiran" class="mt-1">
            </div>

            <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Kirim Balasan
            </button>
        </form>
    </div>

</div>
@endsection
