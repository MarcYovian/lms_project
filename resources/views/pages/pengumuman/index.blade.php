@extends('layouts.dashboard')
@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Pengumuman</h1>
        @if(in_array(Auth::user()->role, ['guru','kepala-sekolah','dinas']))
            <a href="{{ route('pengumuman.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Buat</a>
        @endif
    </div>

    <div class="space-y-4">
        @foreach($pengumumans as $p)
        <div class="bg-white p-4 shadow rounded">
            <a href="{{ route('pengumuman.show', $p->id) }}" class="text-lg font-semibold">{{ $p->judul }}</a>
            <div class="text-sm text-gray-500 mt-1">{{ $p->publish_at ? $p->publish_at->format('d M Y H:i') : $p->created_at->diffForHumans() }}</div>
            <div class="mt-2 text-gray-700 line-clamp-3">{!! \Illuminate\Support\Str::limit(strip_tags($p->isi), 300) !!}</div>

            <div class="mt-3 flex items-center justify-between">
                <div class="text-sm text-gray-500">Oleh: {{ $p->author->name }}</div>
                <div class="flex items-center gap-3">
                    @if($p->lampiran)
                        <a href="{{ route('pengumuman.download', $p->id) }}" class="text-blue-600 text-sm">Download Lampiran</a>
                    @endif
                    @if(Auth::id() == $p->created_by || in_array(Auth::user()->role, ['kepala-sekolah','dinas']))
                        <a href="{{ route('pengumuman.edit', $p->id) }}" class="text-sm">Edit</a>
                        <form action="{{ route('pengumuman.delete', $p->id) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button class="text-sm text-red-600">Hapus</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">{{ $pengumumans->links() }}</div>
</div>
@endsection
