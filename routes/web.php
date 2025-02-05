<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Admin\ChatAdminController;
use App\Http\Controllers\Admin\AdminHasilPanenController;
use App\Http\Controllers\Admin\AdminPengelolaanTanamanController;
use App\Http\Controllers\Admin\LaporanPenjualanAdminController;
use App\Http\Controllers\Admin\PesananAdminController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\RekeningAdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAplikasiSemaiController;
use App\Http\Controllers\Admin\AdminKategoriProdukController;
use App\Http\Controllers\Admin\AdminKelompokTaniController;
use App\Http\Controllers\Admin\AdminTanamanController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminProduknonController;
use App\Http\Controllers\Admin\AdminVariasiProdukController;
use App\Http\Controllers\Admin\AdminKasirController;
use App\Http\Controllers\Customer\AlamatCustomerController;
use App\Http\Controllers\Customer\ChatCustomerController;
use App\Http\Controllers\Customer\CustomerProdukController;
use App\Http\Controllers\Customer\DashboardCustomerController;
use App\Http\Controllers\Customer\KeranjangCustomerController;
use App\Http\Controllers\Customer\KomentarCustomerController;
use App\Http\Controllers\Customer\PesananCustomerController;
use App\Http\Controllers\Customer\PesananDPCustomerController;
use App\Http\Controllers\Customer\ProfileCustomerController;
use App\Http\Controllers\Customer\RiwayatPesananController;

use App\Http\Controllers\Anggota\ChatAnggotaController;
use App\Http\Controllers\Anggota\AlamatAnggotaController;
use App\Http\Controllers\Anggota\AnggotaHasilPanenController;
use App\Http\Controllers\Anggota\AnggotaPengelolaanTanamanController;
use App\Http\Controllers\Anggota\LaporanPenjualanAnggotaController;
use App\Http\Controllers\Anggota\PesananAnggotaController;
use App\Http\Controllers\Anggota\ProfileAnggotaController;
use App\Http\Controllers\Anggota\RekeningAnggotaController;
use App\Http\Controllers\Anggota\AnggotaDashboardController;
use App\Http\Controllers\Anggota\AnggotaAplikasiSemaiController;
use App\Http\Controllers\Anggota\AnggotaKategoriProdukController;
use App\Http\Controllers\Anggota\AnggotaKelompokTaniController;
use App\Http\Controllers\Anggota\AnggotaTanamanController;
use App\Http\Controllers\Anggota\AnggotaProdukController;
use App\Http\Controllers\Anggota\AnggotaProduknonController;
use App\Http\Controllers\Anggota\AnggotaVariasiProdukController;
use App\Http\Controllers\Anggota\AnggotaKasirController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');

Route::get('/product', [HomeController::class, 'tani'])->name('produk');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/product/detail/{produk}', [HomeController::class, 'detail_produk'])->name('detail_produk');

Route::get('/kategori/search/{kategori}', [HomeController::class, 'cari_kategori'])->name('cari_kategori');

Route::get('/product_non', [HomeController::class, 'non_grosir'])->name('produk_non');

Route::get('/product_non/detail/{produk}', [HomeController::class, 'detail_produk_non'])->name('detail_produk_non');

