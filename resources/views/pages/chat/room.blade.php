@extends('layouts.dashboard')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Chat dengan {{ $user->name }}</h2>

<div class="bg-white p-4 rounded shadow h-[500px] flex flex-col">

    {{-- area pesan --}}
    <div class="flex-1 overflow-y-auto mb-4 space-y-3">

        @foreach($messages as $m)
            @if($m->pengirim_id == Auth::id())
                {{-- pesan saya --}}
                <div class="text-right">
                    <span class="bg-blue-600 text-white px-4 py-2 rounded inline-block">
                        {{ $m->pesan }}
                    </span>
                </div>
            @else
                {{-- pesan lawan --}}
                <div class="text-left">
                    <span class="bg-gray-200 px-4 py-2 rounded inline-block">
                        {{ $m->pesan }}
                    </span>
                </div>
            @endif
        @endforeach

    </div>

    {{-- form kirim pesan --}}
    <form method="POST" action="{{ route('chat.send', $user->id) }}" class="flex gap-2">
        @csrf
        <input type="text" name="pesan" class="flex-1 border px-3 py-2 rounded"
               placeholder="Ketik pesan...">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
    </form>

</div>

<div class="flex h-[80vh] bg-white rounded-lg shadow overflow-hidden">
  {{-- Kiri: daftar percakapan ringkas (narrow) --}}
  <aside class="w-96 border-r overflow-y-auto">
    <div class="p-4 border-b">
      <h2 class="text-lg font-semibold">Pesan</h2>
    </div>

    <div class="overflow-y-auto h-[72vh]">
      {{-- reuse conversation list minimal (only show same conversation as link to itself + others optional) --}}
      {{-- show current conversation on top --}}
      @php
        $me = Auth::user();
      @endphp

      <div class="p-4 border-b flex items-center gap-3">
        @php $other = ($conversation->user_one == $me->id) ? $conversation->userTwo : $conversation->userOne; @endphp
        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-xl text-blue-700 font-semibold">
          {{ strtoupper(substr($other->name,0,1)) }}
        </div>
        <div>
          <div class="font-semibold">{{ $other->name }}</div>
          <div class="text-sm text-gray-500">@if(isset($other->email)) {{ $other->email }} @endif</div>
        </div>
      </div>

      {{-- small list of other conversations --}}
      @foreach(\App\Models\Conversation::where('user_one', $me->id)->orWhere('user_two', $me->id)->with('userOne','userTwo')->get() as $c)
        @php $o = ($c->user_one == $me->id) ? $c->userTwo : $c->userOne; @endphp
        <a href="{{ route('chat.open', $c->id) }}" class="flex items-center gap-3 p-3 hover:bg-gray-50 border-b">
          <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-sm">{{ strtoupper(substr($o->name,0,1)) }}</div>
          <div class="flex-1">
            <div class="font-medium text-sm">{{ $o->name }}</div>
            <div class="text-xs text-gray-500 truncate">{{ optional($c->messages()->latest()->first())->message }}</div>
          </div>
        </a>
      @endforeach
    </div>
  </aside>

  {{-- Kanan: chat area --}}
  <section class="flex-1 flex flex-col">
    <div class="p-4 border-b flex items-center gap-3">
      <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-sm font-semibold">{{ strtoupper(substr($other->name,0,1)) }}</div>
      <div>
        <div class="font-semibold">{{ $other->name }}</div>
        <div class="text-xs text-gray-500">Aktif</div>
      </div>
    </div>

    {{-- Messages container --}}
    <div id="messages" class="flex-1 p-6 overflow-y-auto space-y-4 bg-gray-50">
      @foreach($messages as $m)
        @php $isMe = $m->sender_id == Auth::id(); @endphp

        <div class="max-w-xl {{ $isMe ? 'ml-auto text-right' : 'mr-auto text-left' }}">
          <div class="inline-block px-4 py-2 rounded-lg {{ $isMe ? 'bg-blue-600 text-white' : 'bg-white border' }}">
            <div class="text-sm">{{ $m->message }}</div>
            <div class="text-xs text-gray-200 mt-1">{{ $m->created_at->format('H:i') }}</div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Form kirim --}}
    <form id="sendForm" action="{{ route('chat.send', $conversation->id) }}" method="POST" class="p-4 border-t flex gap-3">
      @csrf
      <input id="messageInput" name="message" type="text" placeholder="Tulis pesan..." class="flex-1 border rounded-lg px-4 py-2" autocomplete="off">
      <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Kirim</button>
    </form>
  </section>
</div>

<script>
  const convId = {{ $conversation->id }};
  const messagesEl = document.getElementById('messages');
  const sendForm = document.getElementById('sendForm');
  const messageInput = document.getElementById('messageInput');

  // ESCAPE (prevent HTML injection)
  function escapeHtml(text) {
      var map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
      return text.replace(/[&<>"']/g, function(m) { return map[m]; });
  }

  // Render message bubble
  function renderMessages(data) {
      messagesEl.innerHTML = '';

      data.forEach(m => {
          const isMe = m.sender_id == {{ Auth::id() }};
          const wrapper = document.createElement('div');

          wrapper.className =
              'max-w-xl ' + (isMe ? 'ml-auto text-right' : 'mr-auto text-left');

          wrapper.innerHTML = `
              <div class="inline-block px-4 py-2 rounded-lg ${isMe ? 'bg-blue-600 text-white' : 'bg-white border'}">
                  <div class="text-sm">${escapeHtml(m.message)}</div>
                  <div class="text-xs text-gray-200 mt-1">
                      ${new Date(m.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}
                  </div>
              </div>
          `;

          messagesEl.appendChild(wrapper);
      });

      // auto scroll
      messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  // Polling setiap 2.5 detik
  async function fetchMessages(){
      try {
          const res = await fetch("{{ route('chat.messages','') }}/" + convId, {
              headers: { 'X-Requested-With': 'XMLHttpRequest' }
          });
          if (!res.ok) return;

          const data = await res.json();
          renderMessages(data);

      } catch (err) {
          console.error("Polling error:", err);
      }
  }

  setInterval(fetchMessages, 2500);
  setTimeout(fetchMessages, 300); // initial load delay

  // 🎯 AJAX SEND — tanpa reload
  sendForm.addEventListener('submit', async (e) => {
      e.preventDefault(); // stop normal POST

      let msg = messageInput.value.trim();
      if (msg.length === 0) return;

      try {
          const res = await fetch("{{ route('chat.send', $conversation->id) }}", {
              method: "POST",
              headers: {
                  "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  "Content-Type": "application/json",
                  "Accept": "application/json",
              },
              body: JSON.stringify({ message: msg })
          });

          if (!res.ok) {
              console.error("Gagal mengirim:", res.status);
              return;
          }

          messageInput.value = "";        // clear input
          fetchMessages();                // refresh chat
          setTimeout(fetchMessages, 400); // double refresh (agar realtime)

      } catch (err) {
          console.error("Send error:", err);
      }
  });
</script>

@endsection
