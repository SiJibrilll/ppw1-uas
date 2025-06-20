<!DOCTYPE html>
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v6.0.6, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="https://r.mobirisesite.com/1558499/assets/images/photo-1531501410720-c8d437636169.jpeg" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Search Page</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css?v=saqXDj"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css?v=saqXDj" type="text/css">

  
  
  
</head>
<?php 
// var_dump($comics);
// $comics = [];
// var_dump($total_pages);
// var_dump($current_page);
?>

<style>
#search-addon:hover {
    background-color: rgba(0, 0, 0, 0.1);
    transform: scale(1.05);
}

#search-addon:hover svg {
    transform: scale(1.1);
}

#search-addon:active {
    transform: scale(0.95);
}
</style>
<body>
  
  <section data-bs-version="5.1" class="menu menu2 cid-uNCrK5IXlC" once="menu" id="menu02-1">
	

	<nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
		<div class="container">
			<div class="navbar-brand">
				<span class="navbar-logo">
					<a href="  ">
						<img src="https://r.mobirisesite.com/1558499/assets/images/photo-1531501410720-c8d437636169.jpeg" alt="Mobirise Website Builder" style="height: 4.3rem;">
					</a>
				</span>
				<span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4" href="/home">ImComics</a></span>
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

<section data-bs-version="5.1" class="gallery06 cid-uNCVW4Okfq" id="gallery06-3">
    
    
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-12 content-head">
                <div class="mbr-section-head mb-5">
                    <h4 class="mbr-section-title mbr-fonts-style align-center mb-3 display-2"><strong>Discover</strong></h4>

                    <div class="input-group rounded mbr-fonts-style align-center mb-0 mx-4">
                        <form action="/search" method="get" style="width: 100%;" class="d-flex">
                            <input type="search" value="<?=$_SESSION['search'] ?: '' ?>" name="search" class="form-control rounded-start" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn input-group-text border-0 rounded-end" id="search-addon" style="cursor: pointer; transition: all 0.2s ease;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.2s ease;">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.35-4.35"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($comics as $comic): ?>
            <div class="item features-image col-12 col-md-6 col-lg-3 active">
                <a href="/comics?id=<?=$comic['id'] ?>" class="text-black">
                    <div class="item-wrapper">
                        <div class="item-img mb-2">
                            <img src="<?=$comic['cover'] ?>" alt="Mobirise Website Builder" title="" data-slide-to="0" data-bs-slide-to="0">
                        </div>
                        <div class="item-content">
                            <h5 class="item-title mbr-fonts-style display-7">
                                <?=$comic['title'] ?>
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>

            <?php if (empty($comics)): ?>
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No comics found.
                </div>  
            </div>
            <?php endif; ?>

            <?php $search = urlencode($_SESSION['search'] ?? ''); ?>
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="/search?page=<?= $current_page - 1 ?>&search=<?= $search ?>"><</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="/search?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item"> 
                                <a class="page-link" href="/search?page=<?= $current_page + 1 ?>&search=<?= $search ?>">></a>
                            </li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="/search?page=<?= $total_pages ?>&search=<?= $search ?>">>></a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        
    </div>
</section>

<section data-bs-version="5.1" class="footer3 cid-uNCrK5MiNl" once="footers" id="footer03-2">

        

    

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
                        <a href="  /" target="_blank">
                            <span class="mbr-iconfont socicon socicon-facebook display-7"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="  /" target="_blank">
                            <span class="mbr-iconfont socicon-twitter socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="  /" target="_blank">
                            <span class="mbr-iconfont socicon-instagram socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="  /" target="_blank">
                            <span class="mbr-iconfont socicon socicon-linkedin"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="  /" target="_blank">
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