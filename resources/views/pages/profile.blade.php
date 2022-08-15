<div class="card is-bottom-gap">
    <div class="card-content">
        @include('partials/breadcrumb-navigation', ['breadcrumb' => $breadcrumb])
    </div>
</div>
<form id="form-manage-item" method="POST" action="{{ route('profile.store') }}">
    <div class="container is-max-desktop">
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <nav class="level">
                        <div class="level-left">
                            <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
                        </div>
                    </nav>
                </div>
                <div class="content">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Nama<small class="has-text-danger">*</small></label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input" type="text" name="fullname" required="" value="{{auth_data()->fullname}}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Tahun Masuk<small class="has-text-danger">*</small></label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input" type="text" name="year_entries" value="{{auth_data()->year_entries}}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Jenis Kelamin<small class="has-text-danger">*</small></label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="select">
                                    <select name="gender" required="">
                                        <option disabled>Pilih</option>
                                        <option {{(auth_data()->gender == 1)? 'selected' : ''}} value="1">Laki-Laki</option>
                                        <option {{(auth_data()->gender == 2)? 'selected' : ''}} value="2">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">WNI/WNA<small class="has-text-danger">*</small></label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="select">
                                    <select name="nationality" required="">
                                        <option disabled>Pilih</option>
                                        <option {{(auth_data()->nationality == 'WNI')? 'selected' : ''}} value="WNI">WNI</option>
                                        <option {{(auth_data()->nationality == 'WNA')? 'selected' : ''}} value="WNA">WNA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">KTP</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input" type="text" name="citizen_id_card" value="{{auth_data()->citizen_id_card}}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Tempat Lahir</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input" type="text" name="birthplace" value="{{auth_data()->birthplace}}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Tanggal Lahir</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input is-datepicker" type="date" name="birthplace" value="{{auth_data()->birthplace}}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Alamat</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <textarea class="textarea" name="address" placeholder="Alamat jalan, kecamatan, kabupaten kota, provinsi">{{auth_data()->address}}</textarea>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Telepon</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input" type="text" name="phone" value="{{auth_data()->phone}}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <p class="control">
                                    <input class="input" type="text" name="email" value="{{auth_data()->email}}">
                                </p>
                            </div>
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