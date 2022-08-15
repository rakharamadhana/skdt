
<nav class="navbar is-info is-fixed-top" style="border-radius: 0;">
    <div class="navbar-brand">
        <a class="navbar-item target-link" href="dashboard#welcome">
            <img src="{{asset('img/logo-org.png')}}" alt="PPI Taiwan">
            &nbsp; PPI TAIWAN
        </a>
        <a class="navbar-item is-hidden-desktop" href="{{url('/')}}" target="_blank">
            <span class="icon" style="color: #333;">
                <i class="fa fa-github"></i>
            </span>
        </a>
        <div class="navbar-burger burger" data-target="main-navigation">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="main-navigation" class="navbar-menu">
        @if(in_array(auth_data()->user_status, [100, 101, 102, 103, 104, 105]))
        <div class="navbar-start">
            @if(in_array(auth_data()->user_status, [100]))
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    Keorganisasian
                </div>
                <div class="navbar-dropdown ">
                    <a class="navbar-item target-link" href="dashboard#user">
                        Daftar Anggota (User SIAP)
                    </a>
                </div>
            </div>
            @endif
            @if(in_array(auth_data()->user_status, [100, 101]))
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    SIAP
                </div>
                <div class="navbar-dropdown ">
                    <a class="navbar-item target-link" href="dashboard#letter-approval">
                        Approval Surat
                    </a>
                    <a class="navbar-item target-link" href="dashboard#cert-approval">
                        Approval Sertifikat
                    </a>
                </div>
            </div>
            @endif
            @if(in_array(auth_data()->user_status, [100, 102]))
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    KPIT
                </div>
                <div class="navbar-dropdown ">
                    <a class="navbar-item target-link" href="dashboard#card-approval">
                        Approval Pengajuan KPIT
                    </a>
                </div>
            </div>
            @endif
            @if(in_array(auth_data()->user_status, [100, 103, 104, 105]))
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    I3S
                </div>
                <div class="navbar-dropdown ">
                    @if(in_array(auth_data()->user_status, [100, 103, 104]))
                    <a class="navbar-item target-link" href="dashboard#regist-approval">
                        Approval Regist as a Viewer or Presenter
                    </a>
                    @endif
                    @if(in_array(auth_data()->user_status, [100, 103, 105]))
                    <a class="navbar-item target-link" href="dashboard#submission-approval">
                        Approval Submission a Paper I3S
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
        @endif
        <div class="navbar-end">
            @if(in_array(auth_data()->user_status, [10, 11, 12]))
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    SIAP
                </div>
                <div class="navbar-dropdown is-right">
                    <a class="navbar-item target-link" href="dashboard#letter-request">
                        Pengajuan Surat
                    </a>
                    <a class="navbar-item target-link" href="dashboard#cert-request">
                        Pengajuan Sertifikat
                    </a>
                </div>
            </div>
            @endif
            @if(in_array(auth_data()->user_status, [1]) && strpos(Request::url(), 'i3s-submission') !== false)
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    I3S
                </div>
                <div class="navbar-dropdown is-right">
                    <a class="navbar-item target-link" href="dashboard#regist-submission">
                        Regist as a Viewer or Presenter
                    </a>
                    <a class="navbar-item target-link" href="dashboard#submission">
                        Submission a paper
                    </a>
                </div>
            </div>
            @endif
            @if(in_array(auth_data()->user_status, [1]) && strpos(Request::url(), 'kpit') !== false)
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    KPIT
                </div>
                <div class="navbar-dropdown is-right">
                    <a class="navbar-item target-link" href="dashboard#card-request">
                        Apply Kartu Pelajar Indonesia Taiwan (KPIT)
                    </a>
                </div>
            </div>
            @endif
            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-link">
                    User
                </div>
                <div class="navbar-dropdown is-right">
                    <!-- <a class="navbar-item target-link" href="dashboard#profile">
                        Edit Profil
                    </a> -->
                    <a class="navbar-item modal-button" data-target="#modal-change-password">
                        Ganti Password
                    </a>
                    <a class="navbar-item" href="{{route('user.signout')}}">
                        Signout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
