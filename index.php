<!DOCTYPE html>
<html lang="en">

<?php
require 'bootstrap.php';
use Src\Layout\NavBarClass;
use Src\Layout\FooterClass;
use Src\Layout\CarouselClass;
use Src\Layout\NewsClass;

$navbar = new NavBarClass("./", null);
$carousel = new CarouselClass($dbConnection);
$news = new NewsClass($dbConnection, "./");
$footer = new FooterClass();


echo($navbar->returnNavLayout());

?>

    <!-- End Navbar -->


    <!--------------------------------------
HEADER
--------------------------------------->
    <div class="container">
        <?php
            echo($carousel->returnCarousel());
        ?>        
    </div>
    <div class="container">
        <div class="border p-5">
            <div class="text-center">
                <h5 class="font-weight-bold secondfont">Welcome to <?php echo(getenv("APP_NAME")) ?></h5>
                Get the latest news, movies, musics, Tv-series and entertainments right here.
            </div>       
         </div>
    </div>
    <!-- End Header -->


    <!--------------------------------------
MAIN
--------------------------------------->

    <?php
            echo($news->returnNews("news"));
    ?>
    <?php
            echo($news->returnNews("tech"));
    ?>
    <?php
            echo($news->returnNews("sports"));
    ?>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-8">
                <h5 class="font-weight-bold spanborder"><span>All Stories</span></h5>
                <div class="mb-3 d-flex justify-content-between">
                    <div class="pr-3">
                        <h2 class="mb-1 h4 font-weight-bold">
                            <a class="text-dark" href="./article.html">Nearly 200 Great Barrier Reef coral species also live in the deep sea</a>
                        </h2>
                        <p>
                            There are more coral species lurking in the deep ocean that previously thought.
                        </p>
                        <div class="card-text text-muted small">
                            Jake Bittle in SCIENCE
                        </div>
                        <small class="text-muted">Dec 12 &middot; 5 min read</small>
                    </div>
                    <img height="120" src="./assets/img/demo/blog8.jpg">
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div class="pr-3">
                        <h2 class="mb-1 h4 font-weight-bold">
                            <a class="text-dark" href="./article.html">East Antarctica's glaciers are stirring</a>
                        </h2>
                        <p>
                            Nasa says it has detected the first signs of significant melting in a swathe of glaciers in East Antarctica.
                        </p>
                        <div class="card-text text-muted small">
                            Jake Bittle in SCIENCE
                        </div>
                        <small class="text-muted">Dec 12 &middot; 5 min read</small>
                    </div>
                    <img height="120" src="./assets/img/demo/1.jpg">
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div class="pr-3">
                        <h2 class="mb-1 h4 font-weight-bold">
                            <a class="text-dark" href="./article.html">50 years ago, armadillos hinted that DNA wasn’t destiny</a>
                        </h2>
                        <p>
                            Nasa says it has detected the first signs of significant melting in a swathe of glaciers in East Antarctica.
                        </p>
                        <div class="card-text text-muted small">
                            Jake Bittle in SCIENCE
                        </div>
                        <small class="text-muted">Dec 12 &middot; 5 min read</small>
                    </div>
                    <img height="120" src="./assets/img/demo/5.jpg">
                </div>
            </div>
            <div class="col-md-4 pl-4">
                <h5 class="font-weight-bold spanborder"><span>Popular</span></h5>
                <ol class="list-featured">
                    <li>
                        <span>
				<h6 class="font-weight-bold">
				<a href="./article.html" class="text-dark">Did Supernovae Kill Off Large Ocean Animals?</a>
				</h6>
				<p class="text-muted">
					Jake Bittle in SCIENCE
				</p>
				</span>
                    </li>
                    <li>
                        <span>
				<h6 class="font-weight-bold">
				<a href="./article.html" class="text-dark">Humans Reversing Climate Clock: 50 Million Years</a>
				</h6>
				<p class="text-muted">
					Jake Bittle in SCIENCE
				</p>
				</span>
                    </li>
                    <li>
                        <span>
				<h6 class="font-weight-bold">
				<a href="./article.html" class="text-dark">Unprecedented Views of the Birth of Planets</a>
				</h6>
				<p class="text-muted">
					Jake Bittle in SCIENCE
				</p>
				</span>
                    </li>
                    <li>
                        <span>
				<h6 class="font-weight-bold">
				<a href="./article.html" class="text-dark">Effective New Target for Mood-Boosting Brain Stimulation Found</a>
				</h6>
				<p class="text-muted">
					Jake Bittle in SCIENCE
				</p>
				</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!--------------------------------------
FOOTER
--------------------------------------->
    <?php
        
        echo($footer->returnFooterLayout());
    ?>
    <!-- End Footer -->

    <!--------------------------------------
JAVASCRIPTS
--------------------------------------->
    <script src="./assets/js/vendor/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/js/vendor/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/vendor/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/functions.js" type="text/javascript"></script>
    <script>
        $('.carousel').on('slide.bs.carousel', function(event) {
            var height = $(event.relatedTarget).height();
            var $innerCarousel = $(event.target).find('.carousel-inner');
            $innerCarousel.animate({
                height: height
            });
        });
    </script>
</body>

</html>