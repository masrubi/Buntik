<div class="vertical-menu">

    <div data-simplebar class="h-100">


        {{-- <div class="user-sidebar text-center">
            <div class="dropdown">
                <div class="user-img">
                    <img src="/morvin/dist/assets/images/users/avatar-7.jpg" alt="" class="rounded-circle">
                    <span class="avatar-online bg-success"></span>
                </div>
                <div class="user-info">
                    <h5 class="mt-3 font-size-16 text-white">James Raphael</h5>
                    <span class="font-size-13 text-white-50">Anggotaistrator</span>
                </div>
            </div>
        </div> --}}

        @php
            $notif_sidebar_pesanan = DB::table('pesanan')
            ->where('pesanan.status', 'Pesanan Di Terima')
            ->orWhere('pesanan.status','Bukti Pembayaraan Sedang Di Tinjau')
            ->orderBy('pesanan.updated_at', 'desc')
            ->get();
            @endphp

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ Route('anggota.dashboard') }}" class="waves-effect">
                        <i class="dripicons-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->is('anggota/pesanan/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('pesananAnggota.index') }}" class="waves-effect">
                        <i class="mdi mdi-cart-arrow-up"></i>
                        @if ($notif_sidebar_pesanan->count() > 0)
                        <span class="badge rounded-pill bg-info float-end">{{ $notif_sidebar_pesanan->count() }}</span>
                        @endif
                        <span>Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('anggota.laporan_penjualan') }}" class="waves-effect">
                        <i class="dripicons-print"></i>
                        <span>Laporan Penjualan</span>
                    </a>
                </li>
                @php
                $notif_chat = DB::Table('chat')
                ->where('to_id', Auth::user()->id)
                ->where('status', 'off read')
                ->get();
                @endphp
                <li class="{{ request()->is('anggota/chat/*') ? 'mm-active' : '' }}">
                    <a href="{{ Route('anggota.chat') }}" class="waves-effect">
                        <i class="dripicons-message"></i>
                        @if ($notif_chat->count() > 0)
                        <span class="badge rounded-pill bg-danger float-end">{{ $notif_chat->count() }}</span>
                        @endif
                        <span> Chatting</span>
                    </a>
                </li>

                <li class="menu-title">Produk</li>

                {{-- <li class="{{ request()->is('anggota/produk_non/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('produk_non.index') }}" class="waves-effect">
                        <i class="mdi mdi-storefront"></i>
                        <span>Produk Non Grosir</span>
                    </a>
                </li> --}}

                <li class="{{ request()->is('anggota/produk/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('anggota.produk.index') }}" class="waves-effect">
                        <i class="dripicons-store"></i>
                        <span>Produk</span>
                    </a>
                </li>

                <li class="{{ request()->is('anggota/kategori/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('anggota.kategori.index') }}" class="waves-effect">
                        <i class="dripicons-tag"></i>
                        <span>Kategori Produk</span>
                    </a>
                </li>

                <li class="menu-title">Packing dan Aplikasi Semai</li>

                <li class="{{ request()->is('anggota/variasi/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('anggota.variasi.index') }}" class="waves-effect">
                        <i class="mdi mdi-leaf"></i>
                        <span>Packing Produk</span>
                    </a>
                </li>

                <li class="{{ request()->is('anggota/semai/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('anggota.semai.index') }}" class="waves-effect">
                        <i class="mdi mdi-seed"></i>
                        <span>Aplikasi Semai</span>
                    </a>
                </li>

                <li class="menu-title">Customer</li>

                <li class="{{ request()->is('anggota/customer/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('anggota.customer.index') }}" class="waves-effect">
                        <i class="mdi mdi-human-male-male"></i>
                        <span>Konsumen</span>
                    </a>
                </li>

                <li class="menu-title">Setting</li>
                <li class="{{ request()->is('anggota/rekening/*') ? 'mm-active' : ''}}">
                    <a href="{{ route('anggota.rekening.index') }}" class="waves-effect">
                        <i class="mdi mdi-credit-card-check"></i>
                        <span>Nomor Rekening</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
