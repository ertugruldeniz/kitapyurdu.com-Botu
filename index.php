   
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kitap Yurdu En Çok Satılan Kitaplar</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

    <style>


					    @media only screen and (max-width: 600px) {

					    body {
					        background-color: rgba(76, 175, 80, 0.1);
					    }

					    .xt{
			         	     min-width: 100%;max-width: 100%; margin-bottom: 20px;
		      	        }  

		      	        .xc{
				      	        	padding:10px; max-height: 300px; width: 250px;margin: auto;
				      	    }


					  }

		                 @media only screen and (min-width: 600px) {
							  .xt{
					         	min-width: 22%;max-width: 22%; min-height:450px;max-height:450px; margin-bottom:60px;margin-left: 30px;
				      	        }  


				      	        .xc{
				      	        	    margin: auto;
									    padding: 28px;
									    max-height: 300px;
									    width: 236px;
				      	        }
							}
					    	
			
    </style>
</head>



<body>

    <!-- Start your project here-->

<header>

 <h2 class="h1-responsive font-weight-bold my-1 text-center">  <i class="fa fa-book fa-1x black-text"> Son 10 Yılın En Çok Satan Kitapları.</i></h2>
 <hr class="my-3">

<!-- Section: Personal card -->
<section class="my-5 mx-5">

  <!-- Grid row -->
  <div class="row">




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


    
        for ($i=1; $i <6 ; $i++) {
            for ($j=0; $j <20 ; $j++) { 
                    $title=$array[$i][2][$j];

                    $link=$array[$i][1][$j];

                    $img=$array1_img[$i][1][$j];

                    $yazar=$array_yazar[$i][2][$j];

                    if($j!="19"){
                        $fiyat=$array_fiyat[$i][1][$j];
                    }


                    ?>


        


                        <!-- Grid column -->
                            <div class="xt"  >

                              <!-- Card -->
                              <div class="card card-personal">

                                <!-- Card image-->
                                <img class="card-img-top xc"  src="<?=$img;?>" alt="Card image cap">
                                <!-- Card image-->

                                <!-- Card content -->
                                <div class="card-body">
                                  <!-- Title-->
                                  <a href="kitapdetay.php?link=<?=base64_encode($link)?>&resim=<?=$img;?>"><h4 class="card-title title-one"><?=mb_substr($title,0,50); ?></h4></a> 
                                  <p class="card-meta">Yazar: <?=mb_substr($yazar,0,100);?></p>
                                  <hr>
                                  <a class="card-meta"><span><i class="fa fa-angellist"></i> ₺ <?php echo $fiyat; ?> </span></a>
                                </div>
                                <!-- Card content -->

                              </div>
                              <!-- Card -->

                            </div>
                            <!-- Grid column -->

                  
<?php 

             } 
        }



     ?>




  </div>
  <!-- Grid row -->

</section>
<!-- Section: Personal card -->

 <hr class="my-3">

</header>
<!--Main Navigation-->


    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
