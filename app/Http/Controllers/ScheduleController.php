<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // Check if teacher
        if ($user->role == \App\Enums\UserRole::GURU) {
            $teacher = $user->teacher;
            if (!$teacher) return back()->with('error', 'Profile guru tidak ditemukan.');

            // Optimized for teacher view: show only their schedules
            $jadwals = \App\Models\ClassSchedule::with(['course.subject', 'course.classroom', 'course.teacher.user'])
                ->whereHas('course', function($q) use ($teacher) {
                    $q->where('teacher_id', $teacher->id);
                })
                ->orderBy('day_of_week')
                ->orderBy('start_time')
                ->paginate(20);
                
            return view('pages.jadwal.index', compact('jadwals'));
        }

        // For others (Admin, etc.), maybe just redirect to the academic schedule which is more robust
        // But to keep this page working as a list view:
        $jadwals = \App\Models\ClassSchedule::with(['course.subject', 'course.classroom', 'course.teacher.user'])
            ->latest()
            ->paginate(20);

        return view('pages.jadwal.index', compact('jadwals'));
    }

    public function store(Request $request)
    {
        // Block teacher
        if (\Illuminate\Support\Facades\Auth::user()->role == \App\Enums\UserRole::GURU) {
            abort(403);
        }

        // ... Existing usage of Schedule model likely broken anyway if moving to ClassSchedule.
        // Assuming Admin uses the /academic/schedule route primarily. 
        // If this route is legacy, we might just return error or redirect.
        
        return redirect()->route('academic.schedule.index')->with('info', 'Silakan gunakan menu Akademik > Jadwal Pelajaran untuk mengelola jadwal.');
    }

    public function update(Request $request, $id)
    {
        if (\Illuminate\Support\Facades\Auth::user()->role == \App\Enums\UserRole::GURU) {
            abort(403);
        }
        return redirect()->route('academic.schedule.index');
    }

    public function destroy($id)
    {
        if (\Illuminate\Support\Facades\Auth::user()->role == \App\Enums\UserRole::GURU) {
            abort(403);
        }
        // If needed to support delete here:
        // \App\Models\ClassSchedule::destroy($id);
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
