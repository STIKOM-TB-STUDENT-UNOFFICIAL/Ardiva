<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Laporan</h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
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

                            <div class="col-md-4">
                                <label>Jenis</label>
                                <select class="form-control" name="jenis" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Penetapan">Penetapan</option>
                                    <option value="Pelaksanaan">Pelaksanaan</option>
                                    <option value="Evaluasi">Evaluasi</option>
                                    <option value="Pengendalian">Pengendalian</option>
                                    <option value="Peningkatan">Peningkatan</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>&nbsp;</label>
                                <button class="btn btn-primary form-control">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th class="align-middle">Kegiatan</th>
                                    <th class="align-middle">Sub Kegiatan</th>
                                    <th class="align-middle">Detail</th>
                                    <th class="align-middle">Jenis File</th>
                                    <th class="align-middle">File</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($list as $k): ?>

                                    <?php
                                    // -------------------------------------------------------------
                                    // PRE-CALCULATION ROWSPAN (Hitung Total Baris Sebelum Cetak)
                                    // -------------------------------------------------------------
                                    $totalKegiatanRows = 0;

                                    if (!empty($k->subkegiatan)) {
                                        foreach ($k->subkegiatan as $s) {
                                            $s->totalSubRows = 0;

                                            if (!empty($s->detail)) {
                                                foreach ($s->detail as $d) {
                                                    $d->totalDetailRows = 0;

                                                    if (!empty($d->files_grouped)) {
                                                        foreach ($d->files_grouped as $jenis => $fg) {
                                                            $fg_rows = 0;
                                                            // Hitung file di dalam jenis
                                                            if (!empty($fg['files'])) {
                                                                foreach ($fg['files'] as $file) {
                                                                    // Jika file detail kosong, hitung 1 baris untuk tanda "-"
                                                                    $count = empty($file['file_detail']) ? 1 : count($file['file_detail']);
                                                                    $fg_rows += $count;
                                                                }
                                                            } else {
                                                                $fg_rows = 1;
                                                            }

                                                            // PERBAIKAN DI SINI:
                                                            // Langsung simpan ke object $d yang sedang aktif di loop
                                                            // Tidak perlu mencari index array induknya lagi
                                                            $d->files_grouped[$jenis]['row_count'] = $fg_rows;

                                                            $d->totalDetailRows += $fg_rows;
                                                        }
                                                    } else {
                                                        $d->totalDetailRows = 1; // Detail ada, tapi file kosong -> 1 baris (-)
                                                    }
                                                    $s->totalSubRows += $d->totalDetailRows;
                                                }
                                            } else {
                                                $s->totalSubRows = 1; // Sub ada, detail kosong -> 1 baris (-)
                                            }
                                            $totalKegiatanRows += $s->totalSubRows;
                                        }
                                    } else {
                                        $totalKegiatanRows = 1; // Kegiatan ada, sub kosong -> 1 baris (-)
                                    }
                                    ?>

                                    <?php if (empty($k->subkegiatan)): ?>
                                        <tr>
                                            <td rowspan="<?= $totalKegiatanRows ?>"><?= $k->kegiatan ?></td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <?php continue; ?>
                                    <?php endif; ?>

                                    <?php $printKegiatan = true; ?>

                                    <?php foreach ($k->subkegiatan as $s): ?>

                                        <?php if (empty($s->detail)): ?>
                                            <tr>
                                                <?php if ($printKegiatan): ?><td rowspan="<?= $totalKegiatanRows ?>"><?= $k->kegiatan ?></td><?php $printKegiatan = false;
                                                                                                                                            endif; ?>
                                                <td rowspan="<?= $s->totalSubRows ?>"><?= $s->namasubkegiatan ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <?php continue; ?>
                                        <?php endif; ?>

                                        <?php $printSub = true; ?>

                                        <?php foreach ($s->detail as $d): ?>

                                            <?php if (empty($d->files_grouped)): ?>
                                                <tr>
                                                    <?php if ($printKegiatan): ?><td rowspan="<?= $totalKegiatanRows ?>"><?= $k->kegiatan ?></td><?php $printKegiatan = false;
                                                                                                                                                endif; ?>
                                                    <?php if ($printSub): ?><td rowspan="<?= $s->totalSubRows ?>"><?= $s->namasubkegiatan ?></td><?php $printSub = false;
                                                                                                                                                endif; ?>
                                                    <td rowspan="<?= $d->totalDetailRows ?>"><?= $d->namasubkegiatan_detail ?></td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                                <?php continue; ?>
                                            <?php endif; ?>

                                            <?php $printDetail = true; ?>

                                            <?php foreach ($d->files_grouped as $jenis => $fg): ?>

                                                <?php
                                                // Ambil row count yang sudah kita simpan tadi
                                                $totalJenisRows = isset($fg['row_count']) ? $fg['row_count'] : 1;
                                                $printJenis = true;
                                                ?>

                                                <?php if (empty($fg['files'])): ?>
                                                    <tr>
                                                        <?php if ($printKegiatan): $printKegiatan = false; ?><td rowspan="<?= $totalKegiatanRows ?>"><?= $k->kegiatan ?></td><?php endif; ?>
                                                        <?php if ($printSub): $printSub = false; ?><td rowspan="<?= $s->totalSubRows ?>"><?= $s->namasubkegiatan ?></td><?php endif; ?>
                                                        <?php if ($printDetail): $printDetail = false; ?><td rowspan="<?= $d->totalDetailRows ?>"><?= $d->namasubkegiatan_detail ?></td><?php endif; ?>
                                                        <td rowspan="<?= $totalJenisRows ?>"><?= $jenis ?></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <?php continue; ?>
                                                <?php endif; ?>

                                                <?php foreach ($fg['files'] as $file): ?>

                                                    <?php if (empty($file['file_detail'])): ?>
                                                        <tr>
                                                            <?php if ($printKegiatan): $printKegiatan = false; ?><td rowspan="<?= $totalKegiatanRows ?>"><?= $k->kegiatan ?></td><?php endif; ?>
                                                            <?php if ($printSub): $printSub = false; ?><td rowspan="<?= $s->totalSubRows ?>"><?= $s->namasubkegiatan ?></td><?php endif; ?>
                                                            <?php if ($printDetail): $printDetail = false; ?><td rowspan="<?= $d->totalDetailRows ?>"><?= $d->namasubkegiatan_detail ?></td><?php endif; ?>
                                                            <?php if ($printJenis): $printJenis = false; ?><td rowspan="<?= $totalJenisRows ?>"><?= $jenis ?></td><?php endif; ?>
                                                            <td>-</td>
                                                        </tr>
                                                        <?php continue; ?>
                                                    <?php endif; ?>

                                                    <?php foreach ($file['file_detail'] as $fd): ?>
                                                        <tr>
                                                            <?php if ($printKegiatan): ?>
                                                                <td rowspan="<?= $totalKegiatanRows ?>" style="vertical-align:top"><?= $k->kegiatan ?></td>
                                                                <?php $printKegiatan = false; ?>
                                                            <?php endif; ?>

                                                            <?php if ($printSub): ?>
                                                                <td rowspan="<?= $s->totalSubRows ?>" style="vertical-align:top"><?= $s->namasubkegiatan ?></td>
                                                                <?php $printSub = false; ?>
                                                            <?php endif; ?>

                                                            <?php if ($printDetail): ?>
                                                                <td rowspan="<?= $d->totalDetailRows ?>" style="vertical-align:top"><?= $d->namasubkegiatan_detail ?></td>
                                                                <?php $printDetail = false; ?>
                                                            <?php endif; ?>

                                                            <?php if ($printJenis): ?>
                                                                <td rowspan="<?= $totalJenisRows ?>" style="vertical-align:top"><?= $jenis ?></td>
                                                                <?php $printJenis = false; ?>
                                                            <?php endif; ?>

                                                            <td>
                                                                <a class="btn btn-success btn-sm" target="_blank"
                                                                    href="<?= base_url('explorer/open_file/' . $fd->id_file_detail) ?>">
                                                                    <i class="fa fa-download"></i> <?= $fd->filename ?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>