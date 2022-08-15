<form id="form-manage-item" 
    method="POST"
    action="{{ url('user/password/' .$item->user_id) }}">

    <div class="box">
        <nav class="level">
            <div class="level-left">
                <p class="title"><strong>Reset Password</strong></p>
            </div>
        </nav>

        <input class="input" type="hidden" name="id" required="" value="{{!empty($item)? $item->user_id : ''}}">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nama<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" disabled value="{{!empty($item)? $item->fullname : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Status<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="select">
                        <select disabled>
                            <option disabled>Pilih</option>
                            <option {{(!empty($item) && $item->user_status == 10)? 'selected' : ''}} value="10">PPI cabang</option>
                            <option {{(!empty($item) && $item->user_status == 11)? 'selected' : ''}} value="11">Internal PPI Taiwan</option>
                            <option {{(!empty($item) && $item->user_status == 12)? 'selected' : ''}} value="12">BANOM PPI Taiwan</option>
                            <option {{(!empty($item) && $item->user_status == 100)? 'selected' : ''}} value="100">Pusat</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Email/Username</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" disabled value="{{!empty($item)? $item->email : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-small">
                <label class="label">New Password</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control has-icons-left is-expanded">
                        <input id="new_password" class="input" type="password" name="new_password" minlength="4" required="">
                        <span class="icon is-small is-left">
                            <i class="fa fa-key"></i>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-small">
                <label class="label">Confirm new Password</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control has-icons-left is-expanded">
                        <input class="input" type="password" name="new_confirm_password" minlength="4" required="" equalto="#new_password">
                        <span class="icon is-small is-left">
                            <i class="fa fa-key"></i>
                        </span>
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
                // enctype: 'multipart/form-data',
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