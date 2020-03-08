<?php

function processHTML($html) {
    $doc = new DOMDocument();
    $doc->loadHTML($html);

    $XPath = new DOMXPath($doc);
    $td = $XPath->query('//div/table/tbody/tr/td');

    // Gerar array
    $data = [];
    $temp = [];
    $j = 1;
    foreach ($td as $t) {
        $value = trim($t->nodeValue);
        switch ($j) {
            case 1:
                $temp['vigencia'] = $value;
                break;
            case 2:
                $temp['valor_mensal'] = $value;
                break;
            case 3:
                $temp['valor_diario'] = $value;
                break;
            case 4:
                $temp['valor_hora'] = $value;
                break;
            case 5:
                $temp['norma_legal'] = $value;
                break;
            case 6:
                $temp['dou'] = $value;
                break;
        }
        $j++;
        if ($j === 7) {
            $data[] = $temp;
            $j = 1;
        }
    }

    return $data;
}


?>
