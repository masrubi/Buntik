<?php
namespace App\Http\Controllers\Anggota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class AnggotaKasirController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        $produk = Produk::all();
        return view('anggota.kasir.index', compact('produk'));
    }

    /**
     * Menambahkan produk ke keranjang
     */
    public function addToCart($id, Request $request)
    {
        $produk = Produk::find($id);
        $quantity = $request->input('quantity', 1);

        // Cek apakah produk sudah ada dalam keranjang
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity; // Update jumlah
        } else {
            $cart[$id] = [
                'id' => $produk->id_produk,
                'name' => $produk->nama_produk,
                'price' => $produk->harga_produk,
                'quantity' => $quantity,
            ];
        }

        // Update keranjang ke session
        session()->put('cart', $cart);
        return redirect()->route('anggota.kasir.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /**
     * Menampilkan keranjang belanja
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('anggota.kasir.cart', compact('cart', 'total'));
    }

    /**
     * Checkout transaksi
     */
    public function checkout(Request $request)
{
    // Validasi data transaksi
    $request->validate([
        'items' => 'required|array',
        'items.*.id' => 'required|exists:produk_tani,id_produk',
        'items.*.quantity' => 'required|integer|min:1',
        'total' => 'required|numeric|min:0',
        'bayar' => 'required|numeric|min:0',
    ]);

    // Pastikan jumlah bayar mencukupi
    if ($request->bayar < $request->total) {
        return back()->with('error', 'Jumlah pembayaran tidak mencukupi!');
    }

    // Buat transaksi
    $transaksi = Transaksi::create([
        'user_id' => auth()->id(),
        'total' => $request->total,
        'metode_pembayaran' => 'cash', // Pembayaran tunai
        'status' => 'selesai',
    ]);

    // Tambahkan detail transaksi
    foreach ($request->items as $item) {
        $produk = ProdukTani::findOrFail($item['id']);
        
        // Simpan detail transaksi
        TransaksiDetail::create([
            'transaksi_id' => $transaksi->id,
            'produk_tani_id' => $produk->id_produk,
            'jumlah' => $item['quantity'],
            'harga' => $produk->harga_produk,
        ]);
    }

    // Hitung kembalian
    $kembalian = $request->bayar - $request->total;

    // Kembalikan respons
    return redirect()->route('kasir.index')->with('success', "Transaksi selesai! Kembalian: Rp. $kembalian");
}

    /**
     * Menampilkan riwayat transaksi
     */
    public function history()
    {
        $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
        return view('anggota.kasir.history', compact('transaksi'));
    
    }


}
