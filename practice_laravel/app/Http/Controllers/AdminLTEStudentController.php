<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminLTEStudentController extends Controller
{
    public function create()
    {
        $data['module']['name'] = "Tambah Mahasiswa";
        // return view('adminlte.student.create', ['data' => $data]);
        return view('adminlte.create', compact('data'));
    }

    public function student()
    {
        $mahasiswa = Student::all();
        return view('adminlte.student', ['mahasiswa' => $mahasiswa]);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8|unique:students',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $mahasiswa = new Student();
        $mahasiswa->nim = $validateData['nim'];
        $mahasiswa->name = $validateData['nama'];
        $mahasiswa->gender = $validateData['jenis_kelamin'];
        $mahasiswa->departement = $validateData['jurusan'];
        $mahasiswa->address = $validateData['alamat'];

        if ($request->hasFile('image')) {
            $extFile = $request->image->getClientOriginalExtension();
            $namaFile = 'user-' . time() . "." . $extFile;
            $path = $request->image->move('assets/images', $namaFile);
            $mahasiswa->image = $path;
        }

        $mahasiswa->save();
        // $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('adminlte.student')->with('pesan', 'Penambahan data berhasil');
    }

    public function show($student_id)
    {
        $result = Student::findOrFail($student_id);
        return view('adminlte.show', ['student' => $result]);
    }

    public function edit($student_id)
    {
        $result = Student::findOrFail($student_id);
        return view('adminlte.edit', ['student' => $result]);
    }

    public function update(Request $request, Student $student)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8,unique:students',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image_new' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $student->nim = $validateData['nim'];
        $student->name = $validateData['nama'];
        $student->gender = $validateData['jenis_kelamin'];
        $student->departement = $validateData['jurusan'];
        $student->address = $validateData['alamat'];
        if ($request->hasFile('image_new')) {
            $extFile = $request->image_new->getClientOriginalExtension();
            $namaFile = 'user-' . time() . "." . $extFile;
            File::delete($student->image);
            $path = $request->image_new->move('assets/images', $namaFile);
            $student->image = $path;
        }

        $student->save();
        // $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('adminlte.show', ['student' => $student->id])->with('pesan', 'Perubahan data berhasil');
    }

    public function destroy(Request $request, Student $student)
    {
        File::delete($student->image);
        $student->delete();
        return redirect()->route('adminlte.student')->with('pesan', 'Hapus data berhasil');
    }
}
