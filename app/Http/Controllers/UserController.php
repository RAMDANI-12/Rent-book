<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function book(Request $request){

        $categories = Category::all();
        if($request->category || $request->title){
            $books = Book::where('title', 'like' , '%'. $request->title.'%')->orWhereHas('categories',function($q) use($request){
                $q->where('categories.id',$request->category);
            })->get();
        }else{
            $books = Book::all();
        }
        return view('user.book',['books' => $books , 'categories' => $categories]);
    }
}
