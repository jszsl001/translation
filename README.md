# google_translation
google_translation_api


## Quick Start


### 安装

```shell
composer require jszsl001/google_translation
```

### 使用
```php
use jszsl001\GoogleTranslation\Translation;

$text = 'hello world';

$translation = new Translation();
$result = $translation-> translate($text, 'en', 'zh-CN');

var_dump($result);
```

## Demo

```php
<?php
require_once "vendor/autoload.php";

use jszsl001\GoogleTranslation\Translation;

$text = <<<EOT
    The world is a vast and beautiful place, full of wonder and excitement. There are so many things to see and do, and so many people to meet. We can travel to different countries, learn new languages, and experience different cultures. We can try new foods, meet new people, and make new friends. We can learn new things, expand our horizons, and challenge ourselves. The possibilities are endless.
    So what are you waiting for? Get out there and explore the world! There's a whole world waiting for you to discover.
    EOT;


$translation = new Translation();
$result = $translation
//    -> setChannel('google') // 可选 google, microsoft
//    -> setProxy('http://127.0.0.1:1081') // 可选
    -> translate($text, 'en', 'zh-CN');

var_dump($result);

```
