<?php

namespace App\Http\Controllers;


use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the authors micro service
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     * AuthorController constructor.
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index(){

        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * @param Request $request
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function store(Request $request){

        return $this->successResponse($this->authorService->createAuthor($request->all()),Response::HTTP_CREATED);
    }


    /**
     * @param $author
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function show($author){

        return $this->successResponse($this->authorService->obtainOneAuthor($author));

    }

    /**
     * @param Request $request
     * @param $author
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function update(Request $request, $author){
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }


    /**
     * @param $author
     * @return JsonResponse
     */
    public function destroy($author){
        return $this->successResponse($this->authorService->deleteOneAuthor($author));
    }



}
