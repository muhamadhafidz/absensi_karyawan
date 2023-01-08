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
                                <h4 class="card-title font-weight-normal">Data Master Personalia</h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">+ Tambah Personalia</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Gaji/hari</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>Rp. {{ $item->gaji_perday }}/hari</td>
                                    <td>{{ $item->jabatan->nama_jabatan }}</td>
                                    <td>{{ $item->divisi->nama_divisi }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-route="{{ route('master-personalia.update', $item->id) }}" 
                                            data-nip="{{ $item->nip }}" 
                                            data-nama="{{ $item->nama }}" 
                                            data-status="{{ $item->status }}" 
                                            data-gajiperday="{{ $item->gaji_perday }}" 
                                            data-jabatan="{{ $item->jabatan->id }}" 
                                            data-divisi="{{ $item->divisi->id }}" 
                                            onclick="editpersonalia(this)">Ubah</button>
                                        <form action="{{ route('master-personalia.delete', $item->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $item->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="hapus({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
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

@include('admin.pages.personalia.create')
@include('admin.pages.personalia.edit')
@endsection

@push('after-script')
<script>
    function editpersonalia(edit)
    {
        var nip = $(edit).data('nip');
        var nama = $(edit).data('nama');
        var status = $(edit).data('status');
        var gajiperday = $(edit).data('gajiperday');
        var jabatan = $(edit).data('jabatan');
        var divisi = $(edit).data('divisi');
        var route = $(edit).data('route');
        $('#edit_nip').val(nip);
        $('#edit_nama').val(nama);
        $('#edit_status').val(status);
        $('#edit_gaji_perday').val(gajiperday);
        $('#edit_jabatan_'+jabatan).attr('selected', true);
        $('#edit_divisi_'+divisi).attr('selected', true);
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
        title: 'Yakin menghapus personalia ini?',
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
    
</script>
@endpush
