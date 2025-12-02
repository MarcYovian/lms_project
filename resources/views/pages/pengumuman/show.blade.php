@extends('layouts.dashboard')
@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-2">{{ $peng->judul }}</h1>
    <div class="text-sm text-gray-500">Oleh: {{ $peng->author->name }} · {{ $peng->publish_at ? $peng->publish_at->format('d M Y H:i') : $peng->created_at->diffForHumans() }}</div>

    <div class="mt-4 text-gray-800 leading-relaxed">
        {!! $peng->isi !!}
    </div>

    @if($peng->lampiran)
        <div class="mt-4">
            <a href="{{ route('pengumuman.download', $peng->id) }}" class="text-blue-600">Download Lampiran</a>
        </div>
    @endif
</div>
@endsection
