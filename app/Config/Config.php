<?php

namespace PonyForm\Config;

use Dotenv\Dotenv;

class Config
{
    private readonly Dotenv $dotenv;

    public readonly bool $DEBUG;

    public function __construct(string $baseDir)
    {
        $this->dotenv = Dotenv::createImmutable($baseDir);
        $this->dotenv->safeLoad();

        $this->DEBUG = $this->parseBool('DEBUG');
    }

    private function parseBool(string $key)
    {
        static $TRUTHY_VALUES = ['1', 'true', 'on'];

        return isset($_ENV[$key]) && in_array(strtolower($_ENV[$key]), $TRUTHY_VALUES, true);
    }
}
