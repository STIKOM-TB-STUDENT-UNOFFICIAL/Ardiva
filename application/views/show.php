<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3><?= $detail->namasubkegiatan_detail ?></h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        Tambah
                    </button>
                    <div class="modal fade text-left modal-borderless" id="modalTambah" tabindex="-1"
                        role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <form action="<?= site_url('sub-kegiatan-detail/file/store'); ?>" method="post" enctype="multipart/form-data" class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Berkas</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="idsubkegiatan_detail" value="<?= $detail->idsubkegiatan_detail ?>">
                                    <div class="form-group">
                                        <label class="form-label">Nama Sub Kegiatan Detail</label>
                                        <input type="text" class="form-control" value="<?= $detail->namasubkegiatan_detail ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tahun Akademik</label>
                                        <input type="text" class="form-control" value="<?= $tahun_akademik ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jenis</label>
                                        <select class="form-control" name="jenis" required>
                                            <option value="">-- Pilih Jenis --</option>
                                            <option value="Penetapan">Penetapan</option>
                                            <option value="Pelaksanaan">Pelaksanaan</option>
                                            <option value="Evaluasi">Evaluasi</option>
                                            <option value="Pengendalian">Pengendalian</option>
                                            <option value="Peningkatan">Peningkatan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Topik</label>
                                        <input type="text" name="topik" class="form-control" placeholder="Masukkan topik" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" rows="3" placeholder="Masukkan deskripsi"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Upload File (multiple)</label>
                                        <input type="file" name="file[]" class="form-control" multiple required>
                                        <small class="text-muted">Anda dapat mengupload lebih dari satu file</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalEdit" tabindex="-1"
                        role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
                        <form action="<?= site_url('kegiatan/update'); ?>" method="POST" id="formEdit" class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Berkas</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="idsubkegiatan_detail" value="<?= $detail->idsubkegiatan_detail ?>">
                                    <div class="form-group">
                                        <label class="form-label">Nama Sub Kegiatan Detail</label>
                                        <input id="edit_subkegiatan_detail" type="text" class="form-control" value="<?= $detail->namasubkegiatan_detail ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tahun Akademik</label>
                                        <input id="edit_tahun_akademik" type="text" class="form-control" value="<?= $tahun_akademik ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jenis</label>
                                        <select id="edit_jenis" class="form-control" name="jenis" required>
                                            <option value="">-- Pilih Jenis --</option>
                                            <option value="Penetapan">Penetapan</option>
                                            <option value="Pelaksanaan">Pelaksanaan</option>
                                            <option value="Evaluasi">Evaluasi</option>
                                            <option value="Pengendalian">Pengendalian</option>
                                            <option value="Peningkatan">Peningkatan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Topik</label>
                                        <input id="edit_topik" type="text" name="topik" class="form-control" placeholder="Masukkan topik" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea id="edit_deskripsi" class="form-control" name="deskripsi" rows="3" placeholder="Masukkan deskripsi"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tanggal</label>
                                        <input id="edit_tanggal" type="date" name="tanggal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalDelete" tabindex="-1"
                        role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus Berkas</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="POST" id="formDelete">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Yakin ingin menghapus berkas ini?</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-danger ms-1" data-bs-dismiss="modal">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Ok</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Topik</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Tahun Akademik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($files)): ?>
                                    <tr>
                                        <td colspan="7" class="text-bold-500 text-center py-3">Belum ada file</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1;
                                    foreach ($files as $f): ?>
                                        <tr>
                                            <td class="text-bold-500"><?= $no++ ?></td>
                                            <td class="text-bold-500"><?= $f->jenis ?></td>
                                            <td class="text-bold-500"><?= $f->topik ?></td>
                                            <td class="text-bold-500"><?= $f->deskripsi ?></td>
                                            <td class="text-bold-500"><?= $f->tanggal ?></td>
                                            <td class="text-bold-500"><?= $f->thnakademik ?></td>
                                            <td class="text-bold-500 d-flex gap-1" width="20%">
                                                <a href="<?= site_url('sub-kegiatan-detail/' . $detail->idsubkegiatan_detail . '/files/' . $f->idfile) ?>" class="btn btn-success">Lihat</a>
                                                <button class="btn btn-primary"
                                                    onclick="editFile(
                                                        '<?= $f->idfile ?>',
                                                        '<?= $f->jenis ?>',
                                                        '<?= $f->topik ?>',
                                                        `<?= $f->deskripsi ?>`,
                                                        '<?= $f->tanggal ?>'
                                                    )">
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger" onclick="confirmDelete(<?= $f->idfile ?>)">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function editFile(idfile, jenis, topik, deskripsi, tanggal) {
            document.getElementById('formEdit').action = "<?= site_url('sub-kegiatan-detail/file/update/'); ?>" + idfile;
            
            document.getElementById('edit_jenis').value = jenis;
            document.getElementById('edit_topik').value = topik;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_tanggal').value = tanggal;

            const modal = new bootstrap.Modal(document.getElementById('modalEdit'));
            modal.show();
        }

        function confirmDelete(id) {
            document.getElementById("formDelete").action = "<?= site_url('sub-kegiatan-detail/file/delete/'); ?>" + id;

            let modalEl = document.getElementById('modalDelete');
            let modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>

</div>