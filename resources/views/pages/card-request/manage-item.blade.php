<link type="text/css" rel="stylesheet" href="{{asset('vendor/intl-tel-input-17.0.0/build/css/intlTelInput.css')}}"></link type="text/css" rel="stylesheet" >
<form id="form-manage-item" 
    method="POST"
    action="{{ !empty($item)? route('card-request.update', $item->card_request_id) : route('card-request.store') }}">

    <input type="hidden" name="_method" value="{{ !empty($item)? 'PUT' : 'POST' }}">

    <div class="box">
        <nav class="level">
            <div class="level-left">
                <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
            </div>
        </nav>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nama lengkap sesuai passport<small class="has-text-danger">*</small></label>
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
                <label class="label">Jenis kelamin<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select name="gender">
                            <option {{(!empty($item) && $item->gender == 1)? 'selected' : '' }} value="1">Laki-Laki</option>
                            <option {{(!empty($item) && $item->gender == 2)? 'selected' : '' }} value="2">Perempuan</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nomor passport<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="passport" required="" value="{{!empty($item)? $item->passport : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Passport berlaku sampai dengan<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="date" name="passport_date" required="" value="{{!empty($item)? $item->passport_date : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nomor KTP Indonesia<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="citizen_id_card" required="" value="{{!empty($item)? $item->citizen_id_card : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Tempat lahir<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="birth_place" required="" value="{{!empty($item)? $item->birth_place : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Tanggal lahir<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="date" name="birthday" required="" value="{{!empty($item)? $item->birthday : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Agama<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="religion" required="" value="{{!empty($item)? $item->religion : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Status pernikahan<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select name="relation_status">
                            <option {{(!empty($item) && $item->relation_status == 'LAJANG')? 'selected' : '' }} value="Lajang">Lajang</option>
                            <option {{(!empty($item) && $item->relation_status == 'MENIKAH')? 'selected' : '' }} value="Menikah">Menikah</option>
                            <option {{(!empty($item) && $item->relation_status == 'JANDA')? 'selected' : '' }} value="Janda">Janda</option>
                            <option {{(!empty($item) && $item->relation_status == 'DUDA')? 'selected' : '' }} value="Duda">Duda</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Pendidikan akhir<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select name="last_education">
                            <option {{(!empty($item) && $item->last_education == 'SMA')? 'selected' : '' }} value="SMA">SMA</option>
                            <option {{(!empty($item) && $item->last_education == 'DIPLOMA')? 'selected' : '' }} value="Diploma">Diploma</option>
                            <option {{(!empty($item) && $item->last_education == 'S1')? 'selected' : '' }} value="S1">S1</option>
                            <option {{(!empty($item) && $item->last_education == 'S2')? 'selected' : '' }} value="S2">S2</option>
                            <option {{(!empty($item) && $item->last_education == 'S3')? 'selected' : '' }} value="S3">S3</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nama ibu kandung<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="mother_name" required="" value="{{!empty($item)? $item->mother_name : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Alamat di Indonesia (Sesuai KTP)<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="address_id" required="" value="{{!empty($item)? $item->address_id : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Telp di Indonesia (Keluarga / Saudara)<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input id="phone_id" class="input" type="text" name="phone_id" required="" value="{{!empty($item)? $item->phone_id : '+62'}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Telp di Taiwan</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input id="phone_tw" class="input" type="text" name="phone_tw" value="{{!empty($item)? $item->phone_tw : '+886'}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Alamat di Taiwan (english version)<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="address_tw_en" required="" value="{{!empty($item)? $item->address_tw_en : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Alamat di Taiwan (chinese version)<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="address_tw_cn" required="" value="{{!empty($item)? $item->address_tw_cn : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">No HP aktif<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input id="phone" class="input" type="text" name="phone" required="" value="{{!empty($item)? $item->phone : '+886'}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">ID LINE<small class="has-text-danger">*</small></label>
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
                <label class="label">Jenjang pendidikan yang ditempuh saat ini<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select name="degree">
                            <option {{(!empty($item) && $item->degree == 'SMA')? 'selected' : '' }} value="SMA">SMA</option>
                            <option {{(!empty($item) && $item->degree == 'S1')? 'selected' : '' }} value="S1">S1</option>
                            <option {{(!empty($item) && $item->degree == 'S2')? 'selected' : '' }} value="S2">S2</option>
                            <option {{(!empty($item) && $item->degree == 'S3')? 'selected' : '' }} value="S3">S3</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Program studi<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="prodi" required="" value="{{!empty($item)? $item->prodi : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Universitas<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="university" required="" value="{{!empty($item)? $item->university : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Tahun dan term masuk<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="year_and_term" required="" placeholder="misal 2020, spring" value="{{!empty($item)? $item->year_and_term : ''}}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Sudah pernah memiliki rekening BNI?<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select name="is_bni">
                            <option {{(!empty($item) && $item->is_bni == 'YA')? 'selected' : '' }} value="YA">YA</option>
                            <option {{(!empty($item) && $item->is_bni == 'TIDAK')? 'selected' : '' }} value="TIDAK">TIDAK</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Berkeinginan membuka dan menggunakan rekening BNI di Taiwan?<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select name="want_bni">
                            <option {{(!empty($item) && $item->want_bni == 'YA')? 'selected' : '' }} value="YA">YA</option>
                            <option {{(!empty($item) && $item->want_bni == 'TIDAK')? 'selected' : '' }} value="TIDAK">TIDAK</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Sudah pernah memiliki internet banking BNI?<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <select name="want_bni_bank">
                            <option {{(!empty($item) && $item->want_bni_bank == 'YA')? 'selected' : '' }} value="YA">YA</option>
                            <option {{(!empty($item) && $item->want_bni_bank == 'TIDAK')? 'selected' : '' }} value="TIDAK">TIDAK</option>
                        </select>
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">SCAN Foto Passport<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->attachment_passport_url))
                    <a href="{{$item->attachment_passport_url}}?v={{time()}}" target="_blank">Download Scan Passport</a>
                    <input class="input" type="file" name="attachment_passport_file">
                    @else
                    <input class="input" type="file" required="" name="attachment_passport_file">
                    @endif
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">SCAN Foto KTP<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->attachment_id_card_url))
                    <a href="{{$item->attachment_id_card_url}}?v={{time()}}" target="_blank">Download Scan KTP</a>
                    <input class="input" type="file" name="attachment_id_card_file">
                    @else
                    <input class="input" type="file" required="" name="attachment_id_card_file">
                    @endif
                </div>
            </div>
        </div>
        @if(empty($item))
        <div class="field box">
            <p class="control">
                <label class="checkbox">
                    <input name="approve_checkbox" type="checkbox" value="1" required="">
                    Data yang diisikan dijamin kerahasiaannya dan hanya digunakan untuk keperluan PPI Taiwan, saya menyetujui data yang saya isi ini untuk dipergunakan sebagaimana mestinya
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
                <span>Simpan dan lanjutkan nanti</span>
            </button>
            <button id="btn_submit" class="button is-success" onclick="changeInputStatus(0)">
                <span>Submit pengajuan</span>
            </button>
            <!-- <a class="target-link" href="dashboard#profile">
                <button class="button is-text">Kembali</button>
            </a> -->
        </div>
    </div>
</form>

<script src="{{asset('vendor/intl-tel-input-17.0.0/build/js/intlTelInput.js')}}"></script>
<script>
    var i_phone = document.querySelector("#phone");
    window.intlTelInput(i_phone, {
        preferredCountries: ["tw","id"],
        nationalMode: false
    });

    var i_phone_tw = document.querySelector("#phone_tw");
    window.intlTelInput(i_phone_tw, {
        onlyCountries: ["tw"],
        nationalMode: false
    });

    var i_phone_id = document.querySelector("#phone_id");
    window.intlTelInput(i_phone_id, {
        onlyCountries: ["id"],
        nationalMode: false
    });
</script>
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

            $('input[name=phone_tw]').removeAttr('required');
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
                        loadContent('card-request');
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