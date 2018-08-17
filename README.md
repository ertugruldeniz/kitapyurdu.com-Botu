Hakkında
====================

kitapyurdu.com üzerinden son 10 yıl içerisinde en çok satılan kitapları çeken php ile bot hazırladım. Dileyenler alıp kendileri de geliştirmeye devam edebilirler.

Şuan da kitapları çekmekte ve detayına tıklandığında kitabın özetini ve kitap bilgilerini göstermektedir.

Projeyi incelemek için index.php içerisindeki php kodlarına ve kitapdetay.php içerisindeki kodlara bakabilirisiniz.

Geliştirmek isteyenler daha detaylı bir şekilde kategorize ederek tüm kitapşarı çekebilirler.

Tema
====================
Tema olarak mdboostrap.com şablonundan yararlanılmıştır. Projeyi geliştirmek isteyenler arayüz açısından boostraptan yararlanabilirler.

Documentation: https://mdbootstrap.com/

Görünüm
====================
http://ertugruldeniz.com/kitap/ adresine giderek projeyi inceleyebilirsiniz.



```php

function get_web_page( $url )
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header = $content;
        return $header;
    }

```
