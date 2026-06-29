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
                'borrow_date' => now()->toDateString(),
                'dua_date' => now()->addDay(7)->toDateString(),
                'borrow_code' => 'TRX-' . time(),
                'status' => 'dipinjam',
                'fine_amount' => 0
            ]);
            foreach($queues as $queue) {
                $book_id = Book::find($queue->book_id);
                Borrow_Detail::create([
                    'borrow_id' => $borrow->id,
                    'book_id' => $queue->book->id,
                    'qty' => $queue->amount,
                ]);
                $book_id->update([
                    'stock' => $book_id->stock - $queue->amount
                ]);
                $queue->delete();
            }
            return Redirect::back();
        }
    }
}
