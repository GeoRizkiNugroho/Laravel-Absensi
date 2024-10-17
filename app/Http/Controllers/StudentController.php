<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('name', 'ASC')->simplePaginate(5);
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Validasi data input
         $request->validate([
             'name' => 'required|min:3',
             'nis' => 'required',
             'rombel' => 'required',
             'rayon' => 'required',
         ]);

         Student::create([
             'name' => $request->name,
             'nis' => $request->nis,
             'rombel' => $request->rombel,
             'rayon' => $request->rayon,
         ]);

         return redirect()->back()->with('success', 'Berhasil menambahkan data siswa!');
     }



    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::where('id', $id)->first();
        return view('student.edit', compact('student'));


    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'nis' => 'required|min:3',
            'rombel' => 'required|max:50',
            'rayon' => 'required|max:50',
        ]);

        $studentBefore = Student::find($id);

        $proses = $studentBefore->update([
            'name' => $request->name,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ]);

        if ($proses) {
            return redirect()->route('student.home')->with('success', 'Berhasil mengubah data siswa!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengubah data siswa!');
        }
    }



    /**
     * Remove the specified resource from storage.
     */public function destroy($id)
    {
$proses = Student::where('id', $id )->delete();
if($proses){
return redirect()->back()->with('success', 'Data Siswa Berhasil Dihapus');
    }else{
        return redirect()->back()->with('failed', 'Data Siswa Gagal Dihapus');
    }
}

    }

