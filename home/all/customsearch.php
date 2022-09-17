<?php
        if( isset( $_POST['bandwith'])) {
            // $srch = $_POST['search'];
            session_start();
            $_SESSION['bandwith'] = $_POST['bandwith'];
            $_SESSION['price'] = $_POST['price'];
            $_SESSION['area'] = $_POST['area'];
            $_SESSION['rating'] = $_POST['rating'];
            
            header('Location: customsearchresult.php');
            
            
        } 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->
        <link rel="stylesheet" href="../css/style.css">
        <style>
        

        </style>
       
    </head>
    <body>
        <div class="topbar">
            <div class="topleft">
              <a class="active" href="index.php">Home</a>
              <a href="usersignup.php">USER-SIGNUP</a>
              <a class="" href="userlogin.php">USER-LOGIN</a>
            </div>
            <div class="topright">
              <a href="ispsignup.php">ISP-SIGNUP</a>
              <a class="" href="isplogin.php">ISP-LOGIN</a>
              <a href="mypanel.php"><i class="blue large user circle icon"></i></a>
            </div>
        </div>

        <div class="mainbody">
            <div><h1 class="title">DHAKA ISP SOLUTION</h1></div>
            <div><h4>Search Your Desire ISP</h4></div>
           
        </div>

        <div class="custom">
                <form action="#" autocomplete="on" method="POST">
                  <div class="customform">
                      
                    <label for ="speed">Select bandwith Speed</label>
                    <input type="number" name="bandwith" id="speed" autocomplete="on" class="" placeholder="Enter a bandwith speed" min="1"  max="100" step="1" required>
                    <br>

                    <label for="pricing">Select a price range</label>
                    <input type="number" name="price" id="pricing" class="" placeholder="Enter a price range" min="100"  max="10000" step="1" required>
                    <br>

                    <label for="a">Select Your Area</label>
                    <input type="text" name="area" id="a" class="" placeholder="Enter your local area" >
                    <br>

                    <label for="r">Select a Mimimum Rating</label>
                    <input type="number" name="rating" id="r" class="" placeholder="Enter a minimum rating for isp" min="0"  max="5" step="1" >

                    <button type="submit" class="ui violet button">Search</button>
                  </div>
                </form>
            </div>

        </div>



    </body>
</html>