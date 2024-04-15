<?php
require_once "vendor/autoload.php";

use jszsl001\GoogleTranslation\Translation;

$text = <<<EOT
    The world is a vast and beautiful place, full of wonder and excitement. There are so many things to see and do, and so many people to meet. We can travel to different countries, learn new languages, and experience different cultures. We can try new foods, meet new people, and make new friends. We can learn new things, expand our horizons, and challenge ourselves. The possibilities are endless.
    So what are you waiting for? Get out there and explore the world! There's a whole world waiting for you to discover.
    EOT;


$translation = new Translation();
$result = $translation
    -> setText($text) // 待翻译的文本
    -> setSourceLanguage('en') // 源语言,默认英语: en
    -> setTargetLanguage('zh-CN') // 翻译目标语言, 默认中文简体 : zh-CN
    -> setProxy('http://127.0.0.1:1081') // 配置http代理
    -> translate();

var_dump($result);