<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::orderBy('name', 'asc')->get();
        return view('attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('attendance.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'students.*' => 'required|exists:students,id',
            'nis.*' => 'required|numeric',
            'rombel.*' => 'required|string',
            'rayon.*' => 'required|string',
            'dates.*' => 'required|date',
            'statuses.*' => 'required|in:hadir,sakit,izin,alfa',
        ]);

        // Loop through the attendance data and store each entry
        foreach ($request->students as $index => $studentId) {
            Attendance::create([
                'name' => Student::findOrFail($studentId)->name, // Fetch the student's name using the student ID
                'nis' => $request->nis[$index],
                'rombel' => $request->rombel[$index],
                'rayon' => $request->rayon[$index],
                'date' => $request->dates[$index],
                'status' => $request->statuses[$index],
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('attendances.index')->with('success', 'Attendance data has been saved successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:hadir,alfa,izin,sakit',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->status = $request->status; // Ensure request status is valid
        $attendance->updated_at = now(); // Optionally update the updated_at timestamp
        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Status absensi berhasil diubah.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance, $id)
    {
 $proses = Attendance::where('id', $id )->delete();
    if($proses){
    return redirect()->back()->with('success', 'Data Siswa Berhasil Dihapus');
    }else{
        return redirect()->back()->with('failed', 'Data Siswa Gagal Dihapus');
    }
}

}
