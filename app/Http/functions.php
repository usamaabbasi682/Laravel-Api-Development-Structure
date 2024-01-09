<?php

if (!function_exists('slugify')) {
    function slugify($text): array|string|null
    {
        // Convert to lowercase, replace spaces with hyphens, and remove unwanted characters
        return preg_replace('/[^\w\s-]/', '', str_replace(' ', '-', strtolower($text)));
    }
}
