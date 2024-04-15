<?php

namespace jszsl001\Translation\channel;

use GuzzleHttp\Client;

class Microsoft extends BaseChannel
{
    protected $url = "https://api-edge.cognitive.microsofttranslator.com/translate";

    public function translate()
    {
        // url参数
        $param = [];
        $param['api-version'] = '3.0';
        $param['from'] = $this -> sourceLanguage;
        $param['to'] = $this -> targetLanguage;
        $param['includeSentenceLength'] = 'true';
        $url = $this -> url . "?" . http_build_query($param);

        // form data
        $data = [];
        $data[] = ['Text' => $this -> text];
        $data = json_encode($data);
        $this -> options['body'] = $data;

        // header
        $authCode = $this -> getAuthCode();
        $this -> options['headers'] = [
            'Authorization' => $authCode,
            'Content-Type' => 'application/json',
        ];
        $client = new Client();
        $response = $client -> request('POST', $url, $this -> options);
        $contents = json_decode($response -> getBody() -> getContents(), true)[0]['translations'][0];


        $subsection = [];
        $full_target = '';

        $sourceText = $this -> text;
        $targetText = $contents['text'];

        foreach ($contents['sentLen']['srcSentLen'] as $k => $length) {

            $source = mb_substr($sourceText, 0, $length, 'utf8');
            $target = mb_substr($targetText, 0, $contents['sentLen']['transSentLen'][$k], 'utf8');

            $subsection[] = [
                'source' => $source,
                'target' => $target,
            ];
            $sourceText = str_replace($source, '', $sourceText);
            $targetText = str_replace($target, '', $targetText);

            $full_target .= $target;
        }

        $result['subsection'] = $subsection;
        $result['full_target'] = $full_target;
        return $result;
    }


    private function getAuthCode()
    {
        $url = 'https://edge.microsoft.com/translate/auth';
        $client = new Client();
        $response = $client -> request('GET', $url, $this -> options);
        $authCode = $response -> getBody() -> getContents();

        // TODO 缓存authCode
        return $authCode;
    }


}