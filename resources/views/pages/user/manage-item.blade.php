<form id="form-manage-item" 
    method="POST"
    action="{{ !empty($item)? route('user.update', ['user' => $item->user_id]) : route('user.store') }}">

    <input type="hidden" name="_method" value="{{ !empty($item)? 'PUT' : 'POST' }}">

    <div class="box">
        <nav class="level">
            <div class="level-left">
                <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
            </div>
        </nav>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nama<small class="has-text-danger">*</small></label>
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
                <label class="label">Status<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="select">
                        <select name="user_status" required="">
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
                        <input class="input" type="text" name="email" value="{{!empty($item)? $item->email : ''}}">
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