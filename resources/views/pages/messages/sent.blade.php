@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Terkirim</h1>
        <a href="{{ route('messages.inbox') }}" class="text-sm text-blue-600">Lihat Inbox</a>
    </div>

    <div class="bg-white rounded-lg shadow divide-y">
        @foreach($messages as $msg)
            <div class="p-4 flex justify-between items-start">
                <div>
                    <div class="font-medium">Ke: {{ $msg->receiver->name }} · <span class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</span></div>
                    <div class="text-sm text-gray-700 mt-1">{{ \Illuminate\Support\Str::limit($msg->pesan, 200) }}</div>
                    @if($msg->lampiran)
                        <a href="{{ route('messages.download', $msg->id) }}" class="text-sm text-blue-600 mt-2 inline-block">Download Lampiran</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>
@endsection
