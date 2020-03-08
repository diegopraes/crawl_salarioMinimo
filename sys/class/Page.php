<?php

/**
 * Class to return HTML pages.
 *
 */
class Page
{
    /**
     * The request sent to index.php.
     */
    public $_req;

    public function __construct()
    {
        $this->$_req = $req;
    }

    /**
     * Construct the page based on request.
     */
    public function constructPage(string $req)
    {
        switch($req) {
            case 'index':
                return;
                break;
            case 'buscar':
                $html = $this->getSearchPage();
                break;
            case 'resultados':
                $html = $this->getResultPage();
                break;
            case 'array':
                $html = $this->getArrayPage();
                break;
        }
        return $html;
    }

    /**
     * Processa a busca.
     */
    public function getSearchPage()
    {
        include ROOT.'/sys/process/processarBusca.php';
    }

    /**
     * Gera uma tabela com os resultados.
     */
    public function getResultPage()
    {
        include ROOT.'/public/views/result/resultados.html';
    }

    /**
     * Gera um array.
     */
    public function getArrayPage()
    {
        include ROOT.'/public/views/result/array.php';
    }

}
