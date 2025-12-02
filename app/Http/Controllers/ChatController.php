<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    // Daftar semua user untuk dipilih sebagai kontak
    public function contacts()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('pages.chat.contacts', compact('users'));
    }

    // Halaman chat dengan user tertentu
    public function chat($id)
    {
        $receiver = User::findOrFail($id);

        $messages = Message::where(function($q) use ($id) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $id);
            })
            ->orWhere(function($q) use ($id) {
                $q->where('sender_id', $id)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get();

        return view('pages.chat.chat', compact('receiver', 'messages'));
    }

    // Kirim pesan
    public function send(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required_without:lambiran',
            'lampiran' => 'nullable|file|max:5000'
        ]);

        $lampiranPath = null;

        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('chat', 'public');
        }

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $id,
            'pesan'       => $request->pesan,
            'lampiran'    => $lampiranPath,
        ]);

        return back();
    }
}
