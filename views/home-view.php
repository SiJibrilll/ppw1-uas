<!DOCTYPE html>
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v6.0.6, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="https://r.mobirisesite.com/1558499/assets/images/photo-1531501410720-c8d437636169.jpeg" type="image/x-icon">
  <meta name="description" content="ImComic the best manga portal today">
  
  
  <title>ImComic</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/parallax/jarallax.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css?v=409Bsa"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css?v=409Bsa" type="text/css">

  
  
  
</head>
<body>
  
  <section data-bs-version="5.1" class="menu menu2 cid-uNCrK5IXlC" once="menu" id="menu-5-uNCrK5IXlC">
	

	<nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
		<div class="container">
			<div class="navbar-brand">
				<span class="navbar-logo">
					<a href="/home">
						<img src="https://r.mobirisesite.com/1558499/assets/images/photo-1531501410720-c8d437636169.jpeg" alt="Mobirise Website Builder" style="height: 4.3rem;">
					</a>
				</span>
				<span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4" href=" ">ImComics</a></span>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<div class="hamburger">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
						<a class="nav-link link text-black display-4" href="/home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link link text-black display-4" href="/search" aria-expanded="false">Search</a>
					</li></ul>
				
				<div class="navbar-buttons mbr-section-btn"><a class="btn btn-primary display-4" href="/login">Sign in<br></a></div>
			</div>
		</div>
	</nav>
</section>

<section data-bs-version="5.1" class="header18 cid-uNCrK5KP9o mbr-fullscreen mbr-parallax-background" id="hero-15-uNCrK5KP9o">
  

  <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="content-wrap col-12 col-md-12">
        <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-4 display-1"><strong>ImComic</strong></h1>
        
        <p class="mbr-fonts-style mbr-text mbr-white mb-4 display-7">Your go to manga portal</p>
        
      </div>
    </div>
  </div>
</section>

