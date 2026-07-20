<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Borrow_Detail;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BorrowController extends Controller
{
    //
    public function pinjam() {
        $user_id = Auth::id();
        $queues = Queue::where('user_id', $user_id)->get();
        if($queues == null) {
            return Redirect::back();
        }else {
            $borrow = Borrow::create([
                'user_id' => $user_id,
                'borrow_code' => 'TRX-'. time(),
                'borrow_date' => now()->toDateString(),
                'dua_date' => now()->addDay(7)->toDateString(),
                'status' => 'dipinjam',
                'fine_amount' => 0
            ]);
            foreach($queues as $queue) {
                $book_id = Book::find($queue->book_id);
                Borrow_Detail::create([
                    'borrow_id' => $borrow->id,
                    'book_id' => $queue->book->id,
                    'qty' => $queue->amount
                ]);
                $book_id->update([
                    'stock' => $book_id->stock - $queue->amount
                ]);
                $queue->delete();
            }
            return Redirect::back();
        }
    }
    public function index_borrow() {
        $user = Auth::user();
        if($user->is_admin) {
            $borrows = Borrow::all();
        }else {
            $borrows = Borrow::where('user_id', Auth::id())->get();
        }
        return view('index_borrow', compact('borrows'));
    }
    public function show_borrow(Borrow $borrow) {
        $user = Auth::user();
        $user_id = Auth::id();
        if($user->is_admin || $borrow->user_id == $user_id) {
            return view('show_borrow', compact('borrow'));
        } else {
            return Redirect::back();
        }
    }
    public function kembalikan(Borrow $borrow) {
        $return_date = $borrow->return_date;
        if(now()->lessThanOrEqualTo($borrow->dua_date)) {
            $borrow->update([
                'return_date' => now()->toDateString()
            ]);
        }else {
            $hariIni = now()->startOfDay();
            $jumlahBuku = 0;
            foreach($borrow->borrow_details as $borrowDetail) {
                $jumlahBuku += $borrowDetail->qty;
            }
            $jumlahHariTerlmbat = $hariIni->diffInDays($borrow->dua_date);
            $fineAmount = abs($jumlahHariTerlmbat * 10000 * $jumlahBuku);
            $borrow->update([
                'return_date' => now()->toDateString(),
                'fine_amount' => $fineAmount
            ]);
        }
        return Redirect::back();
    }
    public function konfirmasi_kembalian(Borrow $borrow) {
        if(now()->lessThanOrEqualTo($borrow->dua_date)) {
            $borrow->update([
                'status' => 'dikembalikan'
            ]);
        }else {
            $borrow->update([
                'status' => 'pembayaran_denda'
            ]);
        }
        return Redirect::route('index_borrow');
    }
    // public function denda_pembayaran(Borrow $borrow) {
    //     $hariIni = now()->startOfDay(); // Menjadi 2026-07-02 00:00:00
    //     $jumlahHariTerlmbat = $hariIni->diffInDays($borrow->dua_date);
    //     $denda = abs($jumlahHariTerlmbat * 10000);
    //     $borrow->update([
    //         'status' => 'pembayaran_denda',
    //         'fine_amount' => $denda
    //     ]);
    //     return Redirect::back();
    // }
}
