<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>File <?= $detail->namasubkegiatan_detail ?></h3>
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
                        <form class="modal-dialog modal-dialog-scrollable" action="<?= site_url('sub-kegiatan-detail/' . $idsub . '/files/' . $idfile . '/add') ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah File</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label">Pilih File (bisa lebih dari 1)</label>
                                        <input type="file" name="file[]" class="form-control" multiple required>
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
                    <div class="modal fade text-left modal-borderless" id="modalEditDetail" tabindex="-1"
                        role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <form id="formEditDetail" class="modal-dialog modal-dialog-scrollable" action="<?= site_url('sub-kegiatan-detail/' . $idsub . '/files/' . $idfile . '/add') ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit File</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label">Nama File (ubah jika diperlukan)</label>
                                        <input type="text" name="filename" id="edit_filename" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Ganti File (opsional)</label>
                                        <input type="file" name="file_replace" class="form-control">
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
                                    <h5 class="modal-title">Konfirmasi Hapus File</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="POST" id="formDelete">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Yakin ingin menghapus file ini?</p>
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
                                    <th>Filename</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($detail_list)): ?>
                                    <tr>
                                        <td colspan="3" class="text-bold-500 text-center py-3">Belum ada file</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1;
                                    foreach ($detail_list as $d): ?>
                                        <tr>
                                            <td class="text-bold-500"><?= $no++ ?></td>
                                            <td class="text-bold-500"><?= htmlspecialchars($d->filename) ?></td>
                                            <td class="text-bold-500 d-flex gap-1">
                                                <a href="<?= site_url('sub-kegiatan-detail/file_detail/view/' . $d->id_file_detail) ?>" target="_blank" class="btn btn-success">Download</a>
                                                <button onclick="openEdit(<?= $d->id_file_detail ?>, '<?= rawurlencode($d->filename) ?>')" class="btn btn-primary">
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger" onclick="confirmDelete(<?= $d->id_file_detail ?>)">
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
        function openEdit(id_file_detail, filenameEncoded) {
            let filename = decodeURIComponent(filenameEncoded);
            let form = document.getElementById('formEditDetail');

            form.action = "<?= site_url('sub-kegiatan-detail/file_detail/update/') ?>" + id_file_detail;
            document.getElementById('edit_filename').value = filename;

            let modal = new bootstrap.Modal(document.getElementById('modalEditDetail'));
            modal.show();
        }

        function confirmDelete(id) {
            document.getElementById("formDelete").action = "<?= site_url('sub-kegiatan-detail/file_detail/delete/'); ?>" + id;

            let modalEl = document.getElementById('modalDelete');
            let modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>

</div>