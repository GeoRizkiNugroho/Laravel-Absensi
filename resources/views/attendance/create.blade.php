@extends('layouts.template')

@section('content')
<div class="card d-block mx-auto my-3">
    <form action="{{ route('attendances.store') }}" method="POST" class="card p-5">
        @csrf

        <div id="absensi-container">
            <div class="absensi-item mb-3">
                <label for="students[0]">Absensi #1</label>
                <select name="students[0]" class="form-control mb-2" required>
                    @foreach ($students as $index => $student)
                        <option value="{{ $student['id'] }}" {{ $index === 0 ? 'selected' : '' }}>
                            {{ $student['name'] }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="nis[0]" class="form-control mb-2" placeholder="NIS" value="{{ $students[0]['nis'] }}" required>
                <input type="text" name="rombel[0]" class="form-control mb-2" placeholder="Rombel" value="{{ $students[0]['rombel'] }}" required>
                <input type="text" name="rayon[0]" class="form-control mb-2" placeholder="Rayon" value="{{ $students[0]['rayon'] }}" required>
                <input type="date" name="dates[0]" class="form-control mb-2" required>
                <select name="statuses[0]" class="form-control mb-3" required>
                    <option value="hadir">Hadir</option>
                    <option value="sakit">Sakit</option>
                    <option value="izin">Izin</option>
                    <option value="alfa">Alfa</option>
                </select>
                <button type="button" class="btn btn-danger remove-absensi">Hapus</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="add-absensi">Tambah Absensi</button>
        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
    </form>
</div>

<script>
    // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
    const today = new Date().toISOString().split('T')[0];
    document.querySelectorAll('input[type="date"]').forEach(input => input.value = today);

    // Load students from Blade into JavaScript
    const students = @json($students);

    let absensiCount = 1; // This is used to track the next absensi number

    // Function to generate the student options dynamically and set the selected value based on absensiCount
    function generateStudentOptions(selectedIndex) {
        let studentOptions = '<option hidden disabled>Pilih</option>';
        students.forEach((student, index) => {
            const isSelected = index === selectedIndex ? 'selected' : '';
            studentOptions += `<option value="${student.id}" ${isSelected}>${student.name}</option>`;
        });
        return studentOptions;
    }

    // Function to add a new absensi row
    function addNewAbsensiRow() {
        const container = document.getElementById('absensi-container');
        const newAbsensiItem = document.createElement('div');
        newAbsensiItem.classList.add('absensi-item', 'mb-3');

        newAbsensiItem.innerHTML = `
            <label for="students[${absensiCount}]">Absensi #${absensiCount + 1}</label>
            <select name="students[${absensiCount}]" class="form-control mb-2" required>
                ${generateStudentOptions(absensiCount)}  <!-- Pre-select student based on absensiCount -->
            </select>
            <input type="text" name="nis[${absensiCount}]" class="form-control mb-2" placeholder="NIS" value="${students[absensiCount].nis}" required>
            <input type="text" name="rombel[${absensiCount}]" class="form-control mb-2" placeholder="Rombel" value="${students[absensiCount].rombel}" required>
            <input type="text" name="rayon[${absensiCount}]" class="form-control mb-2" placeholder="Rayon" value="${students[absensiCount].rayon}" required>
            <input type="date" name="dates[${absensiCount}]" class="form-control mb-2" value="${today}" required>
            <select name="statuses[${absensiCount}]" class="form-control mb-3" required>
                <option value="hadir">Hadir</option>
                <option value="sakit">Sakit</option>
                <option value="izin">Izin</option>
                <option value="alfa">Alfa</option>
            </select>
            <button type="button" class="btn btn-danger remove-absensi">Hapus</button>
        `;
        container.appendChild(newAbsensiItem);
        absensiCount++; // Increment the count for the next item
    }

    // Function to remove absensi row
    function removeAbsensiRow(event) {
        if (event.target.classList.contains('remove-absensi')) {
            event.target.parentElement.remove();
        }
    }

    // Add event listener for adding new absensi row
    document.getElementById('add-absensi').addEventListener('click', addNewAbsensiRow);

    // Add event listener for removing absensi row
    document.getElementById('absensi-container').addEventListener('click', removeAbsensiRow);
</script>
@endsection
