<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Kegiatan</h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        Tambah Kegiatan
                    </button>
                    <div class="modal fade text-left modal-borderless" id="modalTambah" tabindex="-1"
                        role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kegiatan</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="<?= base_url('kegiatan/store'); ?>" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <input type="text" name="kegiatan" class="form-control" required>
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
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalEdit" tabindex="-1"
                        role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Kegiatan</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="<?= base_url('kegiatan/update'); ?>" method="POST" id="formEdit">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Kegiatan</label>
                                            <input type="text" id="edit_kegiatan" name="kegiatan" class="form-control" required>
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
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalDelete" tabindex="-1"
                        role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus Kegiatan</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="POST" id="formDelete">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Yakin ingin menghapus kegiatan ini?</p>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($kegiatan as $k): ?>
                                    <tr>
                                        <td class="text-bold-500"><?= $i++ ?></td>
                                        <td class="text-bold-500"><?= $k->kegiatan ?></td>
                                        <td>
                                            <button class="btn btn-primary"
                                                onclick="editKegiatan(<?= $k->idkegiatan ?>)">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger" onclick="confirmDelete(<?= $k->idkegiatan ?>)">
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
        function editKegiatan(id) {
            document.getElementById("formEdit").action = "<?= base_url('kegiatan/update/'); ?>" + id;

            fetch("<?= base_url('kegiatan/edit/'); ?>" + id)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    document.getElementById("edit_kegiatan").value = data.kegiatan;
                    let modalEl = document.getElementById('modalEdit');
                    let modal = new bootstrap.Modal(modalEl);
                    modal.show();
                });
        }

        function confirmDelete(id) {
            document.getElementById("formDelete").action = "<?= base_url('kegiatan/delete/'); ?>" + id;

            let modalEl = document.getElementById('modalDelete');
            let modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>

</div>