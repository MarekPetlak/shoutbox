<?php

class TemplateClass
{
    public function renderTemplate(string $templatePath, array $args = [])
    {
        extract($args);
        ob_start();
        require $templatePath;
        return ob_get_clean();
    }
}
