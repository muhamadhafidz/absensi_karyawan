@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title font-weight-normal">Daftar Pengajuan Izin</h4>
                            </div>
                            <div class="col text-right">
                                {{-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">+ Ajukan Izin</button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Personalia</th>
                                <th>Tanggal Izin</th>
                                <th>Jenis Izin</th>
                                <th>Keterangan</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->personalia->nama }} ({{ $item->personalia->nip }})</td>
                                    <td>{{ $item->tanggal_izin }}</td>
                                    <td>{{ $item->jenis_izin }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{!! $item->file_bukti ? '<img style="height: 60px" src="'.asset('storage/'.$item->file_bukti).'">' : '-' !!}</td>
                                    @if ($item->status == 'menunggu approval')
                                    <td><span class="badge badge-warning">{{ $item->status }}</span></td>
                                    @elseif ($item->status == 'disetujui')
                                    <td><span class="badge badge-success">{{ $item->status }}</span></td>
                                    @elseif ($item->status == 'ditolak')
                                    <td><span class="badge badge-danger">{{ $item->status }}</span></td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    <td>
                                        @if ($item->status == 'menunggu approval')
                                        <form action="{{ route('approval-izin.tolak', $item->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $item->id }}">
                                            @csrf
                                            <button type="button" onclick="hapus({{ $item->id }})" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                        <form action="{{ route('approval-izin.approve', $item->id) }}" method="post" class="ml-1 d-inline" id="form-approve-{{ $item->id }}">
                                            @csrf
                                            <button type="button" onclick="approve({{ $item->id }})" class="btn btn-success btn-sm">Setujui</button>
                                        </form>
                                        @else
                                        <i>tidak ada aksi</i>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
@endsection

@push('after-script')
<script>
    function editJabatan(edit)
    {
        var jabatan = $(edit).data('jabatan');
        var route = $(edit).data('route');
        $('#edit_nama_jabatan').val(jabatan);
        $('#form-edit').attr('action', route);
        $('#edit').modal('show');
    }

    $(document).ready(function(){
        $('#crudTable').DataTable({
          dom: 'Blfrtip',
          buttons: [
                'excel',  'print',
{
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
            ],
          "scrollX": true
        });
    });
    function hapus(id){
        Swal.fire({
        title: 'Yakin menolak pengajuan ini ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form-hapus-'+id).submit();
        }
        });
    }
    function approve(id){
        Swal.fire({
        title: 'Yakin menyetujui pengajuan ini ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form-approve-'+id).submit();
        }
        });
    }
    
</script>
@endpush