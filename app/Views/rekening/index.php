<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Data Rekening</h1>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Tambah Data +
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <?php if (session('error') !== null) : ?>
                        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                    <?php endif ?>

                    <?php if (session('message') !== null) : ?>
                        <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                    <?php endif ?>
                    
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rekening</th>
                                    <th>Saldo</th>
                                    <?php if(session()->get('jabatan') == "Admin") { ?>
                                        <th>Nama Pengguna</th>
                                    <?php } ?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($Rekening as $keys){ ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $keys->rekening ?></td>
                                        <td>Rp. <?= number_format($keys->saldo, 0,'.',',')  ?></td>
                                        <?php if(session()->get('jabatan') == "Admin") { ?>
                                            <td><?= $keys->nama_pengguna ?></td>
                                        <?php } ?>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-update<?= $keys->id ?>">Edit</button>
                                            <a href="<?= base_url('rekening/delete/' . $keys->id)  ?>" class="btn btn-warning btn-sm" >Hapus</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('rekening/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Rekening</label>
                        <input class="form-control" type="text" name="rekening" />
                    </div>
                    <?php if(session()->get('jabatan') == "Admin") { ?>
                        <div class="form-group">
                            <label>Pemilik</label>
                            <select id="id_pengguna" name="id_pengguna" class="form-control select2" style="width: 100%;">
                                <option selected="selected" disabled>Pilih</option>
                                <?php foreach ($Pengguna as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama_pengguna ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id_pengguna" value="<?= session()->get('id_pengguna') ?>" />
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Saldo</label>
                        <input class="form-control" type="text" name="saldo" value="0" readonly/>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php $no = 1; foreach($Rekening as $keys){ ?>
<div class="modal fade" id="modal-update<?= $keys->id ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('rekening/update') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Rekening</label>
                        <input class="form-control" type="hidden" name="id" value="<?= $keys->id ?>" />
                        <input class="form-control" type="text" name="rekening" value="<?= $keys->rekening ?>" />
                    </div>
                    <?php if(session()->get('jabatan') == "Admin") { ?>
                        <div class="form-group">
                            <label>Pemilik</label>
                            <select id="id_pengguna" name="id_pengguna" class="form-control select2">
                                <option selected="selected" disabled>Pilih</option>
                                <?php foreach ($Pengguna as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"  <?= $keys->id_pengguna == $value->id ? 'selected' : '' ?>><?= $value->nama_pengguna ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id_pengguna" value="<?= session()->get('id_pengguna') ?>" />
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Saldo</label>
                        <input class="form-control" type="text" name="saldo"  value="<?= $keys->saldo ?>" readonly/>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<?= $this->endSection() ?>