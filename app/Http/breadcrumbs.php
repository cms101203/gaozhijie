<?php
$file_path = storage_path('framework') . '/Breadcrumbs.php';
if (file_exists($file_path)) {
    include $file_path;
} else {
    Event::fire(new \App\Events\permChangeEvent());
}