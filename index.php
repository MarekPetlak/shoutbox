<?php

require_once 'TemplateClass.php';

$template = new TemplateClass();
echo $template->renderTemplate('template.php', []);