Route::get('/kategori_non/search/{kategori_non}', [HomeController::class, 'cari_kategori_non'])->name('cari_kategori_non');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/dashboard', [AdminDashboardController::class, 'laporan'])->name('admin.laporan');

    Route::resource('/admin/produk_non', AdminProduknonController::class);    

    Route::resource('/admin/kelompok_tani', AdminKelompokTaniController::class, ['as' => 'admin']);

    Route::resource('/admin/tanaman', AdminTanamanController::class, ['as' => 'admin']);

    Route::resource('/admin/pengelolaan_tanaman', AdminPengelolaanTanamanController::class, ['as' => 'admin']);

    Route::resource('/admin/hasil_panen', AdminHasilPanenController::class, ['as' => 'admin']);

    Route::resource('/admin/produk', AdminProdukController::class, ['as' => 'admin']);

    Route::resource('/admin/kategori', AdminKategoriProdukController::class, ['as' => 'admin']);

    Route::resource('/admin/variasi', AdminVariasiProdukController::class, ['as' => 'admin']);

    Route::resource('/admin/semai', AdminAplikasiSemaiController::class, ['as' => 'admin']);

    Route::resource('/admin/rekening', RekeningAdminController::class, ['as' => 'admin']);

    Route::get('/admin/customer', [UserController::class, 'index'])->name('admin.customer.index');

    Route::get('/admin/pesanan', [PesananAdminController::class, 'index'])->name('pesananAdmin.index');

    Route::get('/admin/pesanan/konfirm-pesanan/{pesanan}', [PesananAdminController::class, 'konfirm_pembayaran'])->name('pesananAdmin.konfirm_pesanan');
    Route::get('/admin/pesanan/tolak-pesanan/{pesanan}', [PesananAdminController::class, 'tolak_pembayaran'])->name('pesananAdmin.tolak_pesanan');
    Route::get('/admin/pesanan/cetak-pesanan/{pesanan}', [PesananAdminController::class, 'cetak_pesanan'])->name('pesananAdmin.cetak_pesanan');
    Route::get('/admin/pesanan/download/{pesanan}', [PesananAdminController::class, 'download_request'])->name('pesananAdmin.download');
    Route::put('/admin/pesanan/resi-store/{pesanan}', [PesananAdminController::class, 'store_resi'])->name('pesananAdmin.store_resi');

    Route::get('/admin/pesanan/tagihan-dp/{pesanan}', [PesananAdminController::class, 'kirim_tagihan'])->name('pesananAdmin.kirim_tagihan');
    Route::get('/admin/pesanan/tagihan-dp/tolak/{pesanan}', [PesananAdminController::class, 'tolak_sisa_dp'])->name('pesananAdmin.tolak_tagihan_dp');
    Route::get('/admin/pesanan/tagihan-dp/terima/{pesanan}', [PesananAdminController::class, 'terima_sisa_dp'])->name('pesananAdmin.terima_tagihan_dp');

    Route::get('/admin/chat', [ChatAdminController::class, 'index'])->name('admin.chat');
    Route::get('/admin/chat/{chat}', [ChatAdminController::class, 'detail_chat'])->name('admin.chat_detail');
    Route::post('/admin/chat', [ChatAdminController::class, 'send'])->name('admin.post_chat');

    Route::get('/admin/profile', [ProfileAdminController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile/store', [ProfileAdminController::class, 'store'])->name('admin.profile_store');
    Route::put('/admin/profile/update/{profile}', [ProfileAdminController::class, 'update_profile'])->name('admin.profile_update');

    Route::get('/admin/laporan/penjualan', [LaporanPenjualanAdminController::class, 'laporan_penjualan'])->name('admin.laporan_penjualan');
    Route::get('/admin/laporan/cetak', [LaporanPenjualanAdminController::class, 'cetakLaporan'])->name('admin.laporan.cetak');
    
    Route::get('admin/kasir', [AdminKasirController::class, 'index'])->name('admin.kasir.index');
    Route::post('admin/kasir/add-to-cart/{id}', [AdminKasirController::class, 'addToCart'])->name('admin.kasir.addToCart');
    Route::get('admin/kasir/cart', [AdminKasirController::class, 'cart'])->name('admin.kasir.cart');
    Route::post('admin/kasir/checkout', [AdminKasirController::class, 'checkout'])->name('admin.kasir.checkout');
    Route::get('admin/kasir/history', [AdminKasirController::class, 'history'])->name('admin.kasir.history');

    
});

