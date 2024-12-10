<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatAdminController extends Controller
{
    public function index()
{
    // Query untuk mengambil chat
    $chat = Chat::join('users', 'users.id', '=', 'chat.from_id')
        ->select(
            'users.id',
            'users.nama',
            'users.foto_profile',
            DB::raw('COUNT(chat.from_id) AS total'),
            DB::raw('MAX(chat.created_at) AS last_message_time') // Agregasi untuk sorting
        )
        ->where('chat.to_id', Auth::user()->id)
        ->groupBy('users.id', 'users.nama', 'users.foto_profile')
        ->orderBy('last_message_time', 'desc') // Urutkan berdasarkan waktu pesan terakhir
        ->get();

    return view('admin.chat.chat', compact('chat'));
}


public function detail_chat($id)
{
    // Update status pesan menjadi "on read"
    Chat::where('from_id', $id)->update([
        'status' => 'on read',
    ]);

    // Query untuk mendapatkan daftar chat
    $chat = Chat::join('users', 'users.id', '=', 'chat.from_id')
        ->select(
            'users.id',
            'users.nama',
            'users.foto_profile',
            DB::raw('COUNT(chat.from_id) AS total'),
            DB::raw('MAX(chat.created_at) AS last_message_time') // Tambahkan agregasi
        )
        ->where('chat.to_id', Auth::user()->id)
        ->groupBy('users.id', 'users.nama', 'users.foto_profile')
        ->orderBy('last_message_time', 'desc')
        ->get();

    // Query untuk pesan antara pengguna saat ini dan $id
    $pesan = Chat::where(function ($query) use ($id) {
        $query->where('to_id', $id)
              ->where('from_id', Auth::user()->id);
    })->orWhere(function ($query) use ($id) {
        $query->where('to_id', Auth::user()->id)
              ->where('from_id', $id);
    })->orderBy('created_at', 'asc')->get();

    // Dapatkan informasi user berdasarkan ID
    $nama_user = User::find($id);

    return view('admin.chat.chat_detail', compact('chat', 'pesan', 'id', 'nama_user'));
}

    public function send(Request $request)
    {
        Chat::create([
            'from_id'=>1,
            'to_id'=>$request->id_from,
            'pesan'=>$request->pesan,
            'status'=>'off read',
        ]);

        return back();
    }
}
