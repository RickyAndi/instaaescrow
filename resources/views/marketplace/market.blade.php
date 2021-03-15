@extends('marketplace.layouts.main')

@section('content')
<div id="app" class="columns mx-0 my-0 is-multiline" style="min-height: 75vh; height: auto;">
    @include('marketplace.components._ui-desktop')

    @include('marketplace.components._ui-touch')

    <div :class="{'is-active': isCreateBuyOrderModalActive}" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ __('label.create_buy_order') }}</p>
            </header>
            <section class="modal-card-body">
                <create-buy-order-form-component>
                </create-buy-order-form-component>
            </section>
        </div>
    </div>

    <div :class="{'is-active': isCreateSellOrderModalActive}" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Modal title</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <!-- Content ... -->
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>

    <div :class="{'is-active': isLoginModalActive }" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Modal title</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <!-- Content ... -->
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>
</div>

<div id="buy-orders-data" style="display:none;">
    {!! $buyOrders->toJson() !!}
</div>

<div id="sell-orders-data" style="display:none;">
    {!! $sellOrders->toJson() !!}
</div>

<div id="user-orders-data" style="display:none;">
    {!! $userOrders->toJson() !!}
</div>

<div id="user-requests-data" style="display:none;">
    {!! $userRequests->toJson() !!}
</div>
@endsection

@push('after-script')
<script>
    window.buyOrdersData = JSON.parse(document.getElementById('buy-orders-data').innerText);
    window.sellOrdersData = JSON.parse(document.getElementById('sell-orders-data').innerText);
    window.userOrdersData = JSON.parse(document.getElementById('user-orders-data').innerText);
    window.userRequestsData = JSON.parse(document.getElementById('user-requests-data').innerText);
    
    @if(Auth::guard('web')->check())
    const isLoggedIn = true;
    @else
    const isLoggedIn = false;
    @endif

    window.i18n = {
        'sell': 'Jual',
        'beli': 'Beli',
        'btcAmount': 'Jumlah Btc',
        'createBuyOrder': 'Buat order',
        'totalAmount': 'Total harga (Rp)',
        'pricePerBtc': 'Harga per Btc (Rp)',
        'noOrders': 'Tidak ada order',
        'buyOrderTitle': 'Beli',
        'saveBuyOrder': 'Simpan order beli',
        'cancel': 'Batal',
        'requestOrderButton': 'Request order',
        'receiverBtcAddress': 'Alamat menerima Btc'
    };

    window.globalData = {
        'isUserLoggedIn': isLoggedIn,
        'locale': 'en'
    };
</script>

<script src="{{ asset('/js/marketplace.js') }}"></script>
@endpush