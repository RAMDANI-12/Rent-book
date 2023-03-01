<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RentLogController extends Controller
{
    public function add(){
        $user = User::where('id','!=',1)->where('status','!=','incative')->get();
        $books = Book::all();
        return view('admin.rentlog-add',['user' => $user , 'books' => $books]);
    }

    public function store(Request $request){
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();
        $book = Book::findOrFail($request->book_id)->only('status');

        //cek status buku klo g stok
        if($book['status'] != 'stok' ){
            Session::flash('message','Cannot rent, books is not availabel');
            Session::flash('alert-class','alert-danger');
            return redirect('rentlog-add');
        }
        //kalo stok
        RentLogs::create($request->all());
        
    }
}
