<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        return view('admin.dashboard', ['book_count' => $bookCount, 'category_count' => $categoryCount, 'user_count' => $userCount]);
    }
    public function categorys()
    {
       $category = Category::all();
       return view('admin.category',['category' => $category]);
    }
    public function users()
    {
      $users = User::where('roles_id', 2)->where('status','active')->get();
       return view('admin.user',['user' => $users]);
    }

    public function userRegistered(){
      $usersRegistered = User::where('roles_id',2)->where('status','inactive')->get();
      return view('admin.user-registered',['usersRegistered'=>$usersRegistered]);
    }

    public function usersDetail($slug){
      $user = User::where('slug', $slug)->first();
      return view('admin.user-detail' ,['user' => $user]);
    }

    public function usersAprove($slug){
      $user = User::where('slug', $slug)->first();
      $user->status = 'active';
      $user->save();
      return redirect('user-detail/'.$slug)->with('status','User Aprove Succesfuly');
    }

    public function usersBan($slug){
      $user = User::where('slug',$slug)->first();
      $user->delete();
      return redirect('users')->with('status','Users delated succesfuly');
    }

    public function usersBanned(){
      $userBanned = User::onlyTrashed()->get();
      return view('admin.user-banned',['userBanned' => $userBanned]);
    }

    public function usersRestore($slug){
      $user = User::withTrashed()->where('slug',$slug)->first();
      $user->restore();
      return redirect('users')->with('status','User Restore Succesfuly');
    }

    public function books()
    {
       $book = Book::all();
       return view('admin.book', ['book' => $book]);

    }

    public function booksAdd()
    {
      $categories = Category::all();
      return view('admin.book-add',['categories' => $categories]);
    }

    public function booksStore(Request $request)
    {
         $validated = $request->validate([
               'book_code' => 'required|unique:books',
               'title' => 'required',
         ]);

         $newName = '';
         if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover',$newName);
         }

         $request['cover'] = $newName;
         $book = Book::create($request->all());
         $book->categories()->sync($request->categories);
         return redirect('book')->with('status', 'Book Added Successfully');
    }

    public function bookEdit($slug)
    {
      $book = Book::where('slug',$slug)->first();
      $categories = Category::all();
      return view('admin.book-edit',['book' => $book , 'categories' => $categories]);
    }

    public function bookUpdate(Request $request,$slug){
      if($request->file('image')){
         $extension = $request->file('image')->getClientOriginalExtension();
         $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
         $request->file('image')->storeAs('cover',$newName);
         $request['cover'] = $newName;
      }
      $book = Book::where('slug',$slug)->first();
      $book->update($request->all());
      if($request->categories){
         $book->categories()->sync($request->categories);
      }
      return redirect('book')->with('status','Book Updated Succesfully');;
    }

    public function booksDestroy($slug){
      $books = Book::where('slug',$slug)->first();
      $books->delate();
      return redirect('admin.book')->with('status','Book delated succesfuly');
    }

    public function rentlogs()
    {
       return view('admin.rentlog');
    }

    public function categoryAdd()
    {
      return view('admin.categoryadd');
    }

    public function categoryStore(Request $request)
    {
      // 
      $validated = $request->validate([
         'name' => 'required|unique:categories',
     ]);

      // memaksukan data ke database
      $category = Category::create($request->all());
      return redirect('category')->with('status', 'Category Added Successfully');
    }

    public function categoryEdit($slug)
    {
      $category = Category::where('slug', $slug)->first();
      return view('admin.category-edit', ['category' => $category]);
    }
    
    public function categoryUpdate(Request $request, $slug)
    {
         // 
         $validated = $request->validate([
            'name' => 'required|unique:categories',
      ]);
      $category = Category::where('slug', $slug)->first();
      $category->slug = null;
      $category->update($request->all());
      return redirect('category')->with('status', 'Category Updated Successfully');
    }

    public function categoryDestroy($slug)
    {
      $category = Category::where('slug', $slug)->first();
      $category->delete();
      return redirect('category')->with('status', 'Category Deleted Successfully');
    }

}