Route::middleware(['auth', 'user-access:anggota', 'check-profile-completion'])->group(function () {

    Route::get('/anggota/dashboard', [AnggotaDashboardController::class, 'index'])->name('anggota.dashboard');
    Route::post('/anggota/dashboard', [AnggotaDashboardController::class, 'laporan'])->name('anggota.laporan');

    Route::resource('/anggota/produk_non', ProduknonController::class, ['as' => 'anggota']);

    Route::resource('/anggota/produk', ProdukController::class, ['as' => 'anggota']);

    Route::resource('/anggota/kelompok_tani', AnggotaKelompokTaniController::class, ['as' => 'anggota']);

    Route::resource('/anggota/tanaman', AnggotaTanamanController::class, ['as' => 'anggota']);

    Route::resource('/anggota/pengelolaan_tanaman', AnggotaPengelolaanTanamanController::class, ['as' => 'anggota']);

    Route::resource('/anggota/hasil_panen', AnggotaHasilPanenController::class, ['as' => 'anggota']);

    Route::resource('/anggota/kategori', KategoriProdukController::class, ['as' => 'anggota']);

    Route::resource('/anggota/variasi', VariasiProdukController::class, ['as' => 'anggota']);

    Route::resource('/anggota/semai', AplikasiSemaiController::class, ['as' => 'anggota']);

    Route::resource('/anggota/semai', AplikasiSemaiController::class, ['as' => 'anggota']);

    Route::resource('/anggota/rekening', RekeningAnggotaController::class, ['as' => 'anggota']);

    Route::get('/anggota/customer', [UserController::class, 'index'])->name('anggota.customer.index');

    Route::get('/anggota/pesanan', [PesananAnggotaController::class, 'index'])->name('pesananAnggota.index');

    Route::get('/anggota/pesanan/konfirm-pesanan/{pesanan}', [PesananAnggotaController::class, 'konfirm_pembayaran'])->name('pesananAnggota.konfirm_pesanan');
    Route::get('/anggota/pesanan/tolak-pesanan/{pesanan}', [PesananAnggotaController::class, 'tolak_pembayaran'])->name('pesananAnggota.tolak_pesanan');
    Route::get('/anggota/pesanan/cetak-pesanan/{pesanan}', [PesananAnggotaController::class, 'cetak_pesanan'])->name('pesananAnggota.cetak_pesanan');
    Route::get('/anggota/pesanan/download/{pesanan}', [PesananAnggotaController::class, 'download_request'])->name('pesananAnggota.download');
    Route::put('/anggota/pesanan/resi-store/{pesanan}', [PesananAnggotaController::class, 'store_resi'])->name('pesananAnggota.store_resi');

    Route::get('/anggota/pesanan/tagihan-dp/{pesanan}', [PesananAnggotaController::class, 'kirim_tagihan'])->name('pesananAnggota.kirim_tagihan');
    Route::get('/anggota/pesanan/tagihan-dp/tolak/{pesanan}', [PesananAnggotaController::class, 'tolak_sisa_dp'])->name('pesananAnggota.tolak_tagihan_dp');
    Route::get('/anggota/pesanan/tagihan-dp/terima/{pesanan}', [PesananAnggotaController::class, 'terima_sisa_dp'])->name('pesananAnggota.terima_tagihan_dp');

    Route::get('/anggota/chat', [ChatAnggotaController::class, 'index'])->name('anggota.chat');
    Route::get('/anggota/chat/{chat}', [ChatAnggotaController::class, 'detail_chat'])->name('anggota.chat_detail');
    Route::post('/anggota/chat', [ChatAnggotaController::class, 'send'])->name('anggota.post_chat');

    Route::get('/anggota/profile', [ProfileAnggotaController::class, 'index'])->name('anggota.profile');
    Route::post('/anggota/profile/store', [ProfileAnggotaController::class, 'store'])->name('anggota.profile_store');
    Route::put('/anggota/profile/update/{profile}', [ProfileAnggotaController::class, 'update_profile'])->name('anggota.profile_update');

    Route::get('/anggota/alamat/alamat_anggota/{alamat}', [AlamatAnggotaController::class, 'create_alamat_anggota'])->name('anggota.alamat_anggota');
    Route::post('/anggota/alamat/alamat_anggota/store', [AlamatAnggotaController::class, 'store_alamat_anggota'])->name('anggota.alamat_anggotat_store');
    
    Route::get('/anggota/laporan/penjualan', [LaporanPenjualanAnggotaController::class, 'laporan_penjualan'])->name('anggota.laporan_penjualan');
    Route::get('/anggota/laporan/cetak', [LaporanPenjualanAnggotaController::class, 'cetakLaporan'])->name('anggota.laporan.cetak');
    
    Route::get('anggota/kasir', [AnggotaKasirController::class, 'index'])->name('anggota.kasir.index');
    Route::post('anggota/kasir/add-to-cart/{id}', [AnggotaKasirController::class, 'addToCart'])->name('anggota.kasir.addToCart');
    Route::get('anggota/kasir/cart', [AnggotaKasirController::class, 'cart'])->name('anggota.kasir.cart');
    Route::post('anggota/kasir/checkout', [AnggotaKasirController::class, 'checkout'])->name('anggota.kasir.checkout');
    Route::get('anggota/kasir/history', [AnggotaKasirController::class, 'history'])->name('anggota.kasir.history');
    
   
    

    
});

Route::middleware(['auth', 'user-access:pembeli'])->group(function () {
    Route::get('/customer/dashboard', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');

    Route::get('/customer/produk', [CustomerProdukController::class, 'index'])->name('customer.produk');
    Route::get('/customer/produk/detail/{produk}', [CustomerProdukController::class, 'detail_produk'])->name('customer.detail_produk');

    Route::get('/customer/produk/kategori/{kategori}', [CustomerProdukController::class, 'kategori_produk'])->name('customer.kategori_produk');

    Route::resource('/customer/keranjang', KeranjangCustomerController::class);

    Route::get('/customer/alamat/checkout/{alamat}', [AlamatCustomerController::class, 'create_checkout'])->name('customer.alamat_checkout');
    Route::post('/customer/alamat/checkout/store', [AlamatCustomerController::class, 'store_alamat_checkout'])->name('customer.alamat_checkout_store');

    Route::resource('/customer/pesanan', PesananCustomerController::class);
    route::put('/customer/pesanan-dp/update/{pesanan}', [PesananDPCustomerController::class, 'update_sisa'])->name('customer.pesanan_dp');

    Route::post('/customer/komentar', [KomentarCustomerController::class, 'store_komentar'])->name('customer.store_komentar');

 


    Route::get('/customer/riwayat', [RiwayatPesananController::class, 'index'])->name('customer.riwayat');

    Route::get('/customer/chat', [ChatCustomerController::class, 'index'])->name('customer.chat');
    Route::post('/customer/chat', [ChatCustomerController::class, 'send'])->name('customer.post_chat');

    Route::get('/customer/profile', [ProfileCustomerController::class, 'index'])->name('customer.profile');
    Route::post('/customer/profile/store', [ProfileCustomerController::class, 'store'])->name('customer.profile_store');
    Route::put('/customer/profile/update/{profile}', [ProfileCustomerController::class, 'update_profile'])->name('customer.profile_update');

    

    Route::get('/get-kabupaten/{provinsiId}', [AlamatCustomerController::class, 'getKabupaten'])->name('customer.kabupaten');
    Route::get('/get-kecamatan/{kabupatenId}', [AlamatCustomerController::class, 'getKecamatan'])->name('customer.kecamatan');
    Route::get('/get-desa/{kecamatanId}', [AlamatCustomerController::class, 'getDesa'])->name('customer.desa');
    

});




