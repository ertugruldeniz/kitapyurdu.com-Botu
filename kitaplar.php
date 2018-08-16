<?php 
 error_reporting(0);
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

$array[] = array();

$array1_img[] = array();

$array_yazar[] = array();

$array_fiyat[] = array();

for ($i=1; $i <= 5; $i++) { 
	
	$url="https://www.kitapyurdu.com/index.php?route=product/bestseller_ten_year&page=$i";
	$c=get_web_page($url);

	$regex='@<div class="name ellipsis"><a itemprop="url" href="(.*?)" ><span  itemprop="name">(.*?)</span></a></div>@si';

	$img_regex='@<img itemprop="image"  src="(.*?)" alt="(.*?)" />@si';

	$yazar ='@<div class="author compact ellipsis"><a class="alt" href="(.*?)">  (.*?)</a></div>@si';


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



for ($i=1; $i <6 ; $i++) {
	for ($j=0; $j <20 ; $j++) { 
	 		$title=$array[$i][0][$j];

	 		$link=$array[$i][1][$j];

	 		$img=$array1_img[$i][1][$j];

	 		$yazar=$array_yazar[$i][2][$j];

	 		if($j!="19"){
	 			$fiyat=$array_fiyat[$i][1][$j];
	 		}

	 		echo "<br>" . $title.$link;

	 		echo "<img width='230' src='$img'>";

	 		echo $yazar;

	 		echo "Kitap Fiyatı".$fiyat;


	 } 
}


 ?>


