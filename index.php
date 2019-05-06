<?php
//start session
session_start();

include_once("config.php");
include_once("inc/twitteroauth.php");
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <title>Login</title>
        <link rel="stylesheet" href="STB18.css">
        <link rel="stylesheet" href="STB18.css">

        <style type="text/css">
            .wrapper {
                width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

            .welcome_txt {
                margin: 20px;
                background-color: #EBEBEB;
                padding: 10px;
                border: #D6D6D6 solid 1px;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
            }

            .tweet_box {
                margin: 20px;
                background-color: #FFF0DD;
                padding: 10px;
                border: #F7CFCF solid 1px;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
            }

            .tweet_box textarea {
                width: 500px;
                border: #F7CFCF solid 1px;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
            }

            .tweet_list {
                margin: 20px;
                padding: 20px;
                background-color: #E2FFF9;
                border: #CBECCE solid 1px;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
            }

            .tweet_list ul {
                padding: 0px;
                font-family: verdana;
                font-size: 12px;
                color: #5C5C5C;
            }

            .tweet_list li {
                border-bottom: silver dashed 1px;
                list-style: none;
                padding: 5px;
            }

        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-md bg-primary navbar-dark">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
                <a class="navbar-brand" href="Home.html">STB18</a>
                <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
                    <ul class="navbar-nav"> </ul>
                </div>
            </div>
        </nav>
        <div class="py-5 my-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="mb-4 text-center text-uppercase display-2 text-primary">WELCOME TO STB18</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-0 my-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="w-100 text-center border text-white bg-gradient py-5">STB18 is the online platform for the latest news and translation about BTS</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php
	if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified') 
	{
		//Retrive variables
		$screen_name 		= $_SESSION['request_vars']['screen_name'];
		$twitter_id			= $_SESSION['request_vars']['user_id'];
		$oauth_token 		= $_SESSION['request_vars']['oauth_token'];
		$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
	
		//Show welcome message
		echo '<div class="welcome_txt">Welcome <strong>'.$screen_name.'</strong> (Twitter ID : '.$twitter_id.'). <a href="logout.php?logout">Logout</a>!</div>';
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
		
		//If user wants to tweet using form.
		if(isset($_POST["updateme"])) 
		{
			//Post text to twitter
			$my_update = $connection->post('statuses/update', array('status' => $_POST["updateme"]));
			die('<script type="text/javascript">window.top.location="index.php"</script>'); //redirect back to index.php
		}
		
		//show tweet form
		echo '<div class="tweet_box">';
		echo '<form method="post" action="index.php"><table width="200" border="0" cellpadding="3">';
		echo '<tr>';
		echo '<td><textarea name="updateme" cols="60" rows="4"></textarea></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="submit" value="Tweet" /></td>';
		echo '</tr></table></form>';
		echo '</div>';
		
		//Get latest tweets
		$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $screen_name, 'count' => 5));
		
		echo '<div class="tweet_list"><strong>Latest Tweets : </strong>';
		echo '<ul>';
		foreach ($my_tweets  as $my_tweet) {
			echo '<li>'.$my_tweet->text.' <br />-<i>'.$my_tweet->created_at.'</i></li>';
		}
		echo '</ul></div>';
			
	}else{
		//Display login button
		echo '<a href="process.php"><img src="images/twitter.png"/></a>';
        
	}
?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white p-5 bg-primary">
                <div class="card-body">
                    <h1 class="mb-4">Login form</h1>
                    <form action="/home.html" method="POST">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" placeholder="Enter email" name="email" class="form-control"> </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control"> </div>
                        <button type="submit" class="btn btn-secondary" value="Submit">Login</button>
                    </form>
                </div>
            </div>
             </div>
            <div class="col-md-6"> </div>
        <div class="col-md-6"> </div>
        <div class="py-5 bg-dark text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <p class="lead">Enter your email to get the latest update</p>
                        <form class="form-inline" form="" method="POST" name="subscribe">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your e-mail here" name="email"> </div>
                            <button type="submit" class="btn btn-primary ml-3" value="submit">Subscribe</button>
                        </form>
                    </div>
                    <div class="col-4 col-md-1 align-self-center">
                        <a href="https://www.facebook.com" target="_blank">
            <i class="fa fa-fw fa-facebook fa-3x text-white"></i>
          </a>
                    </div>
                    <div class="col-4 col-md-1 align-self-center">
                        <a href="https://twitter.com" target="_blank">
            <i class="fa fa-fw fa-twitter fa-3x text-white"></i>
          </a>
                    </div>
                    <div class="col-4 col-md-1 align-self-center">
                        <a href="https://www.instagram.com" target="_blank">
            <i class="fa fa-fw fa-instagram text-white fa-3x"></i>
          </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3 text-center">
                        <p>© Copyright 2018 STB18 - All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

        <!-- or use local jquery -->
        <script src="/js/jqBootstrapValidation.js"></script>
        <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 10px;right:10px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:180px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo&nbsp;&nbsp;
            <img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16">
        </pingendo>
    </body>

    </html>
