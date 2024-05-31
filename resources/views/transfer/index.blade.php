@extends('layouts.master')
@section('title')
    Transfer
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Transfer</li>
@endsection

@section('content')
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <button onclick="addForm('{{ route('transfer.store') }}')" class="btn btn-success btn-s btn-flat">
                <i class="fa fa-plus-circle"></i>Transfer</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Transfer</th>
                    </thead>
                </table>
            </div>
          </div>
        </div>
      </div>
@includeIf('transfer.form')
@endsection

@push('scripts')
    <script>
        let table;
        $(function () {
            table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax:{
                url: '{{ route('transfer.data') }}',
            },
            columns:[
                {data : 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'nama_produk'},
                {data: 'jumlah'},
            ]
        });


        $('#modal-form').validator().on('submit',function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        })
    });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Stok Gudang');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=jumlah').focus();
        }



    </script>
@endpush
