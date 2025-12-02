<?php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        // semua yang boleh melihat (publish dan belum dihapus)
        $pengumumans = Pengumuman::where('is_published', true)
            ->orderBy('publish_at', 'desc')
            ->paginate(12);

        return view('pages.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        // hanya role tertentu
        if (!in_array(Auth::user()->role, ['guru','kepala-sekolah','dinas'])) {
            abort(403);
        }
        return view('pages.pengumuman.create');
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['guru','kepala-sekolah','dinas'])) abort(403);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|max:10240', // 10MB
            'publish_at' => 'nullable|date',
            'is_published' => 'nullable|boolean'
        ]);

        $path = null;
        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('pengumuman', 'public');
        }

        $peng = Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'lampiran' => $path,
            'publish_at' => $request->publish_at ?: now(),
            'created_by' => Auth::id(),
            'is_published' => $request->filled('is_published') ? true : true
        ]);

        // buat notifikasi untuk semua siswa (atau target grup)
        $targets = User::where('role', 'siswa')->get();
        foreach ($targets as $u) {
            \App\Models\Notification::create([
                'user_id' => $u->id,
                'judul' => 'Pengumuman: '.$peng->judul,
                'pesan' => \Str::limit(strip_tags($peng->isi), 120),
                'is_read' => false
            ]);
        }

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function show($id)
    {
        $peng = Pengumuman::findOrFail($id);

        // jika unpublished, batas akses
        if (!$peng->is_published && !in_array(Auth::user()->role, ['guru','kepala-sekolah','dinas'])) {
            abort(403);
        }

        return view('pages.pengumuman.show', compact('peng'));
    }

    public function edit($id)
    {
        $peng = Pengumuman::findOrFail($id);
        if (Auth::id() !== $peng->created_by && !in_array(Auth::user()->role, ['kepala-sekolah','dinas'])) abort(403);
        return view('pages.pengumuman.edit', compact('peng'));
    }

    public function update(Request $request, $id)
    {
        $peng = Pengumuman::findOrFail($id);
        if (Auth::id() !== $peng->created_by && !in_array(Auth::user()->role, ['kepala-sekolah','dinas'])) abort(403);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|max:10240',
            'publish_at' => 'nullable|date',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('lampiran')) {
            // hapus lama
            if ($peng->lampiran) Storage::disk('public')->delete($peng->lampiran);
            $peng->lampiran = $request->file('lampiran')->store('pengumuman','public');
        }

        $peng->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'publish_at' => $request->publish_at ?: $peng->publish_at,
            'is_published' => $request->filled('is_published') ? true : false,
        ]);

        return redirect()->route('pengumuman.index')->with('success','Pengumuman diperbarui.');
    }

    public function destroy($id)
    {
        $peng = Pengumuman::findOrFail($id);
        if (Auth::id() !== $peng->created_by && !in_array(Auth::user()->role, ['kepala-sekolah','dinas'])) abort(403);

        if ($peng->lampiran) Storage::disk('public')->delete($peng->lampiran);
        $peng->delete();

        return back()->with('success','Pengumuman dihapus.');
    }

    // download lampiran
    public function downloadLampiran($id)
    {
        $peng = Pengumuman::findOrFail($id);
        if (!$peng->lampiran) return back()->with('error','Tidak ada lampiran.');
        return Storage::disk('public')->download($peng->lampiran);
    }
}
