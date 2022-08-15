<div class="card is-bottom-gap">
    <div class="card-content">
        @include('partials/breadcrumb-navigation', ['breadcrumb' => $breadcrumb])
    </div>
</div>
<div class="card">
    <div class="card-content">
        <div class="content" style="margin-bottom: 2rem;">
            <nav class="level">
                <div class="level-left">
                    <p class="title"><strong>{{end($breadcrumb)->name}}</strong></p>
                </div>
            </nav>
        </div>
        <div class="columns">
            <div class="column">
                <div class="has-text-centered">
                    <figure class="image is-128x128">
                        <img src="{{asset('img/logo-org.png')}}">
                    </figure>
                </div>
            </div>
            <div class="column is-10">
                @if(strpos(Request::url(), 'siap') !== false)
                    @php
                    $submodul = 'SIAP';
                    @endphp
                @elseif(strpos(Request::url(), 'kpit') !== false)
                    @php
                        $submodul = 'KPIT';
                    @endphp
                @elseif(strpos(Request::url(), 'i3s-submission') !== false)
                    @php
                        $submodul = 'I3S';
                    @endphp
                @else
                    @php
                        $submodul = 'SKDT';
                    @endphp
                @endif
                <p class="title is-4">Welcome {{auth_data()->fullname}}
                    @if($submodul == 'KPIT' || $submodul == 'SKDT')
                    <b style="text-decoration-line: underline;">({{auth_data()->statusToText()}})</b>
                    @endif
                    on {{$submodul}} PPI Taiwan</p>
                @if($submodul == 'KPIT')
                <p class="subtitle is-4">Untuk lebih memahami Tata Cara pengajuan KPIT pada Sistem PPI Taiwan, Anda bisa cek pada tautan di bawah</p>
                <p class="subtitle is-4"><a target="_blank" href="{{asset('doc/KPIT MANUAL(2).pdf')}}">Download Manual Penggunaan Sistem KPIT</a> atau tonton <a target="_blank" href="https://youtu.be/5n5oHLYeDW8">Video kami berikut ini</a></p>
                @endif
                @if($submodul == 'I3S')
                <p class="subtitle is-4">Thank you for registering in the PPI Taiwan System for the Indonesian Scholar Scientific Summit</p>
                <p class="subtitle is-4">Please use the menu at the top right to register</p>
                @endif
            </div>
        </div>
    </div>
</div>
