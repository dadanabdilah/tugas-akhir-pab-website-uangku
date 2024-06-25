<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Laporan Catatan Keuangan</h1>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-keuangan">
                            Export Laporan +
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
                                    <th>Nominal</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <?php if(session()->get('jabatan') == "Admin") { ?>
                                        <th>Nama Pengguna</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($Keuangan as $key){ ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Rp. <?= number_format($key->nominal, 0, ".",",") ?></td>
                                        <td><?= str_replace('_', ' ', $key->jenis) ?></td>
                                        <td><?= $key->kategori ?></td>
                                        <td><?= $key->keterangan ?></td>
                                        <td><?= $key->tanggal ?></td>
                                        <?php if(session()->get('jabatan') == "Admin") { ?>
                                            <td><?= $key->nama_pengguna ?></td>
                                        <?php } ?>
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
<div class="modal fade" id="modal-keuangan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Export Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('laporan/export/keuangan') ?>" method="POST" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis</label>
                        <select id="jenis" name="jenis" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                            <option value="Semua">Semua</option>
                            <option value="Uang Masuk">Uang Masuk</option>
                            <option value="Uang Keluar">Uang Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input class="form-control" type="date" id="tanggal_awal" name="tanggal_awal" value="<?= date("Y-m-d") ?>"  required/>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir" value="<?= date("Y-m-d") ?>"  required/>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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