<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 28/03/2019
 * Time: 12:34 PM
 */

namespace App\Services;


use App\Traits\ConsumesExternalService;

class AuthorService
{

    use ConsumesExternalService;

    /**
     * The base uri to consume the author service
     * @var string
     */
    public $baseUri;

    /**
     * The secret key for the author micro service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }


    /**
     * Obtain the full list of authors from the author service
     * @return string
     */
    public function obtainAuthors(){
        return $this->performRequest('GET','/authors');
    }


    /**
     * Create a single author
     * @param $data
     * @return string
     */
    public function createAuthor($data){

        return $this->performRequest('POST','/authors', $data);
    }


    /**
     * @param $author
     * @return string
     */
    public function obtainOneAuthor($author){
        return $this->performRequest('GET',"/authors/{$author}");
    }


    /**
     * @param $data
     * @param $author
     * @return string
     */
    public function editAuthor($data, $author){
        return $this->performRequest('PUT',"/authors/{$author}", $data);
    }

    /**
     * Remove a single author
     * @param $author
     * @return string
     */
    public function deleteOneAuthor($author){
        return $this->performRequest('GET',"/authors/{$author}");
    }




}
