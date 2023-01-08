@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover py-5">
                    <div class="card-body text-center">
                        <h3 class="font-weight-medium">Absensi</h3>
                        <h4>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</h4>
                        <div class="mx-auto px-5 py-3 rounded" style="width: fit-content!important; background-color:#e6e6e6">
                            <h1 class="font-weight-bold">
                                09:00 - 18:00
                            </h1>
                        </div>
                        <div class="text-center mt-3 mb-3">
                            <div class="row">
                                <div class="offset-5 col-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>
                                                Clock In
                                            </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5>
                                                Clock Out
                                            </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5>
                                                @if ($data)
                                                    {{ $data->clock_in->format('H:i') }}
                                                @else
                                                    --:--
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="col-6">
                                            <h5>
                                                @if ($data)
                                                    @if ($data->clock_out)
                                                    {{ $data->clock_out->format('H:i') }}
                                                    @else
                                                    --:--
                                                    @endif
                                                @else
                                                    --:--
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('absensi.clockIn') }}" class="d-inline" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-lg mr-2">Clock In</button>
                        </form>
                        <form action="{{ route('absensi.clockOut') }}" class="d-inline"  method="POST">
                            @csrf
                            <button class="btn btn-primary btn-lg">Clock Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->

{{-- @include('admin.pages.divisi.create')
@include('admin.pages.divisi.edit') --}}
@endsection

@push('after-script')
<script>
    function editdivisi(edit)
    {
        var divisi = $(edit).data('divisi');
        var route = $(edit).data('route');
        $('#edit_nama_divisi').val(divisi);
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
        title: 'Yakin menghapus divisi ini?',
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
