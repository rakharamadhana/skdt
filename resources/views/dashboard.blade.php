@push('meta')
<!-- Meta Tag -->
@endpush

@extends('app')
@section('content')
@include('partials/header-navigation')
<section class="columns is-fullheight">
    <div class="section column" id="appcontent">
    </div>
</section>
<div id="modal-change-password" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head is-info">
            <p class="modal-card-title">Ganti Password</p>
            <button class="delete"></button>
        </header>
        <section class="modal-card-body">
            <form id="form-change-password" method="POST" action="{{route('user.password')}}">
                <div class="field is-horizontal">
                    <div class="field-label is-small">
                        <label class="label">Old Password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control has-icons-left is-expanded">
                                <input class="input" type="password" name="old_password" minlength="4" required="">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-key"></i>
                                </span>
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
        </section>
        <footer class="modal-card-foot">
            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <!-- <button class="button is-link is-primary-color" onclick="actionChangePassword()">Save</button> -->
                    <button type="submit" class="button is-link is-primary-color">Save</button>
                </div>
                </form>
                <div class="control">
                    <button class="button is-cancel is-text">Cancel</button>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection

@push('scripts')
<!-- Javascript -->
<script>
    var dtButtonConfig = {
        buttons: [{
                extend: "pageLength",
                className: "is-black"
            },
            {
                extend: "colvis",
                text: "Ubah Kolom",
                className: "is-info"
            }, {
                extend: "excelHtml5",
                footer: true,
                className: "is-success",
                exportOptions: {
                    columns: ":visible"
                }
            }
        ],
        dom: {
            button: {
                className: "button is-small"
            }
        }
    };

    var dtLengButton = [
        [10, 25, 50, 100, -1],
        ['10', '25', '50', '100', 'All']
    ];

    $(document).ready(function() {
        $('html').addClass('has-navbar-fixed-top');
        var original_title = location.hash;
        var target_url = original_title.replace('#', '');
        if (target_url == '' || target_url == '/' || target_url == 'undefined') {
            loadContent('welcome');
        } else {
            loadContent(target_url);
        }
    });

    window.onhashchange = function() {
        var original_title = location.hash;
        var target_url = original_title.replace('#', '');
        if (target_url == '' || target_url == '/' || target_url == 'undefined') {
            loadContent('welcome');
        } else {
            loadContent(target_url);
        }
    }

    function loadURI(target_url) {
        location.hash = target_url;
    }

    function loadContent(target_url, content) {
        content = typeof content !== 'undefined' ? content : 'appcontent';
        NProgress.start();
        $.ajax({
            type: "GET",
            url: base_url + target_url,
            contentType: false,
            success: function(data) {
                $("#" + content).html(data);

                NProgress.done();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }

    $('#form-change-password').validate({
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
            $('button').attr('disabled', 'disabled');
            $('input').attr('readonly', 'readonly');

            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(result) {
                    if (result.status_code == 200) {
                        iziToast.success({
                            title: 'Succesfully',
                            message: result.message,
                            position: 'topRight'
                        });
                        closeModalHelper();
                        $(form)[0].reset();
                    } else {
                        iziToast.warning({
                            title: 'Oops',
                            message: result.message,
                            position: 'topRight'
                        });
                    }
                },
                complete: function() {
                    $('button').removeAttr('disabled', 'disabled');
                    $('input').removeAttr('readonly', 'readonly');
                }
            });
        }
    });

    function initAutoNumeric() {
        const anElementCurrency = AutoNumeric.multiple('.is-currency', {
            currencySymbol: "Rp",
            decimalCharacter: ".",
            decimalPlaces: 0,
            digitGroupSeparator: ",",
            unformatOnSubmit: true,
            unformatOnHover: false
        });

        const anElementNumber = AutoNumeric.multiple('.is-number', {
            decimalCharacter: ".",
            decimalPlaces: 0,
            digitGroupSeparator: ",",
            unformatOnSubmit: true,
            unformatOnHover: false
        });
    }

    function initAutoSelect2() {
        $(document).ready(function() {
            $('.is-select2').select2();
        });
    }

    function initCalendar() {
        const datetimeCalendars = bulmaCalendar.attach('.is-datepicker', {
            displayMode: 'dialog',
            dateFormat: 'YYYY-MM-DD',
            validateLabel: 'Select'
        });
        const dateCalendars = bulmaCalendar.attach('.is-date', {
            displayMode: 'dialog',
            dateFormat: 'YYYY-MM-DD'
        });
    }
</script>
@endpush