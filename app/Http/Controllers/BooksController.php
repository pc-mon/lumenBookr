<?php
namespace App\Http\Controllers;
/**
* Class BooksController
* @package App\Http\Controllers
*/
use App\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
class BooksController
{
  /**
  * GET /books
  * @return array
  */
  public function index()
  {
    return Book::all();
  }
  public function show($id)
  {
    try {
      return Book::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return response()->json([
          'error' => [
          'message' => 'Book not found'
        ]
      ], 404);
    }
  }

  public function store(Request $request)
  {
    try {
      $book = Book::create($request->all());
    } catch (\Exception $e) {
      dd(get_class($e));
    }
    return response()->json(['created' => true], 201);
  }
}
