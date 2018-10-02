<?php require 'processing.php';?>
<html>
    <head>
        <link rel="stylesheet" media="screen" href="style.css"></link>
    </head>
    <body>
        <div id="container">
            <img src="nfa.png" width="70%" height="70%" />
            <hr />
            <h1>Secure NFA-Protected Administrative Login</h1>
            <?php if( empty($logged_in) && empty($error) ){ ?>
            <form action="" method="post">
                Username :  <input type="text" name="username" /><br />
                Password :  <input type="password" name="password" /><br />
                <button type="submit">Launch NFA Authentication</button>
            </form>
            <?php } elseif( $error ) { ?>
            <span color="red"><?=$error?></span>
            <?php } else { ?>
            <span color="green">Currently logged as <?=$logged_in?>!</span>
            <?php } ?>
        </div>
    </body>
</html>
