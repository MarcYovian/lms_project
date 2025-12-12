<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role == UserRole::GURU) {
            $teacher = $user->teacher;
            if (!$teacher) return back()->with('error', 'Profile guru tidak ditemukan.');
            
            // Get assignments for courses taught by this teacher
            $courseIds = Course::where('teacher_id', $teacher->id)->pluck('id');
            $tugas = Assignment::whereIn('course_id', $courseIds)
                        ->with('course.classroom', 'course.subject')
                        ->latest()
                        ->get();
        } elseif ($user->role == UserRole::SISWA) {
            $student = $user->student;
            if (!$student) return back()->with('error', 'Profile siswa tidak ditemukan.');

            // Get assignments for the student's classroom
            $classroom = $student->classroom;
            if (!$classroom) return back()->with('error', 'Siswa tidak masuk kelas.');

            $courseIds = $classroom->courses->pluck('id');
            $tugas = Assignment::whereIn('course_id', $courseIds)
                        ->with('course.subject')
                        ->latest()
                        ->get();
        } else {
            // Admin or others
            $tugas = Assignment::with('course.classroom', 'course.subject')->latest()->get();
        }

        return view('pages.tugas.index', compact('tugas'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role != UserRole::GURU) {
            abort(403, 'Hanya guru yang dapat membuat tugas.');
        }

        $teacher = $user->teacher;
        $courses = Course::where('teacher_id', $teacher->id)
                    ->with('classroom', 'subject')
                    ->get();

        return view('pages.tugas.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $user = Auth::user();
        $teacher = $user->teacher;

        // Verify ownership
        $course = Course::where('id', $request->course_id)
                    ->where('teacher_id', $teacher->id)
                    ->firstOrFail();

        Assignment::create([
            'course_id' => $course->id,
            'title' => $request->judul,
            'description' => $request->deskripsi,
            'due_date' => $request->deadline,
        ]);

        return redirect()->route('tugas.index')
            ->with('success', 'Tugas berhasil dibuat!');
    }

    public function show($id)
    {
        $tugas = Assignment::with(['course.classroom.students.user', 'course.subject', 'submissions.student'])->findOrFail($id);
        
        // Get all students in the class
        $students = $tugas->course->classroom->students;
        
        // Map students to their submission status
        $studentStatuses = $students->map(function($student) use ($tugas) {
            $submission = $tugas->submissions->where('student_id', $student->id)->first();
            return [
                'student' => $student,
                'is_submitted' => $submission ? true : false,
                'submission' => $submission,
            ];
        });

        // Authorization check could be added here
        
        return view('pages.tugas.detail', compact('tugas', 'studentStatuses'));
    }
}
