<?php

namespace PonyForm\Core\Internal;

use PonyForm\PluginContract\QuestionTypePluginInterface;

class QuestionTypePluginRegistry
{
    private array $plugins = [];

    public function registerPlugin(string $type, QuestionTypePluginInterface $plugin)
    {
        $this->plugins[$type] = $plugin;
    }

    public function getPlugin(string $type): QuestionTypePluginInterface | null
    {
        return $this->plugins[$type] ?? null;
    }
}
