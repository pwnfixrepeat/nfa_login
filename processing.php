<?php
    $error = $logged_in = '';
    if( 
        isset($_POST['username'], $_POST['password'])
        && is_string($_POST['username'])
        && is_string($_POST['password'])
      ) {
          $db = new SQLite3('site.db');
          $stmt = $db->prepare('SELECT password FROM users WHERE username=:username');
          $stmt->bindValue(':username', $_POST['username']);
          $res = $stmt->execute();
          $pass = $res->fetchArray();
          
          // Recently learned about https://security.googleblog.com/2017/02/announcing-first-sha1-collision.html,
          // We definitely don't want customers to know we store their password using SHA1! Let's upgrade to SHA3-512
          // so we can get prove the nay-sayers NFA _is_ state-of-the-art crypto!!!!!!!! 
          if( !empty($pass) && strlen($pass[0]) == 40 ) {
            $new_pass = hash('sha3-512', $pass[0]);
            $stmt = $db->prepare('UPDATE users SET password=:pass WHERE username=:uname');
            $stmt->bindValue(':pass', $new_pass);
            $stmt->bindValue(':uname', $_POST['username']);
            $stmt->execute();
            // Updating the result, so we can compare later.
            $pass[0] = $new_pass;
          }
          
          if( !empty($pass) && $pass[0] == hash('sha3-512', sha1($_POST['password'])) ) {
            $logged_in = htmlentities($_POST['username']);
          }
          else {
            $error = 'Hacking attempt detected!';
          }

    }
