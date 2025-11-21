<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Akses</h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        Tambah Akses
                    </button>
                    <div class="modal fade text-left modal-borderless" id="modalTambah" tabindex="-1"
                        role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Akses</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="post" action="<?= base_url('akses/insert'); ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>User ID</label>
                                            <input type="text" name="userid" class="form-control mb-2" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" class="form-control mb-2" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control mb-2" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level" class="form-control mb-2">
                                                <?php if ($level == 'admin'): ?>
                                                    <option value="admin">Admin</option>
                                                    <option value="dosen">Dosen</option>
                                                <?php endif; ?>
                                                <option value="mahasiswa">Mahasiswa</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" name="foto" class="form-control mb-2">
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
                                    <h5 class="modal-title">Edit Akses</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="post" action="<?= base_url('akses/update'); ?>" enctype="multipart/form-data" id="formEdit">
                                    <div class="modal-body">
                                        <input type="hidden" name="userid" id="e_userid">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama_lengkap" id="e_nama" class="form-control mb-2" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control mb-2" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        </div>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level" id="e_level" class="form-control mb-2">
                                                <option value="admin">Admin</option>
                                                <option value="dosen">Dosen</option>
                                                <option value="mahasiswa">Mahasiswa</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Blokir</label>
                                            <select name="blokir" id="e_blokir" class="form-control mb-2">
                                                <option value="N">Tidak</option>
                                                <option value="Y">Ya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" name="foto" class="form-control mb-2">
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
                                    <h5 class="modal-title">Konfirmasi Hapus Akses</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form method="POST" id="formDelete">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Yakin ingin menghapus akses ini?</p>
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
                                    <th>User ID</th>
                                    <th>Nama Lengkap</th>
                                    <th>Foto</th>
                                    <th>Level</th>
                                    <th>Blokir</th>
                                    <th>Last Login</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($users as $u): ?>
                                    <tr>
                                        <td class="text-bold-500"><?= $no++; ?></td>
                                        <td class="text-bold-500"><?= $u->userid; ?></td>
                                        <td class="text-bold-500"><?= $u->nama_lengkap; ?></td>
                                        <td class="text-bold-500">
                                            <?php if ($u->foto == null): ?>
                                                <span>unknown</span>
                                            <?php else: ?>
                                                <img src="data:image/jpeg;base64,<?= base64_encode($u->foto); ?>" width="50">
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-bold"><?= $u->level; ?></td>
                                        <td class="text-bold"><?= $u->blokir; ?></td>
                                        <td class="text-bold"><?= $u->last_login; ?></td>
                                        <td class="text-bold">
                                            <?php if (
                                                ($level == 'admin') ||
                                                ($level == 'dosen' && $u->level == 'mahasiswa')
                                            ): ?>
                                                <button class="btn btn-primary"
                                                    onclick="editUser('<?= $u->userid ?>',
                                                        '<?= $u->nama_lengkap ?>',
                                                        '<?= $u->level ?>',
                                                        '<?= $u->blokir ?>')"
                                                    data-bs-toggle="modal" data-bs-target="#modalEdit">
                                                    Edit
                                                </button>

                                                <button
                                                    onclick="confirmDelete('<?= $u->userid ?>')"
                                                    class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function editUser(userid, nama, level, blokir) {
            document.getElementById('e_userid').value = userid;
            document.getElementById('e_nama').value = nama;
            document.getElementById('e_level').value = level;
            document.getElementById('e_blokir').value = blokir;
        }

        function confirmDelete(id) {
            document.getElementById("formDelete").action = "<?= base_url('akses/delete/'); ?>" + id;

            let modalEl = document.getElementById('modalDelete');
            let modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    </script>

</div>