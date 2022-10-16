<?php

namespace PonyForm\Website\Http;

use Slim\App;

class SlimHttpAdapter
{
    public function register(App $app)
    {
        $websiteController = new WebsiteController();

        $app->get("/", fn ($req, $res) => $websiteController->viewStart($req, $res));
    }
}
