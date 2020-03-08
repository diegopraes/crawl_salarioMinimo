<?php

/**
* A class for web crawling.
*
*@author Diego Praes
*
*/
class CURL
{
    public $url;
    public $init;
    public $options;
    public $file;

    public function __construct($options)
    {
        $this->init = curl_init();  // initialization
        $this->options = $options;  // setting options
        $this->setOptions();
    }

    /**
    * Set option for cURL
    * @param string $option The cURL option
    * @param mixed $value The value for the option
    *
    */
    public function setOptions($option='', $value='', $manual=false)
    {
        if (!$manual) {
            curl_setopt_array($this->init, $this->options);
        } else {
            foreach ($this->options as $opt_k => $opt_v) {
                if ($opt_k == CURLOPT_URL) {
                    $this->url = $opt_v;
                }
                if ($option && $value) {
                    curl_setopt($this->init, $option, $value);
                } else {
                    curl_setopt($this->init, $opt_k, $opt_v);
                }
            }
        }
    }

    /**
    * Execute the cURL.
    * @param string $url The website URL.
    *
    */
    public function curlExecute($save=false, $method="get", $post=[])
    {
        try
        {
            if ($method == "post") {
                $this->setOptions(CURLOPT_POST, true, true);
                $this->setOptions(CURLOPT_PUT, true, true);
                $this->setOptions(CURLOPT_POSTFIELDS, $post, true);
                $data = curl_exec($this->init);
            } else {
                $data = curl_exec($this->init);
            }
            if ($save == true) {
                $this->curlExecuteSaveToFile();
            }
            if (!$data) {
                throw new Exception('No data return from cURL.');
            }
            $this->closeCurl();
            return $data;
        }
        catch (Exception $e)
        {
            $this->getErrors();
            throw $e;
        }
    }

    /**
    * Close the cURL.
    *
    */
    public function closeCurl()
    {
        curl_close($this->init);
    }

    /**
    * Save to a file
    *
    */
    public function curlExecuteSaveToFile()
    {
        $this->file = ROOT.'/public/views/result/raw/result.html';
        $file = fopen($this->file, "w");
        $this->setOptions(CURLOPT_FILE, $file, true);
        // execute the curl
        curl_exec($this->init);
        $this->closeCurl();
        fclose($file);
    }

    /**
    * Get errors.
    *
    */
    public function getErrors()
    {
        $responseCode = curl_getinfo($this->init, CURLINFO_HTTP_CODE);
        $download_length = curl_getinfo($this->init, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        if (curl_errno($this->init)) {
            print curl_error($this->init);
        } else {
            if (!$download_length) {
                $download_length = 0;
            }
            if ($responseCode == "200") echo "Sucessful request!";
            echo "download length: " . $download_length;
            $this->closeCurl();
        }
    }
}
