@push('meta')
<!-- Meta Tag -->
<style>
.google-btn {
    margin-left: auto;
    margin-right: auto;
    width: 184px;
    height: 42px;
    background-color: #4285f4;
    border-radius: 2px;
    box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.25);
}

.google-btn .google-icon-wrapper {
    position: absolute;
    margin-top: 1px;
    margin-left: 1px;
    width: 40px;
    height: 40px;
    border-radius: 2px;
    background-color: #fff;
}

.google-btn .google-icon {
    position: absolute;
    margin-top: 11px;
    margin-left: 11px;
    width: 18px;
    height: 18px;
}

.google-btn .btn-text {
    float: right;
    margin: 11px 11px 0 0;
    color: #fff;
    font-size: 14px;
    letter-spacing: 0.2px;
    font-family: "Roboto";
}

.google-btn:hover {
    box-shadow: 0 0 6px #4285f4;
}

.google-btn:active {
    background: #1669F2;
}
</style>
@endpush

@extends('app')
@section('content')
    @if(strpos(Request::url(), 'siap') !== false)
    <style>
        .bg-sign-in{
            background-color: #747474;
        }
    </style>
    @elseif(strpos(Request::url(), 'kpit') !== false)
    <style>
        .bg-sign-in{
            background-color: #5172ff;
        }
    </style>
    @elseif(strpos(Request::url(), 'i3s-submission') !== false)
    <style>
        .bg-sign-in{
            background-color: #54457F;
        }
    </style>
    @else
    <style>
        .bg-sign-in{
            background-color: #747474;
        }
    </style>
    @endif

<div class="columns is-vcentered bg-sign-in" style="min-height: 110vh;">
    <div class="column is-8-desktop">
        <figure class="image">
            @if(strpos(Request::url(), 'siap') !== false)
            <img src="{{asset('img/bg-login-siap.png?v=1')}}">
            @elseif(strpos(Request::url(), 'kpit') !== false)
            <img src="{{asset('img/bg-login-kpit.png?v=1')}}">
            @elseif(strpos(Request::url(), 'i3s-submission') !== false)
            <img src="{{asset('img/bg-login-i3s.png?v=1')}}">
            @else
            <img src="{{asset('img/bg-login.jpg')}}">
            @endif
        </figure>
    </div>
    <div class="column is-4 ">
        <section class="section">
            @if(strpos(Request::url(), 'kpit') !== false)
            <div class="has-text-centered has-text-white">
                Bagi Anda yang ingin melakukan registrasi baru <br>Kartu Pelajar Indonesia Taiwan.
            </div>
            <div style="margin-top: 2rem;">
                <a href="{{url('signin-with-google')}}">
                    <div class="google-btn">
                        <div class="google-icon-wrapper">
                            <img class="google-icon" src="{{asset('img/Google_Logo.svg')}}"/>
                        </div>
                        <p class="btn-text"><b>Sign in with google</b></p>
                    </div>
                </a>
            </div>
            @elseif(strpos(Request::url(), 'i3s-submission') !== false)
            <div class="has-text-centered has-text-white">
                For those of you who want to register For the <br><b>Indonesian Scholar Scientific Summit Program</b>.
            </div>
            <div style="margin-top: 2rem;">
                <a href="{{url('signin-with-google')}}">
                    <div class="google-btn">
                        <div class="google-icon-wrapper">
                            <img class="google-icon" src="{{asset('img/Google_Logo.svg')}}"/>
                        </div>
                        <p class="btn-text"><b>Sign in with google</b></p>
                    </div>
                </a>
            </div>
            @else
            <form id="form-signin" class="is-bottom-gap" action="{{route('user.signin')}}" method="POST">
                @csrf
                <div class="field">
                    <label class="label has-text-white">Username</label>
                    <div class="control has-icons-left">
                        <input name="username" class="input" type="text" required="">
                        <span class="icon is-small is-left">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label has-text-white">Password</label>
                    <div class="control has-icons-left">
                        <input name="password" class="input" type="password" required="">
                        <span class="icon is-small is-left">
                            <i class="fa fa-key"></i>
                        </span>
                    </div>
                </div>
                <div class="has-text-centered">
                    <button type="submit" class="button is-primary">Login</button>
                </div>
            </form>
            <div class="has-text-centered has-text-white">
                Belum memiliki akun? <br>Silakan kontak pengurus di <a class="has-text-black" target="_blank" href="#">Pengurus PPI Taiwan</a>
            </div>
            @endif
            <br>
            <div class="has-text-centered has-text-white">
                <small>PPI TAIWAN &copy;2021</small>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<!-- Javascript -->
<script>
    $('html').css('overflow', 'hidden');
    $('#form-signin').validate({
        highlight: function (input) {
            $(input).addClass('is-danger');
        },
        unhighlight: function (input) {
            $(input).removeClass('is-danger');
        },
        errorPlacement: function (error, element) {
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
                    if(response.status_code == 200){
                        iziToast.success({ title: 'Succesfully', message: response.message, position: 'topRight' });
                        window.location.href = base_url + 'dashboard';
                    }else{
                        iziToast.warning({ title: 'Oops', message: response.message, position: 'topRight' });
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
@endpush
