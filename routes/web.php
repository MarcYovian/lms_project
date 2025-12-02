<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Models\Notification;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PengumumanController;

// =====================================================================
// PUBLIC
// =====================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==================== AUTH ====================
Route::get('/login/{role}', [AuthController::class, 'showLogin'])->name('login.role');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================================================================
// DASHBOARD BY ROLE
// =====================================================================
Route::middleware(['auth', 'role:kepala_sekolah'])->group(function () {
    Route::get('/dashboard/kepala-sekolah', fn() => view('dashboard.kepala-sekolah'))->name('dashboard.kepsek');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard/guru', fn() => view('dashboard.guru'))->name('dashboard.guru');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard/siswa', fn() => view('dashboard.siswa'))->name('dashboard.siswa');
});

Route::middleware(['auth', 'role:orang_tua'])->group(function () {
    Route::get('/dashboard/orang-tua', fn() => view('dashboard.orang-tua'))->name('dashboard.orangtua');
});

Route::middleware(['auth', 'role:dinas'])->group(function () {
    Route::get('/dashboard/dinas', fn() => view('dashboard.dinas'))->name('dashboard.dinas');
});

// =====================================================================
// CRUD SISWA
// =====================================================================
Route::middleware(['auth', 'role:kepsek,guru'])->group(function () {
    Route::get('/data-siswa', [StudentController::class, 'index'])->name('siswa.index');
    Route::post('/data-siswa', [StudentController::class, 'store'])->name('siswa.store');
    Route::post('/data-siswa/{id}', [StudentController::class, 'update'])->name('siswa.update');
    Route::delete('/data-siswa/{id}', [StudentController::class, 'destroy'])->name('siswa.delete');
});

// =====================================================================
// CRUD GURU
// =====================================================================
Route::middleware(['auth', 'role:kepsek'])->group(function () {
    Route::get('/data-guru', [TeacherController::class, 'index'])->name('guru.index');
    Route::post('/data-guru', [TeacherController::class, 'store'])->name('guru.store');
    Route::post('/data-guru/{id}', [TeacherController::class, 'update'])->name('guru.update');
    Route::delete('/data-guru/{id}', [TeacherController::class, 'destroy'])->name('guru.delete');
});

// =====================================================================
// JADWAL (Kepsek + Guru)
// =====================================================================
Route::middleware(['auth', 'role:guru,kepsek'])->group(function () {
    Route::get('/jadwal', [ScheduleController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal', [ScheduleController::class, 'store'])->name('jadwal.store');
    Route::post('/jadwal/{id}', [ScheduleController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [ScheduleController::class, 'destroy'])->name('jadwal.delete');
});

// =====================================================================
// NILAI (Guru + Kepsek)
// =====================================================================
Route::middleware(['auth', 'role:guru,kepsek'])->group(function () {
    Route::get('/nilai', [ScoreController::class, 'index'])->name('nilai.index');
    Route::post('/nilai', [ScoreController::class, 'store'])->name('nilai.store');
    Route::post('/nilai/{id}', [ScoreController::class, 'update'])->name('nilai.update');
    Route::delete('/nilai/{id}', [ScoreController::class, 'destroy'])->name('nilai.delete');
});

// =====================================================================
// LAPORAN
// =====================================================================
Route::middleware(['auth', 'role:guru,kepsek'])->group(function () {
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::post('/laporan', [ReportController::class, 'store'])->name('laporan.store');
    Route::delete('/laporan/{id}', [ReportController::class, 'destroy'])->name('laporan.delete');
    Route::get('/laporan/download/{id}', [ReportController::class, 'download'])->name('laporan.download');
});

// =====================================================================
// UPLOAD FILE
// =====================================================================
Route::middleware(['auth'])->group(function () {

    Route::get('/upload-file', [FileController::class, 'index'])->name('file.index');
    Route::post('/upload-file', [FileController::class, 'store'])->name('file.store');
    Route::get('/upload-file/download/{id}', [FileController::class, 'download'])->name('file.download');
    Route::delete('/upload-file/{id}', [FileController::class, 'destroy'])
        ->middleware('role:guru')
        ->name('file.delete');
});

// =====================================================================
// NOTIFIKASI
// =====================================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notif.index');
    Route::get('/notifikasi/read/{id}', [NotificationController::class, 'read'])->name('notif.read');
    Route::get('/notifikasi/read-all', [NotificationController::class, 'readAll'])->name('notif.readAll');
});

// =====================================================================
// CHAT SYSTEM 1
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/open/{id}', [ChatController::class, 'open'])->name('chat.open');
    Route::post('/chat/send/{id}', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/new/{userId}', [ChatController::class, 'createConversation'])->name('chat.new');
    Route::get('/chat/messages/{id}', [ChatController::class, 'messages'])->name('chat.messages');
});

