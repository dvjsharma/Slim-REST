<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class Authenticate {
    private $session; 
    public function __construct($session){
        $this->session = $session;
    }

    public function __invoke(Request $request, RequestHandler $handler){
        if ($this->session->exists('username')){
            $response = $handler->handle($request);
            return $response;
        }
        else{
            return $handler->handle($request)->withRedirect('/login');
        }
    }
}