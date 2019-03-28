<?php

namespace App\Http\Controllers;

use App\Book;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the books micro service
     * @var BookService
     */
    public $bookService;


    /**
     * The service to consume the author micro service
     * @var AuthorService
     */
    public $authorService;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;

    }


    /**
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index(){

        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * @param Request $request
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function store(Request $request){

       $this->successResponse($this->authorService->obtainOneAuthor($request->author_id));
        return $this->successResponse($this->bookService->createBook($request->all()),Response::HTTP_CREATED);
    }


    /**
     * @param $author
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function show($book){

        return $this->successResponse($this->bookService->obtainOneBook($book));

    }

    /**
     * @param Request $request
     * @param $author
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function update(Request $request, $book){
        return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }


    /**
     * @param $book
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy($book){
        return $this->successResponse($this->bookService ->deleteOneBook($book));
    }




}
