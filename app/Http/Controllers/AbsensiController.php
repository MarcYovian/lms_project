<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // halaman rekap & form seleksi (guru)
    public function index(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if ($user->role == \App\Enums\UserRole::GURU) {
            $teacher = $user->teacher; // Assume relationship exists
            // Get courses taught by teacher
            $courses = \App\Models\Course::where('teacher_id', $teacher->id)
                        ->with(['classroom', 'subject'])
                        ->get();
            
            return view('pages.absensi.index', compact('courses'));
        }

        // Fallback for Admin or others (keep existing functionality tailored if needed, or just list all)
        $absensi = \App\Models\Attendance::with(['student', 'course'])->latest()->paginate(20);
        return view('pages.absensi.index', compact('absensi'));
    }

    // form input absensi (step 2)
    public function create(Request $request)
    {
        $courseId = $request->course_id;
        $date = $request->date;

        if (!$courseId || !$date) {
            return redirect()->route('absensi.index')->with('error', 'Silakan pilih Mata Pelajaran dan Tanggal terlebih dahulu.');
        }

        $teacher = \Illuminate\Support\Facades\Auth::user()->teacher;
        $course = \App\Models\Course::where('id', $courseId)
                    ->where('teacher_id', $teacher->id)
                    ->with('classroom.students')
                    ->firstOrFail();
        
        // Fetch existing attendance
        $existing = \App\Models\Attendance::where('course_id', $courseId)
                    ->where('date', $date)
                    ->get()
                    ->keyBy('student_id');

        $students = $course->classroom->students; // Uses the relationship I added

        return view('pages.absensi.create', compact('course', 'date', 'students', 'existing'));
    }

    // simpan absensi
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'attendance' => 'required|array', // [student_id => status]
        ]);

        $courseId = $request->course_id;
        $date = $request->date;
        $attendanceData = $request->attendance;

        // Verify teacher owns the course
        $teacher = \Illuminate\Support\Facades\Auth::user()->teacher;
        $course = \App\Models\Course::where('id', $courseId)->where('teacher_id', $teacher->id)->firstOrFail();

        foreach ($attendanceData as $studentId => $status) {
            \App\Models\Attendance::updateOrCreate(
                [
                    'course_id' => $courseId,
                    'student_id' => $studentId,
                    'date' => $date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan.');
    }
}
