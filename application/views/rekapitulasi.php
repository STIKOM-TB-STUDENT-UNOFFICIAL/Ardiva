<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Rekapitulasi</h3>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h6>Kegiatan</h6>
                                <div id="colKegiatan"></div>
                            </div>

                            <div class="col-md-2">
                                <h6>Sub Kegiatan</h6>
                                <div id="colSubKegiatan"></div>
                            </div>

                            <div class="col-md-3">
                                <h6>Sub Kegiatan Detail</h6>
                                <div id="colSubKegiatanDetail"></div>
                            </div>

                            <div class="col-md-3">
                                <h6>Berkas</h6>
                                <div id="colFile"></div>
                            </div>

                            <div class="col-md-2">
                                <h6>File</h6>
                                <div id="colFileDetail"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const kegiatanList = <?= json_encode($kegiatan); ?>;

            const colKegiatan = document.getElementById("colKegiatan");
            const colSubKegiatan = document.getElementById("colSubKegiatan");
            const colSubKegiatanDetail = document.getElementById("colSubKegiatanDetail");
            const colFile = document.getElementById("colFile");
            const colFileDetail = document.getElementById("colFileDetail");

            kegiatanList.forEach(k => {
                const btn = document.createElement("button");
                btn.className = "btn btn-primary my-1 w-100";
                btn.textContent = k.kegiatan;
                btn.dataset.id = k.idkegiatan;
                btn.onclick = () => loadSubKegiatan(k.idkegiatan);
                colKegiatan.appendChild(btn);
            });

            function loadSubKegiatan(id) {
                clearColumn(colSubKegiatan);
                clearColumn(colSubKegiatanDetail);
                clearColumn(colFile);
                clearColumn(colFileDetail);

                fetch("<?= base_url('explorer/subkegiatan/'); ?>" + id)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(row => {
                            const btn = document.createElement("button");
                            btn.className = "btn btn-info my-1 w-100";
                            btn.textContent = row.namasubkegiatan;
                            btn.dataset.id = row.idsubkegiatan;
                            btn.onclick = () => loadSubDetail(row.idsubkegiatan);
                            colSubKegiatan.appendChild(btn);
                        });
                    });
            }

            function loadSubDetail(id) {
                clearColumn(colSubKegiatanDetail);
                clearColumn(colFile);
                clearColumn(colFileDetail);

                fetch("<?= base_url('explorer/subkegiatandetail/'); ?>" + id)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(row => {
                            const btn = document.createElement("button");
                            btn.className = "btn btn-info my-1 w-100";
                            btn.textContent = row.namasubkegiatan_detail;
                            btn.dataset.id = row.idsubkegiatan_detail;
                            btn.onclick = () => loadFile(row.idsubkegiatan_detail);
                            colSubKegiatanDetail.appendChild(btn);
                        });
                    });
            }

            function loadFile(id) {
                clearColumn(colFile);
                clearColumn(colFileDetail);

                fetch("<?= base_url('explorer/file/'); ?>" + id)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(row => {
                            const btn = document.createElement("button");
                            btn.className = "btn btn-info my-1 w-100";
                            btn.textContent = row.jenis + " - " + row.topik;
                            btn.dataset.id = row.idfile;
                            btn.onclick = () => loadFileDetail(row.idfile);
                            colFile.appendChild(btn);
                        });
                    });
            }

            function loadFileDetail(id) {
                clearColumn(colFileDetail);

                fetch("<?= base_url('explorer/file_detail/'); ?>" + id)
                    .then(res => res.json())
                    .then(data => {
                        console.log(data)
                        data.forEach(row => {
                            const btn = document.createElement("button");
                            btn.className = "btn btn-success my-1 w-100";
                            btn.textContent = row.filename;
                            btn.dataset.id = row.id_file_detail;
                            btn.onclick = () => openFile(row.id_file_detail);
                            colFileDetail.appendChild(btn);
                        });
                    });
            }

            function openFile(id) {
                window.open("<?= base_url('explorer/open_file/'); ?>" + id, "_blank");
            }

            function clearColumn(col) {
                col.innerHTML = "";
            }

        });
    </script>
</div>