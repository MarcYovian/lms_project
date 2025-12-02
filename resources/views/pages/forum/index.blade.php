@extends('layouts.dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-6">Forum Diskusi</h2>

{{-- form posting --}}
<form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-white p-5 rounded shadow mb-6">
    @csrf

    <div class="mb-3">
        <label class="font-semibold">Judul</label>
        <input type="text" name="judul" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label class="font-semibold">Konten</label>
        <textarea name="konten" rows="3" class="w-full border p-2 rounded"></textarea>
    </div>

    <div class="mb-3">
        <label>Lampiran (Opsional)</label>
        <input type="file" name="lampiran" class="border p-2 rounded w-full">
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Posting</button>
</form>

{{-- list postingan --}}
@foreach ($posts as $post)
<div class="bg-white p-5 rounded shadow mb-5">
    <div class="flex justify-between">
        <h3 class="font-semibold text-lg">{{ $post->judul }}</h3>
        @if(Auth::user()->role == 'guru')
            <form action="{{ route('forum.delete', $post->id) }}" method="POST">
                @csrf @method('DELETE')
                <button class="text-red-600">Hapus</button>
            </form>
        @endif
    </div>

    <p class="text-gray-700">{{ $post->konten }}</p>

    @if($post->lampiran)
        <a href="{{ asset('storage/'.$post->lampiran) }}" class="text-blue-600 text-sm" download>
            Unduh Lampiran
        </a>
    @endif

    <p class="text-gray-500 text-sm mt-2">Oleh: {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>

    <hr class="my-3">

    {{-- Komentar --}}
    @foreach ($post->comments as $c)
        <div class="mb-2">
            <strong>{{ $c->user->name }}</strong> :
            <span>{{ $c->komentar }}</span>
        </div>
    @endforeach

    {{-- form komentar --}}
    <form action="{{ route('forum.comment', $post->id) }}" method="POST" class="mt-3">
        @csrf
        <input type="text" name="komentar" class="border w-full p-2 rounded"
               placeholder="Tulis komentar...">
    </form>
</div>
@endforeach

{{ $posts->links() }}

@endsection
