<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Catatan Keuangan</h1>
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
                                    <th>Nominal</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Rekening</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <?php if(session()->get('jabatan') == "Admin") { ?>
                                        <th>Nama Pengguna</th>
                                    <?php } ?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($Keuangan as $key){ ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Rp. <?= number_format($key->nominal, 0, ".",",") ?></td>
                                        <td><?= str_replace('_',' ', $key->jenis) ?></td>
                                        <td><?= $key->kategori ?></td>
                                        <td><?= $key->rekening ?></td>
                                        <td><?= $key->keterangan ?></td>
                                        <td><?= $key->tanggal ?></td>
                                        <?php if(session()->get('jabatan') == "Admin") { ?>
                                            <td><?= $key->nama_pengguna ?></td>
                                        <?php } ?>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-update<?= $key->id_keuangan ?>">Edit</button>
                                            <a href="<?= base_url('keuangan/delete/' . $key->id_keuangan)  ?>" class="btn btn-warning btn-sm" >Hapus</button>
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
			<form action="<?= base_url('keuangan/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis</label>
                        <select id="jenis" name="jenis" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                            <option value="Uang_Masuk">Uang Masuk</option>
                            <option value="Uang_Keluar">Uang Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select id="id_kategori" name="id_kategori" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rekening</label>
                        <select id="id_rekening" name="id_rekening" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                            <?php foreach ($Rekening as $key => $value) { ?>
                                <option value="<?= $value->id ?>"><?= $value->rekening . " - Rp. " . number_format($value->saldo, 0,'.',',') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input class="form-control" type="number" name="nominal" required />
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea row="5" class="form-control" name="keterangan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input class="form-control" type="date" id="tanggal" name="tanggal" value="<?= date("Y-m-d") ?>" required/>
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


<?php $no = 1; foreach($Keuangan as $keys){ ?>
<div class="modal fade" id="modal-update<?= $keys->id_keuangan ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('keuangan/update') ?>" method="POST">
                <div class="modal-body">
                    <input class="form-control" type="hidden" name="id" value="<?= $keys->id_keuangan ?>"/>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select id="jenis" name="jenis" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                            <option value="Uang_Masuk" <?=  $keys->jenis == "Uang_Masuk" ? "selected" : "" ?> >Uang Masuk</option>
                            <option value="Uang_Keluar" <?= $keys->jenis == "Uang_Keluar" ? "selected" : "" ?> >Uang Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select id="id_kategori" name="id_kategori" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                            <?php
                                $db      = \Config\Database::connect();
                                $builder = $db->table('kategori');
                                $pengguna = $db->table('pengguna');
                        
                                if(session()->get('jabatan') == 'Admin'){
                                    $Kategori = (object) $builder->where('jenis', $keys->jenis)->getResult();
                                } else {
                                    $Kategori = (object) $builder->where('jenis', $keys->jenis)->where('id_pengguna', $pengguna->where('email', session('email'))->get()->getRowArray()['id'])->get()->getResult();    
                                } ?>
                        
                            <?php foreach ($Kategori as $key => $value) { ?>
                                    <option value="<?= $value->id ?>" <?= $value->kategori == $keys->kategori ? "selected" : "" ?>><?= $value->kategori ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Rekening</label>
                        <select id="id_rekening" name="id_rekening" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Pilih</option>
                            <?php foreach ($Rekening as $key => $value) { ?>
                                <option value="<?= $value->id ?>" <?= $value->id == $keys->id_rekening ? "selected" : "" ?>><?= $value->rekening . " - Rp. " . number_format($value->saldo, 0,'.',',') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input class="form-control" type="hidden" id="nominal" name="old_nominal" value="<?= $keys->nominal ?>"/>
                        <input class="form-control" type="number" id="nominal" name="nominal" value="<?= $keys->nominal ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea row="5" class="form-control" name="keterangan"><?= $keys->keterangan ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input class="form-control" type="date" id="tanggal" name="tanggal" value="<?= $keys->tanggal ?>"/>
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
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(document).ready(function(){
        $('#jenis').change(function(){
        const jenis = $('#jenis').val();
        console.log(jenis);
        $.ajax({
            type: "GET",
            url: "<?= base_url('keuangan/kategori/') ?>" + jenis,
            success: function(html)
            {
                $('#id_kategori').html(html)
            }
        })
    })
    })
</script>
<?= $this->endSection() ?>