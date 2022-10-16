<?php

namespace PonyForm\Website\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class WebsiteController
{
    public function viewStart(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }
}
