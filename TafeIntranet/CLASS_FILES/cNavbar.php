<?php
class navbar_class_lib {
    private $html = "";
    public function load_nav() {
        return $this->html = <<<HTML
        <div id="container">
            <!--    Navbar example from https://getbootstrap.com/components/#navbar -->
            <div id="header" class="header">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <div class="row">
                                <div class="col-sm-2 navbar-right">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <div class="row">
                                <img class="col-sm-1 img-max-min navbar-left" src="./IMGS/LOGO/logo.png">
                                <div class="col-sm-8 navbar-right">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class=""><a href="./ticket_submit.php">Submit Ticket</a></li>
                                        <li class=""><a href="./dashboard.php">Dashboard</a></li>
                                        <li class=""><a href="./user_create_form.php">Create User (Admin only)</a></li>
                                        <li class=""><a href="./logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </div>
        </div>
HTML;
    }
}