<form id="form-manage-item" 
    method="POST"
    action="{{ route('submission-approval.update', $item->submission_id) }}">

    <input type="hidden" name="_method" value="{{ 'PUT' }}">

    <div class="box">
        <nav class="level">
            <div class="level-left">
                @if($item->submission_status == 2)
                <p class="title"><strong>Detil</strong></p>
                @else
                <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
                @endif
            </div>
        </nav>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Fullname<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="fullname" @if($item->submission_status == 2) disabled="" @endif required="" value="{{!empty($item)? $item->fullname : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Institution<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="institution" required="" @if($item->submission_status == 2) disabled="" @endif value="{{!empty($item)? $item->institution : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Phone/WA<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="phone" required="" @if($item->submission_status == 2) disabled="" @endif value="{{!empty($item)? $item->phone : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Title<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="title" required="" @if($item->submission_status == 2) disabled="" @endif value="{{!empty($item)? $item->title : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Abstract<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <textarea class="textarea" name="abstract" placeholder="Abstract" @if($item->submission_status == 2) disabled="" @endif rows="10">{{!empty($item)? $item->abstract : ''}}</textarea>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Paper</label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->paper_url))
                    <a href="{{$item->paper_url}}" target="_blank">Download Paper</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Student ID</label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->student_id))
                    <a href="{{$item->student_id}}" target="_blank">Download Student ID</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Full Paper (Format .doc, .docx, etc for Microsoft Word)<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->full_paper_url))
                    <a href="{{$item->full_paper_url}}" target="_blank">Download Full Paper</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Publication Option<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="submission_purpose" @if($item->submission_status == 2) disabled="" @endif {{(!empty($item) && $item->submission_purpose == 1)? 'checked' : '' }} value="1">
                            <b>Eksternal</b>: Published by publishers who have collaborated with the committee (only given a choice, given a link)
                        </label>
                        <label class="radio">
                            <input type="radio" name="submission_purpose" @if($item->submission_status == 2) disabled="" @endif {{(!empty($item) && $item->submission_purpose == 2)? 'checked' : '' }} value="2">
                            <b>Internal</b>: http://ejournal.ppi.id/index.php/taiwanproceeding/issue/view/11
                        </label>
                        <label class="radio">
                            <input type="radio" name="submission_purpose" @if($item->submission_status == 2) disabled="" @endif {{(!empty($item) && $item->submission_purpose == 3)? 'checked' : '' }} value="3">
                            Unpublished
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @if($item->submission_status != 2)
        <div class="field is-horizontal is-info">
            <div class="field-label is-normal">
                <label class="label">Status</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="select">
                        <select name="submission_status" onchange="changeCardStatus()">
                            <option {{(!empty($item) && $item->submission_status == 10)? 'selected' : '' }} value="10">On-Process</option>
                            <option {{(!empty($item) && $item->submission_status == 2)? 'selected' : '' }} value="2">Accepted 100%</option>
                            <option {{(!empty($item) && $item->submission_status == 1)? 'selected' : '' }} value="1">Need Revision</option>
                            <option {{(!empty($item) && $item->submission_status == 400)? 'selected' : '' }} value="400">Cancel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="place_card" class="field is-horizontal is-hidden">
            <div class="field-label is-normal">
                <label class="label">Paper proof Accepted</label>
            </div>
            <div class="field-body">
                <div class="box">
                    <input class="input" type="file" name="submission_file">
                </div>
            </div>
        </div>
        <div id="place_notes" class="field is-horizontal is-hidden">
            <div class="field-label is-normal">
                <label class="label">Revision Notes</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                    <textarea class="textarea" name="notes"></textarea>
                    </p>
                </div>
            </div>
        </div>
        <div class="buttons is-centered">
            <button class="button is-info">
                <span class="icon">
                    <i class="fa fa-save"></i>
                </span>
                <span>Save</span>
            </button>
            <!-- <a class="target-link" href="dashboard#profile">
                <button class="button is-text">Kembali</button>
            </a> -->
        </div>
        @endif
    </div>
</form>

<script>
    initCalendar();
    changeCardStatus();

    $('#form-manage-item').validate({
        highlight: function(input) {
            $(input).addClass('is-danger');
        },
        unhighlight: function(input) {
            $(input).removeClass('is-danger');
        },
        errorPlacement: function(error, element) {
            $(element).parents('.control').addClass('help').addClass('is-danger').append(error);
        },
        submitHandler: function(form) {
            $('button').addClass('is-loading');
            $('control').addClass('is-loading');
            $('input').attr('readonly', 'readonly');

            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                type: form.method,
                enctype: 'multipart/form-data',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status_code == 200) {
                        iziToast.success({
                            title: 'Succesfully',
                            message: response.message,
                            position: 'topRight'
                        });
                        closeModalHelper();
                        primary_table.ajax.reload(null, false);
                    } else {
                        iziToast.warning({
                            title: 'Oops',
                            message: response.message,
                            position: 'topRight'
                        });
                    }
                },
                complete: function() {
                    $('button').removeClass('is-loading');
                    $('control').removeClass('is-loading');
                    $('input').removeAttr('readonly', 'readonly');
                }
            });
        }
    });

    function changeCardStatus(){
        if($('select[name=submission_status]').val() == 1){
            $('#place_notes').removeClass('is-hidden');
            $('#place_card').addClass('is-hidden');
        }else if($('select[name=submission_status]').val() == 2){
            $('#place_notes').addClass('is-hidden');
            $('#place_card').removeClass('is-hidden');
        }else if($('select[name=submission_status]').val() == 10){
            $('#place_notes').addClass('is-hidden');
            $('#place_card').addClass('is-hidden');
        }
    }
</script>