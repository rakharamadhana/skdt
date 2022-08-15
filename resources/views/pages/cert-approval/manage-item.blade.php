<form id="form-manage-item" 
    method="POST"
    action="{{ route('cert-approval.update', $item->cert_request_id) }}">

    <input type="hidden" name="_method" value="{{ 'PUT' }}">

    <div class="box">
        <nav class="level">
            <div class="level-left">
                <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
            </div>
        </nav>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Nama Kegiatan & Tema<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="title" disabled value="{{ $item->title }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Tujuan<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="purpose" disabled value="{{ $item->purpose }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Departemen<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="dept" disabled value="{{ $item->dept }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">PIC Kegiatan<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="pic" disabled value="{{ $item->pic }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Kontak PIC Kegiatan (LINE ID)<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" name="pic_contact" disabled value="{{ $item->pic_contact }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Tanggal Kegiatan<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="date" name="start_date" disabled value="{{ $item->start_date }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Hingga<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control">
                        <input class="input" type="date" name="end_date" disabled value="{{ $item->end_date }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Dokumen Pendukung<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    @if(!empty($item) && !empty($item->support_file))
                    <a href="{{$item->support_file}}" target="_blank">Download Attachment</a>
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
                        <select name="cert_status" onchange="changeCertStatus()">
                            <option {{(!empty($item) && $item->cert_status == 10)? 'selected' : '' }} value="10">Diproses</option>
                            <option {{(!empty($item) && $item->cert_status == 2)? 'selected' : '' }} value="2">Diterima</option>
                            <option {{(!empty($item) && $item->cert_status == 1)? 'selected' : '' }} value="1">Ditolak, butuh revisi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="place_cert" class="field is-horizontal is-hidden">
            <div class="field-label is-normal">
                <label class="label">Sertifikat yang dibuat<small class="has-text-danger">*</small></label>
            </div>
            <div class="field-body">
                <div class="box">
                    <input class="input" type="file" name="cert_file">
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
    changeCertStatus();

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

    function changeCertStatus(){
        if($('select[name=cert_status]').val() == 1){
            $('#place_notes').removeClass('is-hidden');
            $('#place_cert').addClass('is-hidden');
        }else if($('select[name=cert_status]').val() == 2){
            $('#place_notes').addClass('is-hidden');
            $('#place_cert').removeClass('is-hidden');
        }else if($('select[name=cert_status]').val() == 10){
            $('#place_notes').addClass('is-hidden');
            $('#place_cert').addClass('is-hidden');
        }
    }
</script>