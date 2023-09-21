<?php
declare(strict_types = 1);

namespace App\Helpers;

function view($template, $data = []) {
    extract($data);
    include 'app/Views/' . $template . '.php';
}