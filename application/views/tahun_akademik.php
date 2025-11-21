<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Tahun Akademik</h3>
    </div>
    <div class="page-content">
        <div class="page-content">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="<?= base_url('tahun-akademik/update'); ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Tahun Akademik</label>
                            <select name="tahun_akademik" class="form-select">
                                <?php foreach ($tahun_list as $t): ?>
                                    <option value="<?= $t; ?>"
                                        <?= ($t == $tahun_aktif->tahun ? 'selected' : ''); ?>>
                                        <?= $t; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">OK</button>
                    </form>
                    <hr>
                    <h6 class="mt-3">Tahun Akademik Aktif:</h6>
                    <span class="fw-bold text-primary"><?= $tahun_aktif->tahun; ?></span>
                </div>
            </div>

        </div>
    </div>
</div>