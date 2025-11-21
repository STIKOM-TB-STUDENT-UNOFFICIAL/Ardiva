<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Sub Kegiatan Detail</h3>
    </div>
    <div class="page-content">
        <div class="page-content">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="modal fade text-left modal-borderless" id="modalTambah" tabindex="-1"
                        role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <form class="modal-dialog modal-dialog-scrollable" action="<?= site_url('sub-kegiatan-detail/store'); ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Sub Kegiatan Detail</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Sub Kegiatan</label>
                                        <select name="idsubkegiatan" class="form-control" required>
                                            <option value="">-- Pilih Kegiatan --</option>
                                            <?php foreach ($subkegiatan as $s): ?>
                                                <option value="<?= $s->idsubkegiatan ?>"><?= $s->nama_kegiatan ?> - <?= $s->namasubkegiatan ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Sub Kegiatan Detail</label>
                                        <input type="text" name="namasubkegiatan_detail" class="form-control" required>
                                    </div>
                                    <label>Instrumen</label><br>
                                    <?php foreach ($instrumen as $i): ?>
                                        <input class="form-check-input" type="checkbox" name="instrumen[]" value="<?= $i->idinstrumen ?>" id="<?= $i->idinstrumen ?>">
                                        <label class="form-check-label" for="<?= $i->idinstrumen ?>"><?= $i->namainstrumen ?></label><br>
                                    <?php endforeach; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-1">
                                        <span class="d-none d-sm-block">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalEdit" tabindex="-1"
                        role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
                        <form id="formEdit" class="modal-dialog modal-dialog-scrollable" action="<?= site_url('sub-kegiatan-detail/store'); ?>" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Sub Kegiatan Detail</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Sub Kegiatan</label>
                                        <select name="idsubkegiatan" id="editSubkegiatan" class="form-select" required>
                                            <?php foreach ($subkegiatan as $s): ?>
                                                <option value="<?= $s->idsubkegiatan ?>">
                                                    <?= $s->nama_kegiatan ?> - <?= $s->namasubkegiatan ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nama Sub Kegiatan Detail</label>
                                        <input type="text" name="namasubkegiatan_detail" id="editNamaDetail" class="form-control" required>
                                    </div>
                                    <label class="form-label">Instrumen</label>
                                    <div id="editInstrumenList">
                                        <?php foreach ($instrumen as $i): ?>
                                            <div class="form-check">
                                                <input class="form-check-input editInstrumen"
                                                    type="checkbox"
                                                    name="instrumen[]"
                                                    value="<?= $i->idinstrumen ?>"
                                                    id="ins<?= $i->idinstrumen ?>">
                                                <label class="form-check-label" for="ins<?= $i->idinstrumen ?>">
                                                    <?= $i->namainstrumen ?>
                                                </label>
                                            </div>
                                        <?php endforeach ?>
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
                            </div>
                        </form>
                    </div>
                    <div class="modal fade text-left modal-borderless" id="modalDelete" tabindex="-1"
                        role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus Sub Kegiatan Detail</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="POST" id="formDelete">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Yakin ingin menghapus sub kegiatan detail ini?</p>
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
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Cari</label>
                                <input type="text" class="form-control" name="q" placeholder="Search..." value="<?= $filter_q ?>">
                            </div>

                            <div class="col-md-4">
                                <label>Instrumen</label>
                                <select class="form-control" name="instrumen">
                                    <option value="">-- Semua Instrumen --</option>
                                    <?php foreach ($instrumen as $i): ?>
                                        <option value="<?= $i->idinstrumen ?>"
                                            <?= ($filter_instrumen == $i->idinstrumen ? 'selected' : '') ?>>
                                            <?= $i->namainstrumen ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button class="btn btn-primary form-control">Filter</button>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-success form-control" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sub Kegiatan</th>
                                    <th>Sub Kegiatan Detail</th>
                                    <th>Instrumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = $offset ?>
                                <?php foreach ($list as $k): ?>
                                    <tr>
                                        <td class="text-bold-500"><?= $no++ ?></td>
                                        <td class="text-bold-500"><?= $k->namasubkegiatan ?></td>
                                        <td class="text-bold-500"><?= $k->namasubkegiatan_detail ?></td>
                                        <td class="text-bold-500">
                                            <?php
                                            $ins = $this->Subkegiatan_detail_model->get_instrumen_by_detail($k->idsubkegiatan_detail);
                                            foreach ($ins as $i) echo "- $i->namainstrumen<br>";
                                            ?>
                                        </td>
                                        <td>
                                            <a href="/sub-kegiatan-detail/<?= $k->idsubkegiatan_detail ?>" class="btn btn-success">
                                                Lihat
                                            </a>
                                            <button class="btn btn-primary"
                                                onclick="editSubKegiatanDetail(<?= $k->idsubkegiatan_detail ?>)">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger" onclick="confirmDelete(<?= $k->idsubkegiatan_detail ?>)">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div>
                            <?= $pagination ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function editSubKegiatanDetail(id) {
            document.getElementById("formEdit").action =
                "<?= site_url('sub-kegiatan-detail/update/') ?>" + id;

            document.querySelectorAll(".editInstrumen").forEach(cb => {
                cb.checked = false;
            });

            fetch("<?= site_url('sub-kegiatan-detail/edit/') ?>" + id)
                .then(response => response.json())
                .then(res => {
                    document.getElementById("editSubkegiatan").value = res.detail.idsubkegiatan;
                    document.getElementById("editNamaDetail").value = res.detail.namasubkegiatan_detail;
                    res.selected_instrumen.forEach(item => {
                        let cb = document.getElementById("ins" + item);
                        if (cb) cb.checked = true;
                    });
                    let modalEl = document.getElementById('modalEdit');
                    let modal = new bootstrap.Modal(modalEl);
                    modal.show();
                });
        }

        function confirmDelete(id) {
            document.getElementById("formDelete").action = "<?= site_url('sub-kegiatan-detail/delete/'); ?>" + id;

            let modalEl = document.getElementById('modalDelete');
            let modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>
</div>