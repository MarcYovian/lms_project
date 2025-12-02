@extends('layouts.dashboard')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Notifikasi</h1>
        <a href="{{ route('notif.readAll') }}" class="text-sm px-3 py-1 bg-blue-600 text-white rounded">Tandai Semua Dibaca</a>
    </div>

    <div class="space-y-3">
        @foreach($notifications as $n)
            <div id="notif-{{ $n->id }}" class="p-4 rounded-lg shadow-sm flex justify-between items-start {{ $n->is_read ? 'bg-white' : 'bg-blue-50 border-l-4 border-blue-400' }}">
                <div>
                    <div class="font-medium">{{ $n->judul }}</div>
                    <div class="text-sm text-gray-600 mt-1">{{ $n->pesan }}</div>
                    <div class="text-xs text-gray-400 mt-2">{{ $n->created_at->diffForHumans() }}</div>
                </div>

                <div class="flex flex-col items-end space-y-2">
                    @if(!$n->is_read)
                        <button onclick="markRead({{ $n->id }})" class="text-sm text-blue-600">Tandai Dibaca</button>
                    @endif
                    <a href="{{ route('notif.read', $n->id) }}" class="text-sm text-gray-500">Buka</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>

<script>
async function markRead(id){
    try{
        const res = await fetch('/notifikasi/read/' + id, { credentials: 'same-origin' });
        if(res.ok){
            const el = document.getElementById('notif-' + id);
            if(el) el.classList.remove('bg-blue-50','border-l-4','border-blue-400');
        }
    }catch(e){
        console.error(e);
    }
}
</script>
@endsection
