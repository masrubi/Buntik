@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>Kasir - Pembayaran</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Pilih Produk untuk Keranjang</h4>
                            <p class="card-title-desc">Pilih produk dan masukkan jumlah untuk menambahkannya ke keranjang.</p>

                            <!-- Form untuk memilih produk dan jumlah -->
                            <form id="form-add-to-cart">
                                <div class="mb-3">
                                    <label for="produk_id" class="form-label">Pilih Produk</label>
                                    <select id="produk_id" class="form-select">
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->id_produk }}" 
                                                    data-nama="{{ $item->nama_produk }}" 
                                                    data-harga="{{ $item->harga_produk }}" 
                                                    data-stok="{{ $item->stok_produk }}">
                                                {{ $item->nama_produk }} - Stok: {{ $item->stok_produk }} - Rp. {{ number_format($item->harga_produk, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input type="number" id="quantity" class="form-control" value="1" min="1">
                                </div>
                                <button type="button" id="add-btn" class="btn btn-primary">Tambah ke Keranjang</button>
                            </form>

                            <hr>

                            <!-- Keranjang Belanja -->
                            <h4 class="header-title">Keranjang Belanja</h4>
                            <table class="table table-bordered" id="cart-table">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data keranjang akan ditambahkan di sini -->
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Total Belanja: Rp. <span id="total-price">0</span></strong>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-success" id="proceed-payment">Proses Pembayaran</button>
                                </div>
                            </div>

                            <hr>

                            <!-- Form Pembayaran Cash -->
                            <div id="payment-section" style="display:none;">
                                <h4 class="header-title">Pembayaran</h4>
                                <div class="mb-3">
                                    <label for="payment-amount" class="form-label">Jumlah Uang Tunai</label>
                                    <input type="number" id="payment-amount" class="form-control" value="0" min="0" required>
                                </div>
                                <button type="button" class="btn btn-primary" id="calculate-change">Hitung Kembalian</button>

                                <div id="change-section" style="display:none;">
                                    <p><strong>Kembalian: Rp. <span id="change-amount">0</span></strong></p>
                                    <button type="button" class="btn btn-success" id="complete-payment">Selesaikan Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('css')
    <link href="/morvin/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/morvin/dist/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="/morvin/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/morvin/dist/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script>
        let cart = [];
        
        // Menambahkan produk ke keranjang
        document.getElementById('add-btn').addEventListener('click', function () {
            const produkSelect = document.getElementById('produk_id');
            const quantityInput = document.getElementById('quantity');
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const id = produkSelect.value;
            const name = selectedOption.dataset.nama;
            const price = parseFloat(selectedOption.dataset.harga);
            const stok = parseFloat(selectedOption.dataset.stok);
            const quantity = parseInt(quantityInput.value);

            if (quantity > 0) {
                if (quantity > stok) {
                    alert(`Jumlah yang dimasukkan melebihi stok tersedia (${stok}).`);
                    return;
                }

                const existingItem = cart.find(item => item.id === id);
                if (existingItem) {
                    if (existingItem.quantity + quantity > stok) {
                        alert(`Jumlah total melebihi stok tersedia (${stok}).`);
                        return;
                    }
                    existingItem.quantity += quantity;
                } else {
                    cart.push({ id, name, price, quantity });
                }
                updateCart();
                quantityInput.value = 1;
            }
        });

        // Mengupdate tabel keranjang dan total belanja
        function updateCart() {
            const cartTableBody = document.querySelector('#cart-table tbody');
            cartTableBody.innerHTML = '';
            let total = 0;

            cart.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>Rp. ${item.price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</td>
                    <td>${item.quantity}</td>
                    <td>Rp. ${(item.price * item.quantity).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="removeFromCart('${item.id}')">Hapus</button>
                    </td>
                `;
                cartTableBody.appendChild(row);
                total += item.price * item.quantity;
            });

            // Update total price
            document.getElementById('total-price').textContent = total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        // Menghapus produk dari keranjang
        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCart();
        }

        // Menampilkan form pembayaran cash
        document.getElementById('proceed-payment').addEventListener('click', function () {
            if (cart.length === 0) {
                alert('Keranjang masih kosong!');
                return;
            }

            document.getElementById('payment-section').style.display = 'block';
        });

        // Menghitung kembalian
        document.getElementById('calculate-change').addEventListener('click', function () {
            const totalBelanja = parseFloat(document.getElementById('total-price').textContent.replace(/,/g, ''));
            const uangTunai = parseFloat(document.getElementById('payment-amount').value);

            if (isNaN(uangTunai) || uangTunai < totalBelanja) {
                alert('Jumlah uang tunai tidak cukup!');
                return;
            }

            const kembalian = uangTunai - totalBelanja;

            // Tampilkan kembalian
            document.getElementById('change-amount').textContent = kembalian.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            document.getElementById('change-section').style.display = 'block';
        });

        // Selesaikan pembayaran
        document.getElementById('complete-payment').addEventListener('click', function () {
            const totalBelanja = parseFloat(document.getElementById('total-price').textContent.replace(/,/g, ''));

            if (cart.length === 0 || totalBelanja <= 0) {
                alert('Tidak ada transaksi yang dapat diproses!');
                return;
            }

            // Kirim data transaksi ke server
            const transaksiData = {
                cart: cart,
                total: totalBelanja,
                pembayaran: parseFloat(document.getElementById('payment-amount').value)
            };

            // Kirim ke server menggunakan AJAX
            $.ajax({
                url: '/kasir/selesaikan-transaksi', // Ubah URL sesuai dengan rute server yang sesuai
                type: 'POST',
                data: transaksiData,
                success: function(response) {
                    // Tampilkan konfirmasi pembayaran selesai
                    alert('Pembayaran Selesai!');
                    resetTransaksi();
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat mengirimkan transaksi!');
                }
            });
        });

        // Reset transaksi setelah selesai
        function resetTransaksi() {
            cart = [];
            updateCart();
            document.getElementById('payment-amount').value = 0;
            document.getElementById('payment-section').style.display = 'none';
            document.getElementById('change-section').style.display = 'none';
        }
    </script>
@endsection
