<?php
require_once "CLASS_FILES/cClass_Connector.php";
$UserCheck = new User_Account_Functions();
$UserCheck->userChecks(3);
$outgoing_HTML =<<<HTML
                        <div class="slideshow-container">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active" style="background-image: url(RESOURCES/slideshow-photo-2.jpg) ">
                                    <div class="carousel-caption">
                                        <h1>Sustainability</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <h1>Campus Sustainability Project Map</h1>
                        <p>
                            Curabitur non arcu eget risus efficitur blandit id at turpis. Nam congue massa ac tellus congue, a pellentesque arcu rutrum. Nulla egestas venenatis aliquam. Morbi porta, urna et molestie lobortis, tellus lacus feugiat dui, vestibulum sagittis diam neque porta nulla. Cras quis vulputate ligula, vitae condimentum turpis.
                        </p>
                        <div class="row">
                            <a href="Map.php?Repository=2" class="btn btn-default col-sm-4 margin-bottom">See Map</a>
                        </div>
                        <h1>Sustainability Documentation</h1>
                        <p>
                           Praesent pulvinar urna velit, id scelerisque justo condimentum vestibulum. Nulla eget magna eu tortor sodales sollicitudin. Praesent at libero sit amet leo scelerisque tristique. Suspendisse pharetra dolor tempus luctus tincidunt.
                        </p>
                        <div class="row">
                            <a href="Project_Create.php" class="btn btn-default col-sm-4 margin-bottom">Create a Project</a>
                        </div>
                        <p>
                            Etiam luctus, nibh id dignissim tristique, erat urna dapibus massa, eget feugiat mi tellus eget nibh. Praesent dolor lacus, convallis vel rhoncus eget, feugiat eget massa. Morbi volutpat est quis mattis euismod. Praesent pretium enim risus, eget tristique felis lacinia non. Morbi tristique bibendum orci, sed varius ligula laoreet quis. In interdum, neque et sollicitudin molestie, elit lorem bibendum ex, ac finibus dui est commodo lacus. Mauris vestibulum commodo risus, eu placerat arcu faucibus id. Quisque non facilisis ipsum. Praesent ut sapien dignissim, commodo risus vel, lobortis massa. Nunc ut tellus hendrerit, hendrerit felis non, pulvinar turpis. Praesent sollicitudin fringilla enim vel laoreet. Duis leo sapien, sollicitudin vel nisl at, rutrum rhoncus tortor.
                        </p>
HTML;
$oPage_Load = new Page_Load($outgoing_HTML);
echo $oPage_Load->getPage();