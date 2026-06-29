<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class QueueController extends Controller
{
    //
    public function add_to_queue(Book $book, Request $request) {
        $user_id = Auth::id();
        $book_id = $book->id;
        $existing_queue = Queue::where('user_id', $user_id)
            ->where('book_id', $book_id)->first();
        if($existing_queue == null) {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . $book->stock,
            ]);
            Queue::create([
                'user_id' => $user_id,
                'book_id' => $book_id,
                'amount' => $request->amount
            ]);
        } else {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . $book->stock - $existing_queue->amount
            ]);
            $existing_queue->update([
                'amount' => $request->amount + $existing_queue->amount
            ]);
        }
        return Redirect::back();
    }
    public function index_queue() {
        $user_id = Auth::id();
        $queues = Queue::where('user_id', $user_id)->get();
        return view('index_queue', compact('queues'));
    }
    public function update_queue(Request $request, Queue $queue) {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $queue->book->stock,
        ]);
        $queue->update([
            'amount' => $request->amount
        ]);
        return Redirect::back();
    }
    public function delete_queue(Queue $queue) {
        $queue->delete();
        return Redirect::back();
    }
}
