<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Jika login sebagai student (session custom)
        if ($request->session()->has('student_id')) {
            $student = Student::find($request->session()->get('student_id'));

            if ($student) {
                // Ambil semua mahasiswa lain, diurutkan berdasarkan nama
                $classmates = Student::where('id', '!=', $student->id)
                                    ->where('jurusan', $student->jurusan) // Filter hanya teman sekelas di jurusan yang sama (opsional)
                                    ->orderBy('nama')
                                    ->get();

                // Ambil total seluruh mahasiswa di database
                $totalStudents = Student::count();

                return view('students.student_home', compact('student', 'classmates', 'totalStudents'));
            }

            // Jika student tidak ditemukan, hapus session terkait dan lanjut ke tampilan admin
            $request->session()->forget(['student_id', 'student_nim']);
        }

        // Alur admin: pencarian dan daftar mahasiswa
        $search = $request->search;

        $students = Student::when($search, function ($query, $search) {
            $query->where('nim', 'like', "%$search%")
                ->orWhere('nama', 'like', "%$search%")
                ->orWhere('jurusan', 'like', "%$search%")
                ->orWhere('angkatan', 'like', "%$search%");
        })->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:students',
            'nama' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'email' => 'required|email|unique:students',
            'telepon' => 'nullable'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nim' => 'required|unique:students,nim,' . $student->id,
            'nama' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'telepon' => 'nullable'
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
