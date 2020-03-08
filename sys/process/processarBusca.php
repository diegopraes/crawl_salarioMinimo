<?php

session_start();

include ROOT.'/sys/lib/functions.php';

$url = 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm';

// Settings for cURL
$options =[
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1'
];

// new CURL object
$crawl = new cURL($options);

$html = $crawl->curlExecute();

$data = processHTML($html);

if ($data !== NULL) {
    echo '<h1 id="msg">Clique em resultados!</h1>';
    array_shift($data);
    $_SESSION['array'] = $data;
}


if (USE_MEMCACHED) {
    // Store historical data in memcached
    global $memcacheD;
    $results = $memcacheD->get($index);
    if ($results) {
    } else {
        $memcacheD->set($index, $hist_data);
        echo "Added to memory cache.<br>";
    }
}

// Gerar tabela
$tableHeader =<<<TABLE
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Vigência</th>
                <th>Valor Mensal</th>
                <th>Valor Diário</th>
                <th>Valor Hora</th>
                <th>Norma Legal</th>
                <th>D.O.U</th>
            </tr>
        </thead>
        <tbody>
TABLE;

foreach ($data as $hd) {
    $row = '<tr>';
    foreach ($hd as $d) {
        $row .= "<td>{$d}</td>";
    }
    $row .= '</tr>';
    $tableData[] = $row;
}

$tdAll = '';
foreach ($tableData as $td) {
    $tdAll = $tdAll.$td;
}
$table = $tableHeader.$tdAll;

// Write to results.
$file = ROOT.'/public/views/result/resultados.html';
$file = fopen($file, "w");
fwrite($file, $table);
fclose($file);

// Write array to results.
$file = ROOT.'/public/views/result/array.html';
$file = fopen($file, "w");
fwrite($file, $data);
fclose($file);
