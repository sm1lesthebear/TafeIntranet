<?php
require_once "CLASS_FILES/cClass_Connector.php";
//$UserCheck = new User_Account_Functions();
//$UserCheck->userChecks(3);
$outgoing_HTML = <<<HTML
<!--                      Carousel ================================================== -->
                        <div class="slideshow-container">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <!-- Indicators -->
                              <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                              </ol>
                              <div class="carousel-inner" role="listbox">
                                  <!--<img class="first-slide" src="RESOURCES/slideshow-photo-1.jpg" alt="First slide">-->
                                <div class="item active" style="background-image: url(RESOURCES/slideshow-photo-1.jpg) ">
                                    <div class="carousel-caption">
                                        <h1>Welcome To the Tafe Intranet</h1>
                                        <p>Please enjoy your stay</p>
                                    </div>
                                </div>
                                <div class="item" style="background-image: url(RESOURCES/slideshow-photo-2.jpg) ">
                                <div class="carousel-caption">
                                        <h1>Sustainability</h1>
                                        <p>Tafe Albany takes sustainability seriously, as can be seen on the sustainability portion of the GSIT Intranet</p>
                                        <p><a class="btn btn-default btn-transparency col-sm-4 col-sm-offset-4" href="#" role="button">Go</a></p>
                                    </div>
                                </div>  
                                <div class="item" style="background-image: url(RESOURCES/slideshow-photo-3.jpg) ">
                                <div class="carousel-caption">
                                        <h1>Work Health and Safety</h1>
                                        <p>At Tafe, employee and student health and safety is taken sseriously as can be seen on the WHS portion of the GSIT Intranet</p>
                                        <p><a class="btn btn-default btn-transparency col-sm-4 col-sm-offset-4" href="#" role="button">Go</a></p>
                                    </div>
                                </div>
                              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon-chevron-left" aria-hidden="true"><p>&lArr;</p></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon-chevron-right" aria-hidden="true"><p>&rArr;</p></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                        </div><!-- /.carousel -->
                        
                        <h1>Sample Text</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut convallis arcu consectetur, placerat lacus eget, scelerisque massa. Vivamus ut pretium ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut quis nibh consectetur, gravida ipsum eu, pharetra ex. Morbi et tellus leo. Etiam quis lorem sit amet enim malesuada sodales quis eu ipsum. Morbi nisi sem, congue eu justo non, mattis euismod velit. Vestibulum cursus ultrices ex id fermentum. Nullam at varius orci. Ut volutpat leo eu tellus varius, volutpat ultrices ante aliquam. Donec faucibus, arcu vel egestas accumsan, risus est venenatis libero, vitae sagittis purus libero eu ligula. Mauris at quam ut diam sollicitudin maximus ac et ipsum.
                        </p>
                        <p>
                            Curabitur non arcu eget risus efficitur blandit id at turpis. Mauris sed imperdiet erat. Nulla lacinia rhoncus lectus, at tempus libero maximus et. Curabitur quis eleifend mauris, at ultrices orci. Curabitur aliquet ultricies magna, a tristique lacus semper vitae. Pellentesque ut lacus dui. Nullam magna sapien, dignissim nec orci eu, lobortis lacinia nisl. Ut dictum ligula quis nibh elementum, vel dignissim orci auctor. Fusce finibus, ligula at fermentum bibendum, eros felis vehicula sem, id dapibus enim urna non lorem. Vivamus mi quam, venenatis mollis ornare vitae, laoreet ac urna. Nam congue massa ac tellus congue, a pellentesque arcu rutrum. Nulla egestas venenatis aliquam. Morbi porta, urna et molestie lobortis, tellus lacus feugiat dui, vestibulum sagittis diam neque porta nulla. Cras quis vulputate ligula, vitae condimentum turpis.
                        </p>
                        <p>
                            Maecenas eu volutpat dui, in rutrum lectus. Integer vel pretium risus. Integer condimentum odio non tincidunt tincidunt. Nunc congue volutpat quam vitae accumsan. Quisque nisl enim, facilisis vel pellentesque nec, cursus et nunc. Nunc eu nunc felis. Quisque porttitor lacinia orci eu cursus. Maecenas sodales, nulla non laoreet vulputate, ex elit sollicitudin erat, sit amet dapibus erat velit ac odio. Aenean accumsan ante nisi, sit amet consectetur tellus sagittis eu. Etiam malesuada ligula pulvinar nunc maximus, quis tempus elit egestas. Praesent viverra ultrices nibh, in fermentum sapien luctus eu. Sed ut porta nisl. Praesent pulvinar urna velit, id scelerisque justo condimentum vestibulum. Nulla eget magna eu tortor sodales sollicitudin. Praesent at libero sit amet leo scelerisque tristique. Suspendisse pharetra dolor tempus luctus tincidunt.
                        </p>
                        <h2>More Sample Text</h2>
                        <p>
                            Vivamus eu facilisis ipsum. Proin non elit sit amet risus sagittis ultrices vel at magna. Etiam consectetur hendrerit mollis. Praesent malesuada, neque non mollis egestas, libero arcu pellentesque nibh, vitae vulputate felis magna sit amet lacus. Etiam ut massa sapien. Maecenas sit amet nisi ut metus placerat placerat. Phasellus in leo eu metus elementum tristique.
                        </p>
                        <p>
                            Etiam luctus, nibh id dignissim tristique, erat urna dapibus massa, eget feugiat mi tellus eget nibh. Praesent dolor lacus, convallis vel rhoncus eget, feugiat eget massa. Morbi volutpat est quis mattis euismod. Praesent pretium enim risus, eget tristique felis lacinia non. Morbi tristique bibendum orci, sed varius ligula laoreet quis. In interdum, neque et sollicitudin molestie, elit lorem bibendum ex, ac finibus dui est commodo lacus. Mauris vestibulum commodo risus, eu placerat arcu faucibus id. Quisque non facilisis ipsum. Praesent ut sapien dignissim, commodo risus vel, lobortis massa. Nunc ut tellus hendrerit, hendrerit felis non, pulvinar turpis. Praesent sollicitudin fringilla enim vel laoreet. Duis leo sapien, sollicitudin vel nisl at, rutrum rhoncus tortor.
                        </p>
                    <script>
                        var slideIndex = 1;
                        showSlides(slideIndex);
                        function plusSlides(n) {
                            showSlides(slideIndex += n);
                        }
                        function currentSlide(n) {
                            showSlides(slideIndex = n);
                        }
                        function showSlides(n) {
                            var i;
                            var slides = document.getElementsByClassName("mySlides");
                            var dots = document.getElementsByClassName("dot");
                            if (n > slides.length) {slideIndex = 1}
                            if (n < 1) {slideIndex = slides.length}
                            for (i = 0; i < slides.length; i++) {
                                slides[i].style.display = "none";
                            }
                            for (i = 0; i < dots.length; i++) {
                                dots[i].className = dots[i].className.replace(" active", "");
                            }
                            slides[slideIndex-1].style.display = "block";
                            dots[slideIndex-1].className += " active";
                        }              
                    </script>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();