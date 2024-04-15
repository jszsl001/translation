<?php

namespace jszsl001\Translation\channel;

use GuzzleHttp\Client;

class Google extends BaseChannel
{
    protected $url = "https://translate.googleapis.com/translate_a/single";

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
        $subsection = [];
        $full_target = '';
        foreach ($contents as $item) {
            $subsection[] = [
                'source' => $item[1],
                'target' => $item[0]
            ];
            $full_target .= $item[0];
        }

        $result['subsection'] = $subsection;
        $result['full_target'] = $full_target;

        return $result;
    }


}