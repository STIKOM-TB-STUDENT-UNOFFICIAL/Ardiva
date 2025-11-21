<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Sub Kegiatan</h3>
    </div>
    <div class="page-content">
        <div class="page-content">
            <div class="card shadow-sm">
                <div class="card-body">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        Tambah Sub Kegiatan
                    </button>
                    <div class="modal fade text-left modal-borderless" id="modalTambah" tabindex="-1"
                        role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Sub Kegiatan</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="<?= base_url('subkegiatan/store'); ?>" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <select name="idkegiatan" class="form-control" required>
                                                <option value="">-- Pilih Kegiatan --</option>
                                                <?php foreach ($kegiatan as $k): ?>
                                                    <option value="<?= $k->idkegiatan ?>">
                                                        <?= $k->kegiatan ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Kegiatan</label>
                                            <input type="text" name="namasubkegiatan" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ms-1">
                                            <span class="d-none d-sm-block">Submit</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalEdit" tabindex="-1"
                        role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Sub Kegiatan</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="" method="POST" id="formEdit">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <select id="edit_idkegiatan" name="idkegiatan" class="form-control" required>
                                                <option value="">-- Pilih Kegiatan --</option>
                                                <?php foreach ($kegiatan as $k): ?>
                                                    <option value="<?= $k->idkegiatan ?>"><?= $k->kegiatan ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sub Kegiatan</label>
                                            <input type="text" id="edit_namasubkegiatan" name="namasubkegiatan"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ms-1">
                                            <span class="d-none d-sm-block">Submit</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalDelete" tabindex="-1"
                        role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus Sub Kegiatan</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="POST" id="formDelete">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Yakin ingin menghapus sub kegiatan ini?</p>
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
                                    <th>Kegiatan</th>
                                    <th>Sub Kegiatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;foreach ($subkegiatan as $k): ?>
                                    <tr>
                                        <td class="text-bold-500"><?= $i++ ?></td>
                                        <td class="text-bold-500"><?= $k->kegiatan ?></td>
                                        <td class="text-bold-500"><?= $k->namasubkegiatan ?></td>
                                        <td>
                                            <button class="btn btn-primary"
                                                onclick="editSubKegiatan(<?= $k->idsubkegiatan ?>)">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger" onclick="confirmDelete(<?= $k->idsubkegiatan ?>)">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function editSubKegiatan(id) {
            document.getElementById("formEdit").action = "<?= base_url('subkegiatan/update/'); ?>" + id;

            fetch("<?= base_url('subkegiatan/edit/'); ?>" + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("edit_idkegiatan").value = data.idkegiatan;
                    document.getElementById("edit_namasubkegiatan").value = data.namasubkegiatan;

                    let modalEl = document.getElementById('modalEdit');
                    let modal = new bootstrap.Modal(modalEl);
                    modal.show();
                });
        }
        function confirmDelete(id) {
            document.getElementById("formDelete").action = "<?= base_url('sub-kegiatan/delete/'); ?>" + id;

            let modalEl = document.getElementById('modalDelete');
            let modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>
</div>