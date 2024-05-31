<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog" role="document">
      <form action="" method="post" class="form-horizontal">
        @csrf
        @method('post')
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form group row">
                    <label class="col-md-3 col-md-offset-1 control-label">Dari</label>
                    <label class="col-md-offset-2 control-label">Gudang</label>
                </div>
            <br>
                <div class="form group row">
                    <label for="id_produk" class="col-md-3 col-md-offset-1 control-label">Nama Produk</label>
                    <div class="col-md-8">
                        <select name="id_produk" id="id_produk" class="form-control"required>
                        <option  value="">Pilih Nama Produk</option>
                        @foreach ($produk as $key => $item)
                            <option value="{{ $key }}">{{$item}}</option>
                         @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
              <div class="form group row">
                <label for="jumlah" class="col-md-3 col-md-offset-1 control-label">Jumlah </label>
                <div class="col-md-8">
                    <input type="number" name="jumlah" class="form-control" required autofocus>
                    <span class="help-block with-errors"></span>
                </div>
              </div>
              <div class="form group row">
                <label class="col-md-3 col-md-offset-1 control-label">Ke</label>
                <label class="col-md-offset-2 control-label">Toko</label>
            </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-flat btn-primary">Simpan</button>
              <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal">Keluar</button>
            </div>
          </div>
      </form>
    </div>
  </div>
