<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Tampilkan semua customer kecuali user yang sedang login
        $customer = User::where('role', 'customer') // Hanya role 'customer'
            ->where('id', '!=', Auth::id()) // Kecualikan user yang sedang login
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.customer.customer', compact('customer'));
    }
}