// =====================================================================
// FORUM
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [ForumController::class, 'reply'])->name('forum.reply');
});

// =====================================================================
// CHAT SYSTEM 2 (contacts)
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'contacts'])->name('chat.contacts');
    Route::get('/chat/{id}', [ChatController::class, 'chat'])->name('chat.room');
    Route::post('/chat/{id}', [ChatController::class, 'send'])->name('chat.send');
});

// =====================================================================
// NOTIF COUNT / CHAT COUNT
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/notifications/count', function () {
        $count = Notification::where('user_id', Auth::id())->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    });

    Route::get('/notif/count', function () {
        $count = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    });

    Route::get('/chat/count', function () {
        $count = \App\Models\Message::where('receiver_id', Auth::id())->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    });
});

// =====================================================================
// SETTINGS
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
});

// =====================================================================
// MESSAGES
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::get('/messages/mark-read/{id}', [MessageController::class, 'markRead'])->name('messages.markRead');
    Route::get('/messages/download/{id}', [MessageController::class, 'download'])->name('messages.download');
});

// =====================================================================
// LAPORAN NILAI (Guru / Kepsek / Siswa)
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/guru/nilai', [ReportController::class, 'guruIndex'])->name('guru.nilai');
    Route::get('/kepsek/laporan-nilai', [ReportController::class, 'kepsekIndex'])->name('kepsek.laporan');
    Route::get('/siswa/nilai-saya', [ReportController::class, 'siswaIndex'])->name('siswa.nilai');
});

// =====================================================================
// JADWAL (Guru) + Jadwal Siswa
// =====================================================================
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/tambah', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal/tambah', [JadwalController::class, 'store'])->name('jadwal.store');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/jadwal-saya', [JadwalController::class, 'siswaJadwal'])->name('jadwal.siswa');
});

// =====================================================================
// CHAT SYSTEM 3 (MessageController)
// =====================================================================
Route::middleware('auth')->group(function () {
    Route::get('/chat', [MessageController::class, 'index'])->name('chat.index');
    Route::get('/chat/{id}', [MessageController::class, 'chatWith'])->name('chat.with');
    Route::post('/chat/{id}', [MessageController::class, 'send'])->name('chat.send');
});

// =====================================================================
// NILAI (Guru) + NILAI Siswa
// =====================================================================
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/tambah', [NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai/tambah', [NilaiController::class, 'store'])->name('nilai.store');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/nilai-saya', [NilaiController::class, 'siswaNilai'])->name('nilai.siswa');
});

Route::middleware('auth')->group(function () {
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');
    Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::post('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.delete');
    Route::get('/pengumuman/{id}/download', [PengumumanController::class, 'downloadLampiran'])->name('pengumuman.download');
});

Route::middleware('auth')->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal/store', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

});

Route::middleware('auth')->group(function () {

    // Daftar tugas
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas/store', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');

    // Upload tugas siswa
    Route::post('/tugas/{id}/upload', [PengumpulanController::class, 'upload'])->name('tugas.upload');

    // guru memberi nilai
    Route::post('/pengumpulan/{id}/nilai', [PengumpulanController::class, 'nilai'])->name('pengumpulan.nilai');

});

Route::middleware('auth')->group(function () {

    // guru input nilai
    Route::get('/rapor', [RaporController::class, 'index'])->name('rapor.index');
    Route::get('/rapor/create', [RaporController::class, 'create'])->name('rapor.create');
    Route::post('/rapor/store', [RaporController::class, 'store'])->name('rapor.store');

    // siswa lihat rapor
    Route::get('/rapor/siswa/{id}', [RaporController::class, 'show'])->name('rapor.siswa');

});

// PDF Rapor
Route::get('/rapor/pdf/{id}', [RaporPdfController::class, 'generate'])
     ->name('rapor.pdf')
     ->middleware('auth');

     // Forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');
Route::post('/forum/comment/{id}', [ForumController::class, 'comment'])->name('forum.comment');
Route::delete('/forum/delete/{id}', [ForumController::class, 'destroyPost'])->name('forum.delete');

Route::get('/parent/dashboard', [ParentController::class, 'dashboard'])
    ->middleware('auth')
    ->name('parent.dashboard');

    Route::get('/superadmin/dashboard', [SuperadminController::class, 'index'])
    ->middleware('auth')
    ->name('superadmin.dashboard');

    // LOGIN
Route::get('/login/{role}', [AuthController::class, 'showLogin'])->name('login.role');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// LOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
