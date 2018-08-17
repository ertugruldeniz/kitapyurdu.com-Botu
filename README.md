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



Kullanımı
====================
Aşağıda bulunan kod içerisinde url adresini vererek hangi adresten veri çekeceğimizi söylüyoruz. url sonunda bulunan $i parametresi ile kaç adet sayfa döneceğimizi belirtiyoruz. Kitapyurdum.com üzerinde başka bir linkten veri çekmek isterseniz url linki ile değiştirebilirsiniz. 

Örneğin bu linkten veri çekmek için $url=https://www.kitapyurdu.com/index.php?route=product/best_sellers&list_id=1&filter_in_stock=1&filter_in_stock=1&page=1
Linkin sonunda bulunan page=$i ile değiştirerek, kaç adet sayfa çekilmesi gerektiğini belirliyoruz.

```php

for ($i=1; $i <= 5; $i++) { 
    
    $url="https://www.kitapyurdu.com/index.php?route=product/category&path=33&filter_in_stock=1&page=$i";
    $c=get_web_page($url);

    $regex='@<div class="name ellipsis"><a itemprop="url" href="(.*?)" ><span  itemprop="name">(.*?)</span></a></div>@si';

    $img_regex='@<img itemprop="image"  src="(.*?)" alt="(.*?)" />@si';

    $yazar ='@<div class="author compact ellipsis"><a class="alt" href="(.*?)">(.*?)</a></div>@si';


    $fiyat='@<div class="price-new "><span class="text">Kitapyurdu Fiyatı:</span>&nbsp;&nbsp;<span class="value"><span class="TL"></span>(.*?)</span></div>@si';

    preg_match_all($img_regex,$c,$img);  //Resimleri çek
    preg_match_all($regex,$c,$new);      //Kitap isimlerini çek
    preg_match_all($yazar,$c,$yazar_title);  //Yazar adını çek
    preg_match_all($fiyat,$c,$fiyat);  //Fiyatları çek


    array_push($array, $new);
    array_push($array1_img, $img);
    array_push($array_yazar, $yazar_title);
    array_push($array_fiyat, $fiyat);

}

```


For döngüsüne verilen sayı kadar veri döndürür. Ekrana verileri bastırırken aşağıda bulunan koddaki $i değişkeni sınırını yukarıdaki döngüde verilen üst sınırdan 1 fazla yapıyoruz. Bu şekilde tüm sayfa ve kategoriler içerinde bulunan kitapları çekebilirsiniz.

```php     //index.php içerisnde bulunan kod
     for ($i=1; $i <6 ; $i++) {
            for ($j=0; $j <20 ; $j++) { 
                    $title=$array[$i][2][$j];

                    $link=$array[$i][1][$j];

                    $img=$array1_img[$i][1][$j];

                    $yazar=$array_yazar[$i][2][$j];

                    if($j!="19"){
                        $fiyat=$array_fiyat[$i][1][$j];
                    }


                  //Veriler burada ekrana basılacak.

          } 
        }



     ?>
     ```
