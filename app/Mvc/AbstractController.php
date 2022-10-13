<?php

namespace PonyForm\Mvc;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{
    abstract public function __invoke(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface;
}
