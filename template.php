<?php
function test(){
  echo '1';
}

function navtemplate(){
//require "session.php";
session_start();

//html header + styles
echo'
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Arteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>';

//navbar
echo'
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">';



echo'
        <div class="container-fluid">
          <!--<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>-->
          <a class="brand" href="index.php">Arteca</a>
          <!--<div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
     


            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->';


       //user logged in  
if(isset($_SESSION['is_open'])){
  echo '<form class="form-inline pull-right" name="logOut" action="logout.php" method="post"><button  type="submit" class="btn btn-inverse btn-small"/>Sign Out</button></form>';
  echo '
  <div class="navbar-text pull-right><a href="#" class="navbar-link">Hi ' . $_SESSION['first'] . '</a>! </div>';

  }

//user not logged in
else{      echo'<a href="#regModal" role="button" class="btn btn-inverse btn-small" data-toggle="modal" style = "float:right;margin-left:10px">Register</a>';
		echo'<a href="#signModal" role="button" class="btn btn-inverse btn-small" data-toggle="modal" style = "float:right;margin-left:10px">Sign In</a>';


         
/*	 echo'  <form class="form-inline pull-right" action="login.php" method ="post">
            <input type="text" class="input-small" placeholder="Email" name="email" style = "margin-left:20px">
            <input type="password" class="input-small" placeholder="Password" name="pass" style = "margin-left:10px">
            <button type="submit" class="btn btn-inverse btn-small" style = "margin-left:10px">Sign In</button>
            </form>';   */
          }



echo'       </div>
      </div>
    </div>';

//container
echo'
    <div class="container-fluid">
      <div class="row-fluid">
        ';
          
if(isset($_SESSION['is_open'])){
  echo'
  <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">User Functions</li>
              
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php?func=profile&uID='. $_SESSION['user'] . '">My Profile</a></li>
              <li><a href="index.php?func=myart">My Artwork</a></li>
              <li><a href="index.php?func=collection">My Collection</a></li>
              <li><a href="index.php?func=favorites">Favorited Artwork</a></li>
              <li><a href="index.php?func=newpost">New Blog Post</a></li>
              <li><a href="index.php?func=upload">Upload Artwork</a></li>
              <li><a href="index.php?func=trades">Trades</a></li>
              <li><a href="index.php?func=genre">Genres</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->';}
        

	else{
echo'
		<div class = "span6 pull-left well"><h1>Welcome to Arteca</h1></div>
          ';
        }
echo'        
        <div class="span9 well">';
} //end navtemplate

    /**   <div class="hero-unit">
            <h1>Hello, world!</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
          </div>
          <div class="row-fluid">
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->**/
function templateend(){
echo'   </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.fluid-container-->';

echo'
            <div id="signModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">Sign in!</div>
            <div class="modal-body">
            <p>
                      
            <form class="form-horizontal" action="login.php" method="post">
              <div class="control-group">
                <label class="control-label" for="Email">Email</label>
                <div class="controls">
                  <input type="text" name="email" placeholder="Email">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="Password">Password</label>
                <div class="controls">
                  <input type="password" name="pass" placeholder="Password">
                </div>
              </div>
           


            </p>

            </div>
            <div class="modal-footer">
            <button class="btn " data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary" type="submit">Sign In</button>
            </form>
            </div>

            </div>';


//register modal
echo'
            <div id="regModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">Register with Arteca</div>
            <div class="modal-body">
            <p>
                      
            <form class="form-horizontal" action="newUser.php" method="post">
              <div class="control-group">
                <label class="control-label" for="inputPassword">First Name</label>
                <div class="controls">
                  <input type="text" name="firstname" placeholder="John">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPassword">Last Name</label>
                <div class="controls">
                  <input type="text" name="lastname" placeholder="Doe">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                  <input type="text" name="email" placeholder="john.doe@email.com">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPassword">Password</label>
                <div class="controls">
                  <input type="password" name="pass1" placeholder="Password">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputPassword">Confirm Password</label>
                <div class="controls">
                  <input type="password" name="pass2" placeholder="Password">
                </div>
              </div>


            </p>

            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary" type="submit">Register</button>
            </form>
            </div>

            </div>';


echo'
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.9.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    </body>
    </html>';
  }

    ?>