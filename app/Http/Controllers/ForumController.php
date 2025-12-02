<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('user', 'comments.user')
                ->latest()
                ->paginate(10);

        return view('pages.forum.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'lampiran' => 'file|max:5000'
        ]);

        $file = null;
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran')->store('forum', 'public');
        }

        ForumPost::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'konten' => $request->konten,
            'lampiran' => $file,
        ]);

        return back()->with('success', 'Diskusi berhasil dibuat');
    }

    public function comment(Request $request, $id)
    {
        $request->validate(['komentar' => 'required']);

        ForumComment::create([
            'post_id' => $id,
            'user_id' => Auth::id(),
            'komentar' => $request->komentar
        ]);

        return back();
    }

    public function destroyPost($id)
    {
        $post = ForumPost::findOrFail($id);

        if (Auth::user()->role != 'guru') {
            abort(403);
        }

        if ($post->lampiran) {
            Storage::disk('public')->delete($post->lampiran);
        }

        $post->delete();

        return back()->with('success', 'Postingan dihapus');
    }
}
