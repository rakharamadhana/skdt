<div class="card is-bottom-gap">
    <div class="card-content">
        @include('partials/breadcrumb-navigation', ['breadcrumb' => $breadcrumb])
    </div>
</div>
<div id="modal-manage-item" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content" id="modal-manage-item-content">
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
</div>
<div class="card">
    <div class="card-content">
        <div class="container is-bottom-gap">
            <nav class="level">
                <div class="level-left">
                    <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
                </div>
                <div class="level-right">
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="tabs">
                <ul>
                    <li class="is-active" data-target="#cabang"><a>Cabang</a></li>
                    <li data-target="#internal"><a>Internal</a></li>
                    <li data-target="#banom"><a>BANOM</a></li>
                </ul>
            </div>
            <div class="field is-horizontal">
                <div class="label">
                    Status &nbsp;
                </div>
                <div class="control">
                    <div class="tags">
                        <span class="tag is-medium">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="0" checked>
                                Menunggu Respon
                            </label>
                        </span>
                        <span class="tag is-medium is-success">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="10" checked>
                                Sedang dalam process
                            </label>
                        </span>
                        <span class="tag is-medium is-warning">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="1" checked>
                                Membutuhkan Revisi
                            </label>
                        </span>
                        <span class="tag is-medium is-primary">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="2">
                                Disetujui
                            </label>
                        </span>
                    </div>
                </div>
            </div>
            <div class="content tabs-content" id="cabang">
                <table class="table is-narrow is-bordered is-striped is-fullwidth" id="primary_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Submission Date</th>
                            <th>Submission By</th>
                            <th>ID</th>
                            <th>Jenis</th>
                            <th>Perihal</th>
                            <th>Tujuan Surat</th>
                            <th>PPI Kampus/Kota</th>
                            <th>Nama PIC</th>
                            <th>LINE ID</th>
                            <th>Email</th>
                            <th>Tanggal Deadline</th>
                            <th>Attachment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="content tabs-content is-hidden" id="internal">
                <table class="table is-narrow is-bordered is-striped is-fullwidth" id="secondary_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Submission Date</th>
                            <th>Submission By</th>
                            <th>ID</th>
                            <th>Jenis</th>
                            <th>Nama Kegiatan & Tema</th>
                            <th>Tujuan Surat</th>
                            <th>Dept</th>
                            <th>Nama PIC</th>
                            <th>LINE ID</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Attachment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="content tabs-content is-hidden" id="banom">
                <table class="table is-narrow is-bordered is-striped is-fullwidth" id="tertiary_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Submission Date</th>
                            <th>Submission By</th>
                            <th>ID</th>
                            <th>Jenis</th>
                            <th>Nama Kegiatan & Tema</th>
                            <th>Tujuan Surat</th>
                            <th>Dept</th>
                            <th>Nama PIC</th>
                            <th>LINE ID</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Attachment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var primary_table = $('#primary_table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfr<"datatable-content"t>ip',
        buttons: dtButtonConfig,
        lengthMenu: dtLengButton,
        pageLength: 25,
        ajax: {
            url: base_url + 'letter-approval/dt?input_by=10',
            type: 'GET',
            data: function(params){
                var statusFilter = [];
                $("input[name=filter_status]:checked").each(function(){
                    statusFilter.push($(this).val());
                });
                params.filter = statusFilter;
            }
        },
        columns: [{
                defaultContent: 0,
                searchable: false,
                orderable: false
            },
            {
                data: 'created_at',
                searchable: false,
            },
            {
                data: 'created_by_user.fullname',
            },
            {
                data: 'letter_number',
            },
            {
                data: 'letter_category.name',
                searchable: false,
                orderable: false
            },
            {
                data: 'title'
            },
            {
                data: 'purpose'
            },
            {
                data: 'dept'
            },
            {
                data: 'pic'
            },
            {
                data: 'pic_contact'
            },
            {
                data: 'pic_email'
            },
            {
                data: 'due_date',
                searchable: false,
                orderable: false
            },
            {
                data: 'support_file',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download Attachment` +
                            `</a>`;
                    }

                    return html;
                }
            },
            {
                data: 'status',
                searchable: false,
                orderable: false
            },
            {
                data: 'action',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data.status == 0 || data.status == 10){
                        html += `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('letter-approval/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `    <span><i class="fa fa-pencil-square-o"></span>` +
                            `</button>`;
                    }
                    if(data.status == 1){
                        html += `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('letter-approval/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `<span><i class="fa fa-pencil-square-o"></i></span>` +
                            `</button>` + `<br> Perlu Revisi: <br>`
                            + data.notes;
                    }
                    if(data.status == 2){
                        html += `<a class="tag is-medium is-success" href="` + data.letter_url +`" target="_blank">` +
                        `    Download Surat` +
                        `</a>`;
                    }
                    // html += `<a class="button is-table is-outlined is-small is-danger" onclick="deleteAction(this)" data-id="` + data.id + `">` +
                    //     `    <span>Delete</span>` +
                    //     `</a>`;

                    return html;
                }
            },

        ],
        order: [
            [1, 'desc']
        ],
    });

    primary_table.on('draw', function() {
        primary_table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            var start = this.page.info().page * this.page.info().length;
            cell.innerHTML = start + i + 1;
            primary_table.cell(cell).invalidate('dom');
        });
    }).draw();

    var secondary_table = $('#secondary_table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfr<"datatable-content"t>ip',
        buttons: dtButtonConfig,
        lengthMenu: dtLengButton,
        pageLength: 25,
        ajax: {
            url: base_url + 'letter-approval/dt?input_by=11',
            type: 'GET',
            data: function(params){
                var statusFilter = [];
                $("input[name=filter_status]:checked").each(function(){
                    statusFilter.push($(this).val());
                });
                params.filter = statusFilter;
            }
        },
        columns: [{
                defaultContent: 0,
                searchable: false,
                orderable: false
            },
            {
                data: 'created_at',
                searchable: false,
            },
            {
                data: 'created_by_user.fullname',
            },
            {
                data: 'letter_number',
            },
            {
                data: 'letter_category.name',
                searchable: false,
                orderable: false
            },
            {
                data: 'title'
            },
            {
                data: 'purpose'
            },
            {
                data: 'dept'
            },
            {
                data: 'pic'
            },
            {
                data: 'pic_contact'
            },
            {
                data: 'letter_date',
                searchable: false,
                orderable: false
            },
            {
                data: 'support_file',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download Attachment` +
                            `</a>`;
                    }

                    return html;
                }
            },
            {
                data: 'status',
                searchable: false,
                orderable: false
            },
            {
                data: 'action',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data.status == 0 || data.status == 10){
                        html += `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('letter-approval/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `    <span><i class="fa fa-pencil-square-o"></span>` +
                            `</button>`;
                    }
                    if(data.status == 1){
                        html += `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('letter-approval/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `<span><i class="fa fa-pencil-square-o"></i></span>` +
                            `</button>` + `<br> Perlu Revisi: <br>`
                            + data.notes;
                    }
                    if(data.status == 2){
                        html += `<a class="tag is-medium is-success" href="` + data.letter_url +`" target="_blank">` +
                        `    Download Surat` +
                        `</a>`;
                    }
                    // html += `<a class="button is-table is-outlined is-small is-danger" onclick="deleteAction(this)" data-id="` + data.id + `">` +
                    //     `    <span>Delete</span>` +
                    //     `</a>`;

                    return html;
                }
            },

        ],
        order: [
            [1, 'desc']
        ],
    });

    secondary_table.on('draw', function() {
        secondary_table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            var start = this.page.info().page * this.page.info().length;
            cell.innerHTML = start + i + 1;
            secondary_table.cell(cell).invalidate('dom');
        });
    }).draw();

    var tertiary_table = $('#tertiary_table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfr<"datatable-content"t>ip',
        buttons: dtButtonConfig,
        lengthMenu: dtLengButton,
        pageLength: 25,
        ajax: {
            url: base_url + 'letter-approval/dt?input_by=12',
            type: 'GET',
            data: function(params){
                var statusFilter = [];
                $("input[name=filter_status]:checked").each(function(){
                    statusFilter.push($(this).val());
                });
                params.filter = statusFilter;
            }
        },
        columns: [{
                defaultContent: 0,
                searchable: false,
                orderable: false
            },
            {
                data: 'created_at',
                searchable: false,
            },
            {
                data: 'created_by_user.fullname',
            },
            {
                data: 'letter_number',
            },
            {
                data: 'letter_category.name',
                searchable: false,
                orderable: false
            },
            {
                data: 'title'
            },
            {
                data: 'purpose'
            },
            {
                data: 'dept'
            },
            {
                data: 'pic'
            },
            {
                data: 'pic_contact'
            },
            {
                data: 'letter_date',
                searchable: false,
                orderable: false
            },
            {
                data: 'support_file',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download Attachment` +
                            `</a>`;
                    }

                    return html;
                }
            },
            {
                data: 'status',
                searchable: false,
                orderable: false
            },
            {
                data: 'action',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data.status == 0 || data.status == 10){
                        html += `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('letter-approval/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `    <span><i class="fa fa-pencil-square-o"></span>` +
                            `</button>`;
                    }
                    if(data.status == 1){
                        html += `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('letter-approval/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `<span><i class="fa fa-pencil-square-o"></i></span>` +
                            `</button>` + `<br> Perlu Revisi: <br>`
                            + data.notes;
                    }
                    if(data.status == 2){
                        html += `<a class="tag is-medium is-success" href="` + data.letter_url +`" target="_blank">` +
                        `    Download Surat` +
                        `</a>`;
                    }
                    // html += `<a class="button is-table is-outlined is-small is-danger" onclick="deleteAction(this)" data-id="` + data.id + `">` +
                    //     `    <span>Delete</span>` +
                    //     `</a>`;

                    return html;
                }
            },

        ],
        order: [
            [1, 'desc']
        ],
    });

    tertiary_table.on('draw', function() {
        tertiary_table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            var start = this.page.info().page * this.page.info().length;
            cell.innerHTML = start + i + 1;
            tertiary_table.cell(cell).invalidate('dom');
        });
    }).draw();

    async function deleteAction(element) {
        var item = $(element);
        if (item.hasClass('is-loading')) {
            return false;
        } else {
            item.addClass('is-loading');
        }

        Swal.fire({
            title: 'Are you sure you want to delete this data?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: base_url + 'letter-approval/' + item.attr('data-id'),
                    async: false,
                    success: function(result) {
                        item.removeClass('is-loading');
                        if (result.status_code == 200) {
                            iziToast.success({
                                title: 'Succesfully',
                                message: result.message,
                                position: 'topRight'
                            });
                            primary_table.ajax.reload(null, false);
                            secondary_table.ajax.reload(null, false);
                            tertiary_table.ajax.reload(null, false);
                        } else {
                            iziToast.warning({
                                title: 'Oops',
                                message: result.message,
                                position: 'topRight'
                            });
                        }
                    }
                });
            }else{
                item.removeClass('is-loading');
            }
        })
    }

    $(document).on('change', 'input[name=filter_status]', function(){
        primary_table.ajax.reload(null, false);
        secondary_table.ajax.reload(null, false);
        tertiary_table.ajax.reload(null, false);
    });
</script>
