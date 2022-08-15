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
                    <div class="level-item">
                        <button class="button is-small is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('cert-request/create', 'modal-manage-item-content')">
                            <span class="icon">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span>Ajukan Sertifikat Baru</span>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
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
                                <input class="is-filter" name="filter_status" type="checkbox" value="2" checked>
                                Disetujui
                            </label>
                        </span>
                    </div>
                </div>
            </div>
            <table class="table is-narrow is-bordered is-striped is-fullwidth" id="primary_table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Submission Date</th>
                        <th>ID</th>
                        <th>Nama Kegiatan & Tema</th>
                        <th>Tujuan Sertifikat</th>
                        <th>Dept</th>
                        <th>PIC</th>
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

<script>
    var primary_table = $('#primary_table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bfr<"datatable-content"t>ip',
        buttons: dtButtonConfig,
        lengthMenu: dtLengButton,
        pageLength: 25,
        ajax: {
            url: base_url + 'cert-request/dt',
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
                data: 'cert_number',
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
                data: 'cert_date',
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

                    if(data.status == 1){
                        html += `Perlu Revisi: <br>`
                            + data.notes +
                            `<br><button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('cert-request/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `    <span>Revisi</span>` +
                            `</button>`;
                    }
                    if(data.status == 2){
                        html += `<a class="tag is-medium is-success" href="` + data.cert_url +`" target="_blank">` +
                        `    Download Sertifikat` +
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
                    url: base_url + 'cert-request/' + item.attr('data-id'),
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
    });
</script>