<?php

include '../sys/core/init.php';

$requests = [
    'index',
    'buscar',
    'resultados',
    'array',
];

$page = new Page();

if (isset($_GET['req'])) {
    if (in_array($_GET['req'], $requests)) {
        $_req = (string) $_GET['req'];
    }
} else {
    $_req = 'index';
}

ob_start();

$page_title = 'Diego Praes ';
$css_files = array(
    'busca.css'
);
include ROOT.'/public/views/common/header.php';

$html = $page->constructPage($_req);

include ROOT.'/public/views/common/footer.php';

$output = ob_get_contents();
$output = $output.$html;

ob_clean();

echo $output;
