<?php
          $id = $_POST["adminid"];
          $pass = $_POST["password"];

          require_once('db_connection.php');
          
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
            printf("Connect failed: %s\n", $conn->connect_error);
            exit();
          }
        // printf("Connected successfully");
        $query = "SELECT id,password FROM page_admin where id='$id'";
        if ($result = $conn->query($query)) {

            //printf("<br>%d record(s) found!<br>", $result->num_rows);
            if(($result->num_rows)>0){

              /* fetch associative array */
              while ($row = $result->fetch_assoc()) {
                // printf("%s %s                 ", $row["User_id"],$row["Password"] );
                if($pass == $row["password"]){
                    // correct password and session start.
                    session_start();
                    $_SESSION['admin_id'] = $id;
                    $_SESSION['password']= $pass;
                    header('Location: admin.php');
                    // printf("yes");
                }
                else
                {
                  session_start();
                    $_SESSION['pass'] = "password incorrect";
                    header('Location: login.php');

                  // printf("incorrect id or password!");
                  // printf("<br><button class='ui inverted blue button'><a href='userlogin.php'>Try Again</a></button>");
                }

              }
              $result->free(); //free result set
              }

            else
            {
              session_start();
                  $_SESSION['id'] = "username doesn't exist";
                  header('Location: login.php');
              // printf("incorrect id or password!");
            }
        }
        else
            {
              session_start();
                  $_SESSION['id'] = "username doesn't exist";
                  header('Location: login.php');
              // printf("incorrect id or password!");
            }
        $conn->close();

    ?>