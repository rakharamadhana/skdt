<form id="form-manage-item" 
    method="POST"
    action="{{ !empty($item)? route('regist-submission.update', $item->regist_submission_id) : route('regist-submission.store') }}">

    <input type="hidden" name="_method" value="{{ !empty($item)? 'PUT' : 'POST' }}">

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
                        <input class="input" type="text" name="fullname" required="" value="{{!empty($item)? $item->fullname : ''}}">
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
                        <input class="input" type="text" name="institution" required="" value="{{!empty($item)? $item->institution : ''}}">
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
                        <input class="input" type="text" name="phone" required="" value="{{!empty($item)? $item->phone : ''}}">
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
                        <input class="input" type="text" name="line_id" required="" value="{{!empty($item)? $item->line_id : ''}}">
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
                        <select name="gender">
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
                        <select name="regist_submission_type">
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
                            <input type="radio" name="attendance_option" {{(!empty($item) && $item->attendance_option == 1)? 'checked' : '' }} value="1">
                            <b>Offline</b>
                        </label>
                        <label class="radio">
                            <input type="radio" name="attendance_option" {{(!empty($item) && $item->attendance_option == 2)? 'checked' : '' }} value="2">
                            <b>Online</b>
                        </label>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Proof of Payment</label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->payment_url))
                    <a href="{{$item->payment_url}}?v={{time()}}" target="_blank">Download Proof of Payment</a>
                    <input class="input" type="file" name="payment_url_file">
                    @else
                    <input class="input" type="file" name="payment_url_file">
                    @endif
                </div>
            </div>
        </div>
        @if(empty($item))
        <div class="field box">
            <p class="control">
                <label class="checkbox">
                    <input name="approve_checkbox" type="checkbox" value="1" required="">
                    The data that is filled in is guaranteed to be confidential and is only used for the purposes of PPI Taiwan, I agree to the data that I fill in to be used properly
                </label>
            </p>
        </div>
        @endif
        <input class="input" type="hidden" name="input_status">
        <div class="buttons is-centered">
            <button class="button is-info" onclick="changeInputStatus(100)">
                <span class="icon">
                    <i class="fa fa-save"></i>
                </span>
                <span>Save and continue later</span>
            </button>
            <button id="btn_submit" class="button is-success" onclick="changeInputStatus(0)">
                <span>Submit Application</span>
            </button>
            <!-- <a class="target-link" href="dashboard#profile">
                <button class="button is-text">Kembali</button>
            </a> -->
        </div>
    </div>
</form>

<script>
    initCalendar();

    function changeInputStatus(num){
        $('input[name=input_status]').val(num);

        if(num == 100){
            $('input').removeAttr('required');
            $('select').removeAttr('required');
        }else if(num == 0){
            $('input[type=text]').attr('required', 'required');
            $('input[type=date]').attr('required', 'required');
            $('select').attr('required', 'required');
        }
    }

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
                        loadContent('regist-submission');
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
</script>