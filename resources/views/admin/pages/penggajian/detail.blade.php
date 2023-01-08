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
                                <h4 class="card-title font-weight-normal">Detail Riwayat Penggajian</h4>
                            </div>
                            <div class="col text-right">
                                <p>Tanggal Penggajian</p>
                                <h4>{{ $data->first()->tanggal_penggajian }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Karyawann</th>
                                <th>Gaji Perhari</th>
                                <th>Total Hari Masuk</th>
                                <th>Total Penggajian</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->personalia->nip }}</td>
                                    <td>{{ $item->personalia->nama }}</td>
                                    <td>Rp. {{ $item->gaji_perday }}</td>
                                    <td>{{ $item->total_day }}</td>
                                    <td>Rp. {{ $item->total_gaji }}</td>
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
        title: 'Yakin menghapus pengajuan ini ini?',
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