<form id="form-manage-item" 
    method="POST"
    @if($extra)
    action="{{ url('submission/add-extra/'. $item->submission_id) }}"
    @else
    action="{{ !empty($item)? route('submission.update', $item->submission_id) : route('submission.store') }}"
    @endif
    
    >

    @if(!$extra)
    <input type="hidden" name="_method" value="{{ !empty($item)? 'PUT' : 'POST' }}">
    @endif
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
                        <input class="input" type="text" @if($extra) disabled="" @endif name="fullname" required="" value="{{!empty($item)? $item->fullname : ''}}">
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
                        <input class="input" type="text" @if($extra) disabled="" @endif name="institution" required="" value="{{!empty($item)? $item->institution : ''}}">
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
                        <input class="input" type="text" @if($extra) disabled="" @endif name="phone" required="" value="{{!empty($item)? $item->phone : ''}}">
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
                        <input class="input" type="text" @if($extra) disabled="" @endif name="title" required="" value="{{!empty($item)? $item->title : ''}}">
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
                        <textarea class="textarea" @if($extra) disabled="" @endif name="abstract" placeholder="Abstract" rows="10" oninput="inputTextArea()">{{!empty($item)? $item->abstract : ''}}</textarea>
                        <small class="has-text-danger" id="word_count">Words Count 1/2500</small>
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
                    <input class="input" type="file" @if($extra) disabled="" @endif name="paper_file">
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
                    <a href="{{$item->student_id}}" target="_blank">Download Paper</a>
                    @endif
                    <input class="input" type="file" name="student_id">
                </div>
            </div>
        </div>
        @if($extra)
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Full Paper (Format .doc, .docx, etc for Microsoft Word)<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->full_paper_url))
                    <a href="{{$item->full_paper_url}}" target="_blank">Download Full Paper</a>
                    @endif
                    <input class="input" type="file" name="full_paper_file">
                </div>
            </div>
        </div>
        @endif
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Publication Option<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <label class="radio">
                            <input type="radio" @if($extra) disabled="" @endif name="submission_purpose" {{(!empty($item) && $item->submission_purpose == 1)? 'checked' : '' }} value="1">
                            <b>Eksternal</b>: Published by publishers who have collaborated with the committee (only given a choice, given a link)
                        </label>
                        <label class="radio">
                            <input type="radio" @if($extra) disabled="" @endif name="submission_purpose" {{(!empty($item) && $item->submission_purpose == 2)? 'checked' : '' }} value="2">
                            <b>Internal</b>: http://ejournal.ppi.id/index.php/taiwanproceeding/issue/view/11
                        </label>
                        <label class="radio">
                            <input type="radio" @if($extra) disabled="" @endif name="submission_purpose" {{(!empty($item) && $item->submission_purpose == 3)? 'checked' : '' }} value="3">
                            Unpublished
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <input class="input" type="hidden" name="input_status">
        <div class="buttons is-centered">
            @if(!$extra)
            <button class="button is-info" onclick="changeInputStatus(100)">
                <span class="icon">
                    <i class="fa fa-save"></i>
                </span>
                <span>Save and Continue Later</span>
            </button>
            @endif
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
    inputTextArea();

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

    function inputTextArea(){
        var str = $('textarea[name=abstract]').val();

        str = str.replace(/(^\s*)|(\s*$)/gi,"");
        str = str.replace(/[ ]{2,}/gi," ");
        str = str.replace(/\n /,"\n");
        var str_count = str.split(' ').length;

        $('#word_count').html(`Words Count ${str_count}/2500`);
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
</script>