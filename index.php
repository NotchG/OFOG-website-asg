<?php
$req_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path_alias = ['about', 'faq', 'tellus', 'tellus-thanks', 'testimonies'];
for ($i = 0; $i < count($path_alias); $i++) if ($req_path == "/$path_alias[$i]") {
    header("Location: /$path_alias[$i].php");
    die();
}
include('components/testimonies-items.php');
include('components/journey-items.php');
?>

<!DOCTYPE html>
<html lang="en" style="overflow-y: hidden;">

<head>
    <?php
    $USE_BOOTSTRAP = true;
    require('components/head.php');
    ?>

    <link rel="stylesheet" href="assets/css/testimonies.css">
    <link rel="stylesheet" href="assets/css/ourjourney.css">
    <link rel="stylesheet" href="assets/css/stats.css">
    <link rel="stylesheet" href="assets/css/gallery.css">
    
    <script>
      let activeProfile;

      function testimoniesImgClick(name) {
        if (name === activeProfile) {
          return;
        }
        const newImage = document.getElementById(name + "Photo");
		const newProfile = document.getElementById(name + "Profile");
        newImage.classList.add("profselector__img--active");
		newProfile.classList.remove("profdesc--hidden");
		
		const oldImage = document.getElementById(activeProfile + "Photo");
        const oldProfile = document.getElementById(activeProfile + "Profile");
		activeProfile = name;
		if(!oldImage || !oldProfile){
			return
		}
		oldImage.classList.remove("profselector__img--active");
        oldProfile.classList.add("profdesc--hidden");
      }
    </script>
</head>

<body>
    <div id="Preloader">
        <object data="assets/animations/LogoAnimationHIMTI.svg" class="Line"></object>
        <object data="assets/animations/LogoFillHIMTI.svg" class="Line"></object>
    </div>
    <?php $NAVBAR_SET_IMMERSIVE = true;
    require_once('components/navbar.php'); ?>
    <div id="carouselExampleIndicators" class="carousel slide carouselmain" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            // if ($CarouselData != null || count($CarouselData) != 0) {
                // $Number = 0;
                // foreach ($CarouselData as $row) {
                    // if ($Number == 0) {
                        // echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                // aria-current="true" aria-label="Slide 1"></button>';
                        // $Number += 1;
                    // } else {
                        // echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $Number . '"
                // aria-label="Slide ' . $Number + 1 . '"></button>';
                        // $Number += 1;
                    // }
                // }
            // } else {
                // echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
            // }
            ?>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <object data="assets/animations/OFOGAnimation.svg" type=""
                    style="background-color: black; border-bottom-left-radius: 50px;border-bottom-right-radius: 50px;"></object>
            </div>
            <?php
            // in the db carousel is empty
            // $Number = 0;
            // if ($CarouselData != null || count($CarouselData) != 0) {
                // foreach ($CarouselData as $row) {
                    // if ($Number == 0) {
                        // echo '<div class="carousel-item active"><img class="d-block w-100 himti-header-img" src="' . $row['ImageLink'] . '" alt="' . $row['ImageName'] . '"></div>';
                        // $Number += 1;
                    // } else {
                        // echo '<div class="carousel-item"><img class="d-block w-100 himti-header-img" src="' . $row['ImageLink'] . '" alt="' . $row['ImageName'] . '"></div>';
                        // $Number += 1;
                    // }
                // }
            // } else {
                echo '';
            // }
            ?>

        </div>
        <?php
        // if ($CarouselData != null && count($CarouselData) > 1) {
            // echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            // data-bs-slide="prev">
            // <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            // <span class="visually-hidden">Previous</span>
        // </button>
        // <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            // data-bs-slide="next">
            // <span class="carousel-control-next-icon" aria-hidden="true"></span>
            // <span class="visually-hidden">Next</span>
        // </button>';
        // }
        ?>
    </div>

    <div class="upcomingevent container">
        <div class="title">
            <span>Upcoming Events</span>
        </div>
        <div class="upcomingeventdata">
            <a href="https://techno.himtibinus.or.id/" class="linkupcoming" target="_blank">
                <div class="upcomingeventrow">
                    <div style="height: 80%; display: flex; align-items: center;">
                        <!-- <img src="https://techno.himtibinus.or.id/asset/Logo%20TECHNO%202023.png" alt="" class="logo"> -->
                        <h2>Coming Soon!</h2>
                    </div>

                    <div class="upcomingeventitem shadow">
                        <!-- <p>Coming soon!</p> -->
                        <!-- <p data-countdown-enabled="true" data-countdown-timestamp="2023-09-10 13:00:00"></p> -->
                        <!-- <p>?? ?? 2024</p> -->
                    </div>
                </div>
            </a>
            <a href="https://hishot.himtibinus.or.id/" class="linkupcoming" target="_blank">
                <div class="upcomingeventrow">
                    <div style="height: 75%; display: flex;">
                        <img sytle="height: 60%;" src="assets/img/events/HISHOT2024.png" alt="" class="logo">
                    </div>

                    <div class="upcomingeventitem shadow">
                        <p>HISHOT 2024: PROTECT</p>
                        <p data-countdown-enabled="true" data-countdown-timestamp="2023-07-29 13:00:00"></p>
                        <p>27 July 2024</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="quick-stats container my-5">
    <div class="title">
        <span>HIMTI by Numbers</span>
    </div>
    <div class="row text-center">
        <div class="col-md-3">
            <div class="stat-item">
                <h2 class="counter" data-target="<?php echo count($testimonies); ?>" data-delay="0">0</h2>
                <p>Alumni Stories</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item">
                <h2 class="counter" data-target="5" data-delay="200">0</h2>
                <p>Campus Locations</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item">
                <h2 class="counter" data-target="1000" data-delay="400">0</h2>
                <p>Active Members</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item">
                <h2 class="counter" data-target="<?php echo count($journeys); ?>" data-delay="600">0</h2>
                <p>Years of Excellence</p>
            </div>
        </div>
    </div>
