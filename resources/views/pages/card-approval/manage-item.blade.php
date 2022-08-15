<form id="form-manage-item" 
    method="POST"
    action="{{ route('card-approval.update', $item->card_request_id) }}">

    <input type="hidden" name="_method" value="{{ 'PUT' }}">

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
                        <input class="input" type="text" name="fullname" required="" disabled value="{{!empty($item)? $item->fullname : ''}}">
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
                        <select name="gender" disabled>
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
                        <input class="input" type="text" name="passport" required="" disabled value="{{!empty($item)? $item->passport : ''}}">
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
                        <input class="input" type="date" name="passport_date" required="" disabled value="{{!empty($item)? $item->passport_date : ''}}">
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
                        <input class="input" type="text" name="citizen_id_card" required="" disabled value="{{!empty($item)? $item->citizen_id_card : ''}}">
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
                        <input class="input" type="text" name="birth_place" required="" disabled value="{{!empty($item)? $item->birth_place : ''}}">
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
                        <input class="input" type="date" name="birthday" required="" disabled value="{{!empty($item)? $item->birthday : ''}}">
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
                        <input class="input" type="text" name="religion" required="" disabled value="{{!empty($item)? $item->religion : ''}}">
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
                        <select name="relation_status" disabled>
                            <option {{(!empty($item) && $item->relation_status == 'Lajang')? 'selected' : '' }} value="Lajang">Lajang</option>
                            <option {{(!empty($item) && $item->relation_status == 'Menikah')? 'selected' : '' }} value="Menikah">Menikah</option>
                            <option {{(!empty($item) && $item->relation_status == 'Janda')? 'selected' : '' }} value="Janda">Janda</option>
                            <option {{(!empty($item) && $item->relation_status == 'Duda')? 'selected' : '' }} value="Duda">Duda</option>
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
                        <select name="last_education" disabled>
                            <option {{(!empty($item) && $item->last_education == 'SMA')? 'selected' : '' }} value="SMA">SMA</option>
                            <option {{(!empty($item) && $item->last_education == 'Diploma')? 'selected' : '' }} value="Diploma">Diploma</option>
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
                        <input class="input" type="text" name="mother_name" required="" disabled value="{{!empty($item)? $item->mother_name : ''}}">
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
                        <input class="input" type="text" name="address_id" required="" disabled value="{{!empty($item)? $item->address_id : ''}}">
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
                        <input id="phone_id" class="input" type="text" name="phone_id" required="" disabled value="{{!empty($item)? $item->phone_id : '+62'}}">
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
                        <input id="phone_tw" class="input" type="text" name="phone_tw" disabled value="{{!empty($item)? $item->phone_tw : '+886'}}">
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
                        <input class="input" type="text" name="address_tw_en" required="" disabled value="{{!empty($item)? $item->address_tw_en : ''}}">
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
                        <input class="input" type="text" name="address_tw_cn" required="" disabled value="{{!empty($item)? $item->address_tw_cn : ''}}">
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
                        <input id="phone" class="input" type="text" name="phone" required="" disabled value="{{!empty($item)? $item->phone : '+886'}}">
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
                        <input class="input" type="text" name="line_id" required="" disabled value="{{!empty($item)? $item->line_id : ''}}">
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
                        <select name="degree" disabled>
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
                        <input class="input" type="text" name="prodi" required="" disabled value="{{!empty($item)? $item->prodi : ''}}">
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
                        <input class="input" type="text" name="university" required="" disabled value="{{!empty($item)? $item->university : ''}}">
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
                        <input class="input" type="text" name="year_and_term" required="" disabled placeholder="misal 2020, spring" value="{{!empty($item)? $item->year_and_term : ''}}">
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
                        <select name="is_bni" disabled>
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
                        <select name="want_bni" disabled>
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
                        <select name="want_bni_bank" disabled>
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
                        <select name="card_status" onchange="changeCardStatus()">
                            <option {{(!empty($item) && $item->card_status == 10)? 'selected' : '' }} value="10">Diproses</option>
                            <option {{(!empty($item) && $item->card_status == 2)? 'selected' : '' }} value="2">Diterima</option>
                            <option {{(!empty($item) && $item->card_status == 1)? 'selected' : '' }} value="1">Ditolak, butuh revisi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="place_card" class="field is-horizontal is-hidden">
            <div class="field-label is-normal">
                <label class="label">KPIT yang dibuat<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    <input class="input" type="file" name="card_file">
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
        if($('select[name=card_status]').val() == 1){
            $('#place_notes').removeClass('is-hidden');
            $('#place_card').addClass('is-hidden');
        }else if($('select[name=card_status]').val() == 2){
            $('#place_notes').addClass('is-hidden');
            $('#place_card').removeClass('is-hidden');
        }else if($('select[name=card_status]').val() == 10){
            $('#place_notes').addClass('is-hidden');
            $('#place_card').addClass('is-hidden');
        }
    }
</script>