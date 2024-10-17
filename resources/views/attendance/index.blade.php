@extends('layouts.template')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('failed'))
<div class="alert alert-danger">
    {{ session('failed') }}
</div>
@endif

<div class="container">
    <!-- Tombol tambah absensi dan print -->
    <div class="d-flex justify-content-end mb-3">
        <h2 class="btn btn-secondary me-2">
            <a style="color: white; text-decoration: none;" href="{{route('attendances.create')}}">Tambah Absensi</a>
        </h2>
        <button class="btn btn-primary" id="printButton">Print</button> <!-- Tombol Print -->
    </div>

    <div id="printableContent">
        <!-- Tabel absensi -->
        <table class="table table-striped table-bordered table-hover" id="attendanceTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Rombel</th>
                    <th>Rayon</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $attendance->name }}</td>
                        <td>{{ $attendance->nis }}</td>
                        <td>{{ $attendance->rombel }}</td>
                        <td>{{ $attendance->rayon }}</td>
                        <td>{{ $attendance->date }}</td>
                        <td>
                            <span class="text-primary cursor-pointer" onclick="showModalChangeStatus('{{ $attendance->id }}', '{{ $attendance->name }}', '{{ $attendance->status }}')">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>
                        <td class="d-flex justify-content-center">
                            <button class="deleteButton" onclick="showModalDelete('{{ $attendance->id }}', '{{ $attendance->name }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 50 59" class="bin">
                                    <path fill="#B5BAC1" d="M4.5 3H45.5C47.9853 3 50 5.01472 50 7.5V7.5C50 8.32843 49.3284 9 48.5 9H1.5C0.671571 9 0 8.32843 0 7.5V7.5C0 5.01472 2.01472 3 4.5 3Z"></path>
                                    <path fill="#B5BAC1" d="M17 3C17 1.34315 18.3431 0 20 0H29.3125C30.9694 0 32.3125 1.34315 32.3125 3V3H17V3Z"></path>
                                    <path fill="#B5BAC1" d="M2.18565 18.0974C2.08466 15.821 3.903 13.9202 6.18172 13.9202H43.8189C46.0976 13.9202 47.916 15.821 47.815 18.0975L46.1699 55.1775C46.0751 57.3155 44.314 59.0002 42.1739 59.0002H7.8268C5.68661 59.0002 3.92559 57.3155 3.83073 55.1775L2.18565 18.0974ZM18.0003 49.5402C16.6196 49.5402 15.5003 48.4209 15.5003 47.0402V24.9602C15.5003 23.5795 16.6196 22.4602 18.0003 22.4602C19.381 22.4602 20.5003 23.5795 20.5003 24.9602V47.0402C20.5003 48.4209 19.381 49.5402 18.0003 49.5402ZM29.5003 47.0402C29.5003 48.4209 30.6196 49.5402 32.0003 49.5402C33.381 49.5402 34.5003 48.4209 34.5003 47.0402V24.9602C34.5003 23.5795 33.381 22.4602 32.0003 22.4602C30.6196 22.4602 29.5003 23.5795 29.5003 24.9602V47.0402Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    <path fill="#B5BAC1" d="M2 13H48L47.6742 21.28H2.32031L2 13Z"></path>
                                </svg>
                                <span class="tooltip">Delete</span>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Ubah Status Absensi -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changeStatusModalLabel">Ubah Status Absensi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Ubah status absensi untuk <span id="name_status_user"></span> menjadi:</p>
                <select id="status" name="status" class="form-select">
                    <option value="hadir">Hadir</option>
                    <option value="tidak hadir">Tidak Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="change_status_user">Ubah Status</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus Absensi -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Absensi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus absensi <span id="name_user"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" id="delete_user">Hapus</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    window.showModalChangeStatus = function(id, name, currentStatus) {
        $('#name_status_user').text(name);
        $('#status').val(currentStatus);
        $('#changeStatusModal').modal('show');
        let url = "{{ route('attendances.update', 'id') }}";
        url = url.replace('id', id);
        $('form').attr('action', url);
    }

    window.showModalDelete = function(id, name) {
        $('#name_user').text(name);
        $('#exampleModal').modal('show');
        let url = "{{ route('attendances.destroy', 'id') }}";
        url = url.replace('id', id);
        $('form').attr('action', url);
    }
    // Fungsi untuk mencetak hanya #printableContent
    $('#printButton').on('click', function() {
        var printContents = document.getElementById('printableContent').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // Reload to restore original content
    });
});
</script>

<style>
@media print {
    body * {
        visibility: hidden; /* Hide everything */
    }
    #printableContent, #printableContent * {
        visibility: visible; /* Show printable content */
    }
    #printableContent {
        position: absolute; /* Positioning to center the content */
        left: 0;
        top: 0;
        width: 100%;
        margin: auto; /* Center content */
        text-align: center; /* Center text */
    }
}
</style>
@endpush
