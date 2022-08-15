<form id="form-manage-item" 
    method="POST"
    action="{{ route('regist-approval.update', $item->regist_submission_id) }}">

    <input type="hidden" name="_method" value="{{ 'PUT' }}">

    <div class="box">
        <nav class="level">
            <div class="level-left">
                <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
            </div>
        </nav>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Fullname<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" disabled="" name="fullname" required="" value="{{!empty($item)? $item->fullname : ''}}">
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
                        <input class="input" type="text" disabled="" name="institution" required="" value="{{!empty($item)? $item->institution : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Phone/Wa<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" disabled="" name="phone" required="" value="{{!empty($item)? $item->phone : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">LINE ID<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" disabled="" name="line_id" required="" value="{{!empty($item)? $item->line_id : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Gender<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select disabled="" name="gender">
                            <option {{(!empty($item) && $item->gender == 1)? 'selected' : '' }} value="1">Male</option>
                            <option {{(!empty($item) && $item->gender == 2)? 'selected' : '' }} value="2">Female</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Register As<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select disabled="" name="regist_submission_type">
                            <option {{(!empty($item) && $item->regist_submission_type == 1)? 'selected' : '' }} value="1">Viewer</option>
                            <option {{(!empty($item) && $item->regist_submission_type == 2)? 'selected' : '' }} value="2">Presenter</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <!-- <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Attendance<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="attendance_option" disabled="" {{(!empty($item) && $item->attendance_option == 1)? 'checked' : '' }} value="1">
                            <b>Offline</b>
                        </label>
                        <label class="radio">
                            <input type="radio" name="attendance_option" disabled="" {{(!empty($item) && $item->attendance_option == 2)? 'checked' : '' }} value="2">
                            <b>Online</b>
                        </label>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Foto Proof of Payment</label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->payment_url))
                    <a href="{{$item->payment_url}}?v={{time()}}" target="_blank">Download Proof of Payment</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="field is-horizontal is-info">
            <div class="field-label is-normal">
                <label class="label">Status</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="select">
                        <select name="regist_submission_status" onchange="changeCardStatus()">
                        <option {{(!empty($item) && $item->regist_submission_status == 10)? 'selected' : '' }} value="10">On-Process</option>
                            <option {{(!empty($item) && $item->regist_submission_status == 2)? 'selected' : '' }} value="2">Accepted 100%</option>
                            <option {{(!empty($item) && $item->regist_submission_status == 1)? 'selected' : '' }} value="1">Need Revision</option>
                            <option {{(!empty($item) && $item->regist_submission_status == 400)? 'selected' : '' }} value="400">Cancel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="place_card" class="field is-horizontal is-hidden">
            <div class="field-label is-normal">
                <label class="label">LOA<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    <input class="input" type="file" name="regist_submission_file">
                </div>
            </div>
        </div>
        <div id="place_notes" class="field is-horizontal is-hidden">
            <div class="field-label is-normal">
                <label class="label">Catatan Revisi</label>
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
                <span>Simpan</span>
            </button>
            <!-- <a class="target-link" href="dashboard#profile">
                <button class="button is-text">Kembali</button>
            </a> -->
        </div>
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
        if($('select[name=regist_submission_status]').val() == 1){
            $('#place_notes').removeClass('is-hidden');
            $('#place_card').addClass('is-hidden');
        }else if($('select[name=regist_submission_status]').val() == 2){
            $('#place_notes').addClass('is-hidden');
            $('#place_card').removeClass('is-hidden');
        }else if($('select[name=regist_submission_status]').val() == 10){
            $('#place_notes').addClass('is-hidden');
            $('#place_card').addClass('is-hidden');
        }
    }
</script>