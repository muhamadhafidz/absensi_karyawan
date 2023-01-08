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
                                <h4 class="card-title font-weight-normal">Riwayat Penggajian</h4>
                            </div>
                            <div class="col text-right">
                                <form action="{{ route('penggajian.gaji') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" >Gaji semua Karyawan pada bulan ini</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Tanggal Penggajian</th>
                                <th>Total Karyawan</th>
                                <th>Total Penggajian</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['tanggal'] }}</td>
                                    <td>{{ $item['total_karyawan'] }}</td>
                                    <td>Rp. {{ $item['total_penggajian'] }}</td>
                                    <td>
                                        <a href="{{ route('penggajian.detail', $item['id']) }}" class="btn btn-info">Detail</a>
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