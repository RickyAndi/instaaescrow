@extends('marketplace.layouts.main')

@section('content')
<section class="hero is-medium is-primary">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-8-desktop is-offset-2-desktop has-text-centered">
                    <h1 class="title is-2 is-spaced has-text-white has-text-weight-bold">
                        InstaEscrow
                    </h1>
                    <h2 class="subtitle is-4 has-text-white">
                        Jual beli bitcoin dengan murah, aman, dan cepat
                    </h2>
                    @if(Auth::guard('web')->check())
                    <a class="button is-info has-text-white is-medium" href="{{ route('marketplace.order-book') }}">Lihat order book</a>
                    @else
                    <button class="button is-info has-text-white is-medium open-login-modal-button" href="{{ route('marketplace.order-book') }}">Lihat order book</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="columns">
        <div class="column">
            <h3 class="is-size-3 has-text-centered">Kenapa harus pakai InstaEscrow ?</h1>
        </div>
    </div>
    <div class="columns is-centered">
        <div class="column is-10-desktop">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h4 class="is-size-6 has-text-black">1. Aman</h4>
                                <p>
                                    Kami hanya escrow, menjamin transaksi terpenuhi antar dua pihak dan tidak ada sistem deposit
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h4 class="is-size-6 has-text-black">2. Murah</h4>
                                <p>
                                    Kami paling murah dibandingkan dengan exchanger dan marketplace
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h4 class="is-size-6 has-text-black">3. Cepat</h4>
                                <p>
                                    Uang dan crypto akan masuk ke rekening sesaat selesai transaksi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="columns is-multiline is-centered">
        <div class="column is-12">
            <h3 class="is-size-3 has-text-centered">Bagaimana caranya ?</h1>
        </div>

        <div class="column is-10">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h4 class="is-size-6 has-text-black">1. Buka order book</h4>
                                <p>
                                    Order book berisi order dari orang lain yang ingin membeli / menjual Bitcoin
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h4 class="is-size-6 has-text-black">2. Pilih order</h4>
                                <p>
                                    Pilih order yang sesuai dengan keinginan anda
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h4 class="is-size-6 has-text-black">3. Tunggu persetujuan</h4>
                                <p>
                                    Tunggu pemilik order menyetujui request anda
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="content">
                                <h4 class="is-size-6 has-text-black">4. Mulai transaksi</h4>
                                <p>
                                    Mulai transaksi setelah order disetujui
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div id="login-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head has-text-center">
            <p class="modal-card-title"></p>
            <button id="login-modal-close-button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <div class="columns is-multiline">
                <div class="column is-12 has-text-centered">
                    <h3 class="title is-3">InstaEscrow</h3>
                </div>
                <div class="column is-12 has-text-centered">
                    <p>Login untuk dapat melakukan transaksi</p>
                    <a href="" class="mt-2 button is-danger is-fullwidth"><i class="fab fa-google"></i>&nbsp;Login dengan Google</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('after-script')
<script>
    document.querySelectorAll('.open-login-modal-button').forEach((element) => {
        element.addEventListener('click', () => {
            document.getElementById('login-modal').classList.toggle('is-active');
        });
    });
    
    document.getElementById('login-modal-close-button').addEventListener('click', () => {
        document.getElementById('login-modal').classList.toggle('is-active');  
    });
</script>
@endpush