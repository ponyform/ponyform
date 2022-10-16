<?php

namespace PonyForm\TextFieldPlugin;

use PonyForm\PluginContract\QuestionTypePluginInterface;

class TextFieldPlugin implements QuestionTypePluginInterface
{
    public function getType(): string
    {
        return 'text';
    }

    public function getTemplateDirectory(): string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'templates';
    }

    public function getTemplateFilename(): string
    {
        return 'text.twig';
    }

    public function getStyleSheet(): string
    {
        return 'text.css';
    }
}
