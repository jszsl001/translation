<?php

namespace jszsl001\Translation;

use jszsl001\Translation\channel\Google;
use jszsl001\Translation\channel\Microsoft;

class Translation
{

    protected $proxy;
    protected $channel;

    public function translate($text, $sl = 'en', $tl = 'zh-CN')
    {
        $channelObj = $this -> getChannelObj();
        $channelObj -> setSourceLanguage($sl);
        $channelObj -> setTargetLanguage($tl);
        $channelObj -> setProxy($this -> proxy);
        $channelObj -> setText($text);
        $result = $channelObj -> translate();
        return $result;
    }


    public function setChannel($channel = 'google')
    {
        $this -> channel = $channel;
        return $this;
    }

    public function setProxy($proxy = '')
    {
        $this -> proxy = $proxy;
        return $this;
    }


    private function getChannelObj()
    {
        switch ($this -> channel) {
            case 'google':
                $channelObj = new Google();
                break;
            case  'microsoft':
                $channelObj = new Microsoft();
                break;
            // TODO ...

            default:
                $channelObj = new Microsoft();
        }
        return $channelObj;
    }

}


