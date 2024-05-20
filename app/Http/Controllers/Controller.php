<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     *  Controller response to standardized client formatted with JSON.
     *
     * @param array|object $data Is the response that will be given to the client.
     * @param string $message Is the message that will be given to the client as response.
     * @param string $code Is the HTTP code status that will given to the client.
     *
     * @return object JSON
     */
    public function response(array|object $data, string $message, $code = 200)
    {
        if(is_string($code) || $code == 0) $code = 500;

        return response()->json([
            'data' => $data,
            'message' => $message
        ], $code);
    }


    /**
     *  Helps generate a page to be delivered to the client.
     *
     * @param array $data  It is the array that contains all the records to be paged.
     * @param string $perpage  Is the number of results you want per page.
     * @param string $page  Is the current page where the client is located.
     * @param string $count  It's the total number of results.
     *
     * @return object Returns the pagination with the parameters From, To, How many results, Current page, etc.
     */
    public function pagination($data, $perpage, $page, $count = 0)
    {
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data??[], $count??0, $perpage??50, $page??1);
        return $paginator;
    }
}