<section data-bs-version="5.1" class="gallery1 mbr-gallery cid-uNCUoSkdWg" id="gallery01-0">
    
    

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 content-head">
                <div class="mb-5">
                    <h3 class="mbr-section-title mbr-fonts-style align-center m-0 display-2"><strong>Latest updates</strong></h3>
                    
                </div>
            </div>
        </div>
        
        <div class="row mbr-gallery">
            <?php foreach ($updates as $update): ?>
            <div class="col-12 col-md-6 col-lg-6 item gallery-image">
                <a href="/comics?id=<?= htmlspecialchars($update['id'])?>">
                  <div class="item-wrapper mb-3" data-toggle="modal" data-bs-toggle="modal" data-target="#uND1zFLw8g-modal" data-bs-target="#uND1zFLw8g-modal">
                      <img class="w-100" src="<?=$update['cover'] ?: $GLOBALS['placeholder']?>" alt="Mobirise Website Builder" data-slide-to="4" data-bs-slide-to="4" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g">
                      <div class="icon-wrapper">
                          <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                      </div>
                  </div>
                </a>
                <h6 class="mbr-item-subtitle mbr-fonts-style align-center mb-0 mt-3 display-7">
                    <?= htmlspecialchars($update['title']) ?>
                </h6>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="modal mbr-slider" tabindex="-1" role="dialog" aria-hidden="true" id="uND1zFLw8g-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="carousel slide" data-pause="false" data-bs-pause="false" id="lb-uND1zFLw8g" data-interval="5000" data-bs-interval="5000">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="assets/images/gallery01.jpg" alt="Mobirise Website Builder">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/gallery02.jpg" alt="Mobirise Website Builder">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/gallery03.jpg" alt="Mobirise Website Builder">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/gallery04.jpg" alt="Mobirise Website Builder">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/gallery10.jpg" alt="Mobirise Website Builder">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/gallery05.jpg" alt="Mobirise Website Builder">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/gallery06.jpg" alt="Mobirise Website Builder">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/images/gallery07.jpg" alt="Mobirise Website Builder">
                                </div>
                            </div>
                            <ol class="carousel-indicators">
                                <li data-slide-to="0" data-bs-slide-to="0" class="active" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                                <li data-slide-to="1" data-bs-slide-to="1" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                                <li data-slide-to="2" data-bs-slide-to="2" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                                <li data-slide-to="3" data-bs-slide-to="3" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                                <li data-slide-to="4" data-bs-slide-to="4" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                                <li data-slide-to="5" data-bs-slide-to="5" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                                <li data-slide-to="6" data-bs-slide-to="6" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                                <li data-slide-to="7" data-bs-slide-to="7" data-target="#lb-uND1zFLw8g" data-bs-target="#lb-uND1zFLw8g"></li>
                            </ol>
                            <a role="button" href="" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                            </a>
                            <a class="carousel-control-prev carousel-control" role="button" data-slide="prev" data-bs-slide="prev" href="#lb-uND1zFLw8g">
                                <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
                                <span class="sr-only visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next carousel-control" role="button" data-slide="next" data-bs-slide="next" href="#lb-uND1zFLw8g">
                                <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
                                <span class="sr-only visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features03 cid-uNCrK5KPzE" id="news-1-uNCrK5KPzE">
  
  
  <div class="container-fluid">
    <div class="row justify-content-center mb-5">
      <div class="col-12 content-head">
        <div class="mbr-section-head">
          <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>New Releases</strong></h4>
          
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach ($comics as $comic): ?>
      <div class="item features-image col-12 col-md-6 col-lg-3">
        <div class="item-wrapper">
          <a href="/comics?id=<?= htmlspecialchars($comic['id'])?>">
            <div class="item-img mb-3">
              <img src="<?= $comic['cover'] ?: $GLOBALS['placeholder'] ?>" alt="Mobirise Website Builder" title="" data-slide-to="2" data-bs-slide-to="2">
            </div>
          </a>
          <div class="item-content align-left">
            <h5 class="item-title mbr-fonts-style mb-2 mt-0 display-5">
              <strong><?=$comic['title']?></strong>
            </h5>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

      <div class="item features-image col-12 col-md-6 col-lg-3">
        <div class="item-wrapper">
          <a href="/search" style="color: black;">
            <div class="item-img mb-3 p-5" style="background-color: lightgray; border-radius: 40px;">
              <h5 class="item-title mbr-fonts-style mt-0 display-5" style="padding-top: 30%;">
                <strong>See more</strong>
              </h5>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="max-width: 50%;">
                <path fill-rule="evenodd" d="M2 10a.75.75 0 0 1 .75-.75h12.59l-2.1-1.95a.75.75 0 1 1 1.02-1.1l3.5 3.25a.75.75 0 0 1 0 1.1l-3.5 3.25a.75.75 0 1 1-1.02-1.1l2.1-1.95H2.75A.75.75 0 0 1 2 10Z" clip-rule="evenodd" />
              </svg>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section data-bs-version="5.1" class="footer3 cid-uNCrK5MiNl" once="footers" id="footer-3-uNCrK5MiNl">

        

    

    <div class="container">
        <div class="row">
            <div class="row-links">
                <ul class="header-menu">
                  
                  
                  
                  
                <li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">About</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Terms</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Privacy</a>
                  </li><li class="header-menu-item mbr-fonts-style display-5">
                    <a href="#" class="text-white">Help</a>
                  </li></ul>
              </div>

            <div class="col-12 mt-4">
                <div class="social-row">
                    <div class="soc-item">
                        <a href=" /" target="_blank">
                            <span class="mbr-iconfont socicon socicon-facebook display-7"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href=" /" target="_blank">
                            <span class="mbr-iconfont socicon-twitter socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href=" /" target="_blank">
                            <span class="mbr-iconfont socicon-instagram socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href=" /" target="_blank">
                            <span class="mbr-iconfont socicon socicon-linkedin"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href=" /" target="_blank">
                            <span class="mbr-iconfont socicon socicon-twitch"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <p class="mbr-fonts-style copyright display-7">© 2025 Imcomics. All rights reserved.</p>
            </div>
        </div>
    </div>
  
</body>
</html>