</div>
<div class="testimonies-container">
    <div class="testimonies-section">
        <div class="title">
            <span>Testimonies</span>
        </div>

        <!-- Testimonies Carousel -->
        <div class="testimonies-carousel-container">
            <div class="testimonies-carousel" id="testimoniesCarousel">
                <?php
                foreach($testimonies as $index => $testimony) {
                    if(empty($testimony['name'])) continue; // Skip empty testimonies
                    
                    echo '<div class="testimony-card" data-index="'.$index.'">
                        <div class="testimony-avatar">
                            <img src="assets/img/testimonies-thumbnail/'.$testimony["id"].'Photo.webp" alt="'.$testimony["name"].'">
                        </div>
                        <div class="testimony-content">
                            <div class="testimony-text">
                                <p>"'.substr($testimony["testimony"], 0, 180).'..."</p>
                            </div>
                            <div class="testimony-author">
                                <h5>'.$testimony["name"].'</h5>
                                <span>'.$testimony["job"].'</span>
                                <div class="testimony-year">'.$testimony["active_years"].'</div>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
            
            <!-- Navigation -->
            <button class="carousel-nav prev" id="prevTestimony">‹</button>
            <button class="carousel-nav next" id="nextTestimony">›</button>
            
            <!-- Dots indicator -->
            <div class="carousel-dots">
                <?php
                $validTestimonies = array_filter($testimonies, function($t) { return !empty($t['name']); });
                for($i = 0; $i < count($validTestimonies); $i++) {
                    echo '<span class="dot'.($i === 0 ? ' active' : '').'" data-slide="'.$i.'"></span>';
                }
                ?>
            </div>
        </div>
        
    </div>
</div>
    
    <div class="ourarticle">
        <div class="title">
            <span>Our Articles</span>
        </div>
        <div class="container">
            <div class="row" id="RSSarticle">

            </div>

        </div>
        <div class="articledata d-flex" style="overflow-x: auto;">

        </div>

        <div class="viewtestimoni mt-3"><a href="https://student-activity.binus.ac.id/himti"
                class="btn btn-light btn-lg text-dark">View All Articles</a></div>
    </div>


    <div class="OURJOURNEY">
        <div class="title white">
            <span>Our Journey</span>
        </div>
        <div id="journeylist-container">
            <div id="journeylist-content">
                <?php 
                foreach($journeys as $journey){
                    echo '<div class="event">';
                    if ($journey["imgurl"] != NULL) :
                        // echo '<img id="journeylist-img" src="data:image/jpeg;base64,' . base64_encode($row['img']) . '"/>';
                        // echo '<div id="data-year-img"' . base64_encode($journey['year']);
                    endif;
                    echo '<div id="data-year">
                        '. ($journey["year"]) . '
                    </div>';
                    echo '<div id="journey1-modal">
                    '. ($journey["journey"]) .'
                    </div></div>';
                }
                
                ?>
            </div>

        </div>
    </div>

    <div class="pattern">
        <object data="assets/img/Transition.svg" alt="pattern-contact" class="objectdata"></object>
    </div>
    <div class="gallery min-vh-100">
        <div class="title" style="padding-top: 0;">
            <span>Gallery</span>
        </div>
        <div class="container-lg pt-5">
            <!-- Gallery Filter -->
            <div class="gallery-filter mb-4">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="events">Events</button>
                <button class="filter-btn" data-filter="activities">Activities</button>
                <button class="filter-btn" data-filter="achievements">Achievements</button>
            </div>
            
            <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-md-3" id="gallery-container">
                <?php
                    $gallery_items = [
                        ['img' => '1.jpg', 'category' => 'events', 'title' => 'HIMTI Annual Event'],
                        ['img' => '2.jpg', 'category' => 'activities', 'title' => 'Workshop Session'],
                        ['img' => '3.jpg', 'category' => 'achievements', 'title' => 'Award Ceremony'],
                        ['img' => '4.jpg', 'category' => 'events', 'title' => 'Tech Competition'],
                        ['img' => '5.jpg', 'category' => 'activities', 'title' => 'Study Group'],
                        ['img' => '6.jpg', 'category' => 'achievements', 'title' => 'Recognition Day']
                    ];
                    
                    foreach($gallery_items as $index => $item){
                        echo '<div class="col gallery-item-wrapper" data-category="'.$item['category'].'">
                            <div class="gallery-item-container">
                                <img src="assets/img/gallery/'.$item['img'].'" class="gallery-item" alt="'.$item['title'].'" data-bs-toggle="modal" data-bs-target="#galleryModal" data-img="assets/img/gallery/'.$item['img'].'" data-title="'.$item['title'].'">
                                <div class="gallery-overlay">
                                    <div class="gallery-overlay-content">
                                        <h5>'.$item['title'].'</h5>
                                        <i class="bi bi-zoom-in"></i>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                ?>
            </div>
            
            <!-- Load More Button -->
            <div class="text-center mt-4">
                <button class="btn btn-outline-primary btn-lg" id="loadMore">Load More Photos</button>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalTitle">Gallery Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="galleryModalImage" src="" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="FAQ mb-5">
        <div class="title" style="padding-top: 0;">
            <span>FREQUENTLY ASKED QUESTIONS</span>
        </div>
        <div class="container col-sm-12 my-5">
            <div class="accordion" id="accordionSection">
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">Apa
                            kepanjangan HIMTI BINUS?</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="collapseOne" data-bs-parent="#accordionSection">
                        <div class="accordion-body">
                            HIMTI BINUS merupakan kepanjangan dari Himpunan
                            Mahasiswa Teknik Informatika Universitas Bina Nusantara.
                        </div>
                    </div>

                </div>
                <div class="accordion-item  mb-3">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo">Ada
                            berapa komisi dan divisi dalam HIMTI?</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="collapseTwo" data-bs-parent="#accordionSection">
                        <div class="accordion-body">
                            Di HIMTI BINUS sendiri terdapat tiga komisi yang terdiri dari dua divisi di tiap
                            komisi.<br>
                            Komisi 1 yaitu <b>‘Education’</b> terdiri dari divisi Academic Event dan divisi Responsi.
                            <br>Komisi
                            2 yaitu <b>‘Relation Expansion’</b> terdiri dari divisi Publication and Marketing dan divisi
                            HIMTI
                            Care.<br>
                            Komisi 3 yaitu <b>‘Research and Development’</b> terdiri dari divisi Creative and
                            Design
                            dan divisi Web Development.<br>
                            Terakhir, Komisi 4 yaitu <b>‘Resource Administration’</b> terdiri dari Supervisor 
                            dan Human Resource Development.<br>
                            <br>

                            Untuk penjelasan lebih lengkapnya lagi, kamu dapat mengunjungi laman <a href="https://student-activity.binus.ac.id/himti/commission-and-division/">ini</a>

                        </div>
                    </div>

                </div>
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree">Mengapa
                            saya harus menjadi aktivis/pengurus HIMTI?</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="collapseThree" data-bs-parent="#accordionSection">
                        <div class="accordion-body">
                            Dengan menjadi aktivis/pengurus HIMTI, kamu bisa mendapatkan banyak sekali manfaat
                            seperti
                            menambah relasi, mengembangkan soft skill serta hard skill, bagaimana mengelola waktu
                            dengan
                            lebih baik, dan tentunya masih banyak lagi manfaat lainnya yang akan kamu rasakan ketika
                            sudah menjadi aktivis/pengurus.
                            Yakin gak mau join? :)

                        </div>
                    </div>

                </div>
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour">Apakah
                            menjadi aktivis/pengurus HIMTI mengganggu aktivitas perkuliahan?</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="collapseFour" data-bs-parent="#accordionSection">
                        <div class="accordion-body">
                            Tentu saja tidak. Dengan catatan, kamu dapat mengatur dan membagi waktu kamu dengan baik
                            mulai dari aktivitas perkuliahan, organisasi, dan beragam aktivitas lainnya. Time
                            management
                            yang baik itu penting, loh.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="viewtestimoni"><a href="/faq.php" class="btn btn-sm animated-button thar-three ">View All
                FAQs</a>
        </div>
    </div>

    <?php require_once('components/footer.php') ?>
    <script src="assets/js/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="assets/js/vanilla-tilt.min.js"></script>
    <script>
    VanillaTilt.init(document.querySelectorAll(".upcomingeventrow"), {
        max: 25,
        speed: 400
    });

    //It also supports NodeList
    VanillaTilt.init(document.querySelectorAll(".upcomingeventrow"));
    </script>
    <script src="assets/js/RSShandle.js"></script>
    <script src="assets/js/counter-animation.js"></script>
    <script src="assets/js/testimonies.js"></script>
</body>

</html>