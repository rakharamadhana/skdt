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
                    @if(empty($list_data->count()))
                    <div class="level-item">
                        <button class="button is-small is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('regist-submission/create', 'modal-manage-item-content')">
                            <span class="icon">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span>Register</span>
                        </button>
                    </div>
                    @endif
                </div>
            </nav>
        </div>
        <div class="container">
            <table class="table is-narrow is-bordered is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>Submission Date</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Institution</th>
                        <th>Phone/Wa</th>
                        <th>As</th>
                        <!-- <th>Attendance Option</th> -->
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list_data as $data)
                    <tr>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->regist_submission_number}}</td>
                        <td>{{$data->fullname}}</td>
                        <td>{{$data->institution}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->typeToText()}}</td>
                        <td>{{$data->statusToText()}}</td>
                        <!-- <td>{{$data->attendanceToText()}}</td> -->
                        @if($data->regist_submission_status == 100)
                        <td>
                            <button class="button is-info is-small button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('regist-submission/{{$data->regist_submission_id}}/edit', 'modal-manage-item-content')">
                                <span>Continue Fill Form</span>
                            </button>
                        </td>
                        @elseif($data->regist_submission_status == 1)
                        <td>
                            Perlu Revisi: <br>
                            {{$data->notes}}
                            <br>
                            <button class="button is-small is-table is-info button-modal modal-button" data-target="#modal-manage-item" type="button" onclick="loadContent('regist-submission/{{$data->regist_submission_id}}/edit', 'modal-manage-item-content')">
                                <span>Revision</span>
                            </button>
                        </td>
                        @elseif($data->regist_submission_status == 2)
                        <td>
                            <a class="tag is-medium is-success" href="{{url($data->regist_submission_url)}}" target="_blank">
                                Download Proof of Payment
                            </a>
                        </td>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">Haven't submitted an application yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

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
                    url: base_url + 'regist-submission/' + item.attr('data-id'),
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
</script>