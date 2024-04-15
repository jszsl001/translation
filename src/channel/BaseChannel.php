<?php

namespace jszsl001\Translation\channel;

class BaseChannel
{

    protected $text = "";
    protected $targetLanguage = "zh-CN"; // Chinese (Simplified)
    protected $sourceLanguage = "en";
    protected $options = [];


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