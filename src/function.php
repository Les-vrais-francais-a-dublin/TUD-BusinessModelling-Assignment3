<?php

function parseHtml($content, array $replace)
{
    foreach ($replace as $key => $value) {
        $content = str_replace($key, $value, $content);
    }
    return $content;
}

function getHtml($name)
{
    $html = file_get_contents(__DIR__ . '/../public/html/' . $name . '.html');
    return ($html);
}

function fillPage($body)
{
    $html = file_get_contents(__DIR__ . '/../public/html/template.html');
    $html = str_replace("#body", $body, $html);
    return ($html);
}
