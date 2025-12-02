<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('pages.notifications.index', compact('notifications'));
    }

    // tampilkan/mark satu dibaca
    public function read($id)
    {
        $notif = Notification::where('user_id', Auth::id())->findOrFail($id);
        $notif->update(['is_read' => true]);
        return back();
    }

    // tandai semua dibaca
    public function readAll()
    {
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);
        return back();
    }

    // API kecil untuk count (dipakai topbar polling)
    public function count()
    {
        $count = Notification::where('user_id', Auth::id())->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}
