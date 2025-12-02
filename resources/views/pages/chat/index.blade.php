@extends('layouts.dashboard')

@section('content')
<div class="flex h-[80vh] bg-gray-50 rounded-lg overflow-hidden shadow">
  {{-- Kiri: list percakapan + kontak (lebar kecil) --}}
  <aside class="w-96 bg-white border-r">
    <div class="p-4 border-b">
      <h2 class="text-lg font-semibold">Pesan</h2>
    </div>

    <div class="p-3">
      <form action="{{ route('chat.index') }}" method="GET">
        <input type="text" placeholder="Cari..." class="w-full p-2 border rounded" disabled>
      </form>
    </div>

    {{-- Daftar percakapan --}}
    <div class="overflow-y-auto h-[60vh]">
      @foreach($conversations as $c)
        @php
          $other = (Auth::id() == $c->user_one) ? $c->userTwo : $c->userOne;
          $last = $c->messages()->latest()->first();
        @endphp

        <a href="{{ route('chat.open', $c->id) }}" class="flex items-center gap-3 p-3 hover:bg-gray-50 border-b">
          <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-xl font-semibold text-blue-700">
            {{ strtoupper(substr($other->name,0,1)) }}
          </div>
          <div class="flex-1">
            <div class="flex justify-between">
              <div class="font-semibold">{{ $other->name }}</div>
              <div class="text-sm text-gray-400">{{ $last?->created_at?->diffForHumans() }}</div>
            </div>
            <div class="text-sm text-gray-600 truncate">
              {{ $last ? (strlen($last->message) > 60 ? substr($last->message,0,60).'...' : $last->message) : 'Mulai percakapan' }}
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <div class="p-3 border-t">
      <h3 class="text-sm font-semibold mb-2">Mulai Chat Baru</h3>
      <div class="space-y-2 max-h-40 overflow-y-auto">
        @foreach($users as $u)
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-sm font-medium">{{ strtoupper(substr($u->name,0,1)) }}</div>
              <div class="text-sm">{{ $u->name }}</div>
            </div>
            <a href="{{ route('chat.new', $u->id) }}" class="text-xs text-blue-600">Chat</a>
          </div>
        @endforeach
      </div>
    </div>
  </aside>

  

  {{-- Kanan: area chat kosong (instruksi) --}}
  <main class="flex-1 p-6 flex flex-col items-center justify-center">
    <div class="text-center text-gray-400">
      <p class="text-lg font-semibold">Pilih percakapan</p>
      <p class="mt-2">Pilih percakapan di kiri atau mulai chat baru.</p>
    </div>
  </main>
</div>

<h2 class="text-2xl font-semibold mb-4">Pesan</h2>

<div class="bg-white shadow rounded p-4">
    <h3 class="text-lg mb-3">Daftar Kontak</h3>

    @foreach($users as $u)
    <a href="{{ route('chat.with', $u->id) }}" class="block p-3 border-b hover:bg-gray-100">
        {{ $u->name }} 
        <span class="text-sm text-gray-600">({{ ucfirst($u->role) }})</span>
    </a>
    @endforeach
</div>

@endsection
