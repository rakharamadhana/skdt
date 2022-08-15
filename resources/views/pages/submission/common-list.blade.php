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
                        <button class="button is-small is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('submission/create', 'modal-manage-item-content')">
                            <span class="icon">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span>Submission Paper</span>
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
                                Waiting for response
                            </label>
                        </span>
                        <span class="tag is-medium is-success">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="10" checked>
                                On-Process
                            </label>
                        </span>
                        <span class="tag is-medium is-warning">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="1" checked>
                                Need revision
                            </label>
                        </span>
                        <span class="tag is-medium is-primary">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="2" checked>
                                Accepted
                            </label>
                        </span>
                        <span class="tag is-medium is-danger">
                            <label class="checkbox">
                                <input class="is-filter" name="filter_status" type="checkbox" value="400" checked>
                                Cancel
                            </label>
                        </span>
                    </div>
                </div>
            </div>
            <table class="table is-narrow is-bordered is-striped is-fullwidth" id="primary_table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Submit Date</th>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Institution</th>
                        <th>Title</th>
                        <th>Paper</th>
                        <th>Student ID</th>
                        <th>Status</th>
                        <th>Full Paper</th>
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
            url: base_url + 'submission/dt',
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
                data: 'submission_number',
            },
            {
                data: 'fullname'
            },
            {
                data: 'institution'
            },
            {
                data: 'title'
            },
            {
                data: 'paper_url',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download Paper` +
                            `</a>`;
                    }
                    
                    return html;
                }
            },
            {
                data: 'student_id',
                searchable: false,
                orderable: false,
                render: function(data) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                            `    Download Student ID` +
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
                data: 'full_paper_url',
                searchable: false,
                orderable: false,
                render: function(data, type, row) {
                    let html = ``;

                    if(data){
                        html += `<a href="` + data +`" target="_blank">` +
                        `    Download Full Paper` +
                        `</a>`;
                    }else{
                        if(row.action.status == 2){
                            html += `<button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('submission/add-extra/` + row.action.id + `', 'modal-manage-item-content')">` +
                                `    <span>Submit full paper</span>` +
                                `</button>`;
                        }
                    }
                    
                    return html;
                }
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
                            `<br><button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('submission/` + data.id + `/edit', 'modal-manage-item-content')">` +
                            `    <span>Revisi</span>` +
                            `</button>`;
                    }
                    if(data.status == 2){
                        html += `<a class="tag is-medium is-success" href="` + data.submission_url +`" target="_blank">` +
                        `    Download Keputusan` +
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
                    url: base_url + 'submission/' + item.attr('data-id'),
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