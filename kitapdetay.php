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

     $url=base64_decode($_GET['link']);
     $c=get_web_page($url);

     $baslik='@<h1 itemprop="name" class="product-heading">(.*?)</h1>@si';
     preg_match_all($baslik, $c, $title);
     
     //$yazar='@<span itemprop="name"> (.*?)</span>@si';
     //preg_match_all($yazar, $c, $author);

     $yayinevi='@<a itemprop="url" href="(.*?)"><span itemprop="name">(.*?)</span></a>@si';
     preg_match_all($yayinevi, $c, $yayinevi_1);


     $icer='@<span itemprop="description">(.*?)</span>@si';
     preg_match_all($icer, $c, $icerik);


     $res='@<img itemprop="image" src="(.*?)" style="width: 180px; height: 272px;">@si';
     preg_match_all($res, $c, $resim);


     $isim= $title[1][0];

     $yazar= $yayinevi_1[2][0];

     $yayin= $yayinevi_1[2][1];

     $icerik=$icerik[1][0];

     $resim=$_GET['resim'];

   

 ?>



   
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $isim; ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>



<body>

    <!-- Start your project here-->

<header  style=" margin-top: 100px;">





  <hr class="my-3">



<!-- Projects section v.3 -->
<section class="my-5 mx-5">



  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-md-3 ">
      <!--Image-->
      <img src="<?php echo $resim; ?>" alt="Sample project image"  style="max-height:450px; " class="img-fluid rounded z-depth-1">
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-7">
		  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold my-1">  <i class="fa fa-book fa-1x cyan-text"></i> Kitap Adı: <?php echo $isim; ?></h2>
    <hr class="my-2">
      <!-- Grid row -->
      <div class="row mb-1">
       
        <div class="col-md-12 col-10">

          <h5 class="font-weight-bold mb-3"> <i class="fa fa-pencil fa-1x red-text"></i> Yazar: <?php echo $yazar; ?></h5>

          <h5 class="font-weight-bold mb-3"><i class="fa fa-smile-o fa-1x blue-text"> </i> Yayınevi: <?php echo $yayin; ?></h5>

          <p class="black-text"> <?php echo $icerik; ?></p>
        </div>
      </div>
      <!-- Grid row -->

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

  <hr class="my-3">



</section>
<!-- Projects section v.3 -->






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

