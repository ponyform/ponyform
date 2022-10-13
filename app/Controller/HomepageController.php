<?php

namespace PonyForm\Controller;

use PonyForm\Mvc\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomepageController extends AbstractController
{
    public function __invoke(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write("Hello world!");
        return $res;
    }
}
