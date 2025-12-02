@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Inbox</h1>
        <a href="{{ route('messages.sent') }}" class="text-sm text-blue-600">Lihat Sent</a>
    </div>

    <div class="bg-white rounded-lg shadow divide-y">
        @foreach($messages as $msg)
            <div class="p-4 flex justify-between items-start {{ $msg->is_read ? '' : 'bg-blue-50' }}">
                <div>
                    <div class="font-medium">{{ $msg->sender->name }} · <span class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</span></div>
                    <div class="text-sm text-gray-700 mt-1">{{ \Illuminate\Support\Str::limit($msg->pesan, 200) }}</div>
                    @if($msg->lampiran)
                        <a href="{{ route('messages.download', $msg->id) }}" class="text-sm text-blue-600 mt-2 inline-block">Download Lampiran</a>
                    @endif
                </div>
                <div class="flex flex-col items-end space-y-2">
                    @if(!$msg->is_read)
                        <a href="{{ route('messages.markRead', $msg->id) }}" class="text-sm text-blue-600">Tandai Dibaca</a>
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
