<?php
require_once "cClass_Connector.php";
class Page_Load extends Class_Lib
{
    private $outgoing_Page = "";
    public function __construct($i_html)
    {
        $Navbar = "";
        $Sidebar = "";
      
        if (isset($_SESSION['userID'])){
            $userID = $_SESSION['userID'];
        }else{
            $userID = null;
        }
        $DBFunc = new DB_Functions();
        if ($userID == null)
        {
        $UserLogin =<<<HTML
                <li class=""><a href="./login.php">Login</a></li>
HTML;
        }
        else 
        {
            $UserLogin =<<<HTML
                <li class=""><a href="./login.php">Logout</a></li>
HTML;
            foreach($DBFunc->getfromDB("select fldFkPrivilegeId from tbl_user where fldID = $userID") as $row)
            {
              
              switch ($row['fldFkPrivilegeId'])
              {
                case 1:
                    $Navbar =<<<HTML
                                <li class=""><a href="./Admin_Dashboard.php">Admin Dashboard</a></li>
HTML;
                    $Sidebar =<<<HTML
                                <li>
                                    <a href="./index.php">Homepage</a>
                                </li>

                                <li class="">
                                    <a href="./Admin_Dashboard.php">Admin Dashboard</a>
                                </li>
HTML;
                Break;
                case 2:
                  $Navbar =<<<HTML
                            <li class=""><a href="./WHS_Homepage.php">WHS</a></li>
                            <li class=""><a href="./Sustainability_Homepage.php">Sustainability</a></li>
HTML;
                  $Sidebar =<<<HTML
                              <li>
                                  <a href="./index.php">Homepage</a>
                              </li>
                              <li>
                                  <a href="./WHS_Homepage.php">WHS Homepage</a>
                              </li>
                              <ul>
                                  <li>
                                      <a href="./Create_Incident.php">Log an Incident</a>
                                  </li>
                              </ul>
                              <li>
                                  <a href="./Sustainability_Homepage.php">Sustainability Homepage</a>
                              </li>
                              <ul>
                                  <li>
                                      <a href="./Project_Create.php">Create a Project</a>
                                  </li>
                              </ul>
                              <li>
                                  <a href="./Doc_Search.php">Document Search Page</a>
                              </li>
                              <li>
                                  <a href="./View_stakeholders.php">View Stakeholders</a>
                              </li>
HTML;
                Break;
                case 3:
                  $Navbar =<<<HTML
                            <li class=""><a href="./WHS_Homepage.php">WHS</a></li>
                            <li class=""><a href="./Sustainability_Homepage.php">Sustainability</a></li>
HTML;
                  $Sidebar =<<<HTML
                            <li>
                                <a href="./index.php">Homepage</a>
                            </li>
                            <li>
                                <a href="./WHS_Homepage.php">WHS Homepage</a>
                            </li>
                            <li>
                                <a href="./Sustainability_Homepage.php">Sustainability Homepage</a>
                            </li>
                            <li>
                                <a href="./Doc_Search.php">Document Search Page</a>
                            </li>
                            <li>
                                <a href="./View_stakeholders.php">View Stakeholders</a>
                            </li>
HTML;
                Break;
              default:
              
                Break;
              }
            }
        }

        $this->outgoing_Page =<<<HTML
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>TafeIntranet</title>
        <!-- Arimo Font Family -->
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arimo">
        <!-- jQuery -->
        <script src="./JS/jquery.js"></script>
        <!-- npm file -->
        <script src="./JS/npm.js"></script>
        <!-- Bootstrap obtained from and used with the permission of https://getbootstrap.com-->
        <script src="./JS/bootstrap.js"></script>
        <!-- Bootstrap obtained from and used with the permission of https://getbootstrap.com-->
        <link href="./CSS/bootstrap.css" rel="stylesheet">
        <!--    Sidebar obtained from and used with the permission of https://github.com/BlackrockDigital/startbootstrap-simple-sidebar-->
        <link href="./CSS/simple-sidebar.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="./CSS/style_main.css" rel="stylesheet">
        <!-- Slideshow CSS -->
        <link href="./CSS/JS-Slideshow.css" rel="stylesheet">
    </head>
    <body>
<!--    Navbar obtained from and used with the permission of https://getbootstrap.com/examples/navbar/-->
        <div class="container-fullwidth">
            <div id="header" class="header">
                <nav class="navbar navbar-fixed-top navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <div class="row">
                                <div class="col-sm-6 navbar-left">
                                    <a href="#menu-toggle" class="navbar-toggle nav-toggle-adjust" id="menu-toggle">
                                        <span class="sr-only">Toggle Sidebar</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </a>
                                </div>
                                <div class="navbar-right">
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
                                <a href="./index.php"><img class="col-sm-1 img-max-min navbar-left" src="./RESOURCES/LOGO.png"></a>
                                <div class="navbar-right">
                                    <ul class="nav navbar-nav navbar-right">
                                        $Navbar
                                        $UserLogin
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
<!--    Navbar obtained from and used with the permission of https://getbootstrap.com/examples/navbar/-->
<!--    Sidebar obtained from and used with the permission of https://github.com/BlackrockDigital/startbootstrap-simple-sidebar-->
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    $Sidebar
                </ul>
            </div>
<!--        /#sidebar-wrapper -->
<!--        Menu Toggle Script -->
            <script>
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
                $(window).on('resize', function () {
                    $("#wrapper").removeClass("toggled", $(window).width() > 767);
                }).trigger('resize')
            </script>
<!--        Sidebar obtained from and used with the permission of https://github.com/BlackrockDigital/startbootstrap-simple-sidebar-->
            <div id="page-content-wrapper">
                <div class="row-centered">
                    <div class="container-fluid" style="margin-top: 100px">
                        <div class="col-centered">
                            <div class="col-sm-12">
                                $i_html
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- /#wrapper -->
    </body>
</html>
HTML;
    }

    public function getPage()
    {
        return $this->outgoing_Page;
    }
}