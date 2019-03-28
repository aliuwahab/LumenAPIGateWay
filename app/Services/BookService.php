<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 28/03/2019
 * Time: 12:34 PM
 */

namespace App\Services;


use App\Traits\ConsumesExternalService;

class BookService
{

    use ConsumesExternalService;

    /**
     * The base uri to consume the book service
     * @var string
     */
    public $baseUri;

    /**
     * The secret key for the book micro service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }



    /**
     * Obtain the full list of authors from the author service
     * @return string
     */
    public function obtainBooks(){
        return $this->performRequest('GET','/books');
    }


    /**
     * Create a single author
     * @param $data
     * @return string
     */
    public function createBook($data){

        return $this->performRequest('POST','/books', $data);
    }


    /**
     * @param $author
     * @return string
     */
    public function obtainOneBook($book){
        return $this->performRequest('GET',"/books/{$book}");
    }


    /**
     * @param $data
     * @param $author
     * @return string
     */
    public function editBook($data, $book){
        return $this->performRequest('PUT',"/books/{$book}", $data);
    }

    /**
     * Remove a single author
     * @param $author
     * @return string
     */
    public function deleteOneBook($book){
        return $this->performRequest('GET',"/books/{$book}");
    }







}
