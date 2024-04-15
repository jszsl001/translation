<?php

namespace jszsl001\GoogleTranslation;

use GuzzleHttp\Client;

class Translation
{

    protected $url = "https://translate.googleapis.com/translate_a/single";

    protected $text = "";
    protected $targetLanguage = "zh-CN"; // Chinese (Simplified)
    protected $sourceLanguage = "en";
    protected $options = [];

    /**
     * 翻译
     */
    public function translate()
    {
        $param = [];
        $param['client'] = 'gtx';
        $param['dt'] = 't';
        $param['tl'] = $this -> targetLanguage;
        $param['sl'] = $this -> sourceLanguage;
        $param['q'] = $this -> text;

        $url = $this -> url . "?" . http_build_query($param);

        $client = new Client();
        $response = $client -> request('GET', $url, $this -> options);
        $contents = json_decode($response -> getBody() -> getContents(), true)[0];
        $result = [];
        foreach ($contents as $item) {
            $result[] = [
                'source' => $item[1],
                'target' => $item[0]
            ];
        }

        return $result;
    }


    public function setText($text)
    {
        $this -> text = $text;
        return $this;
    }

    public function setTargetLanguage($tl = "zh-CN")
    {
        $this -> targetLanguage = $tl;
        return $this;
    }

    public function setSourceLanguage($sl = "en")
    {
        $this -> sourceLanguage = $sl;
        return $this;
    }

    public function setProxy($proxy = '')
    {
        $this -> options['proxy'] = $proxy;
        return $this;
    }

}


