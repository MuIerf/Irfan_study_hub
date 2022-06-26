<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class BooksController extends Controller
{
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', [
            'books' => $books
        ]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name', 'harga'
        ]);

        Book::create($data);
        return redirect()->route('books.index')
            ->with('success_message', 'Berhasil menambah buku baru');
    }
    public function edit($id)
    {
        $book = Book::find($id);
        if (!$book) return redirect()->route('books.index')
            ->with('error_message', 'book dengan id' . $id . ' tidak ditemukan');
        return view('books.edit', [
            'book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->name = $request->name;
        $book->harga = $request->harga;
        $book->save();
        return redirect()->route('books.index')
            ->with('success_message', 'Berhasil mengubah book');
    }
    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book) $book->delete();
        return redirect()->route('books.index')
            ->with('success_message', 'Berhasil menghapus user');
    }

}
