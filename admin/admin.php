<!DOCTYPE html>
<html lang="en">
    <head>
        <meta  charset="utf-8">
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->

        <style>

            body {
                font-family: 'Times New Roman', Times, serif;
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                background-image: url('../images/main.png');
                background-repeat: no-repeat;
                background-attachment:fixed;
                background-size:100% 100%;
                /* background-color: rgba(164, 204, 214, 0.9);
                background-blend-mode: lighten; */
                /* opacity: 0.8; */
            }

            div.topbar{
                display: flex;
                flex-direction:row;
                align-items:center;
                justify-content:space-between;
                background-color: rgb(21, 20, 24);
                width: 100%;
                height: 60px;
                position: sticky;
                top: 0;
                z-index: 100;
                /* position: fixed; */
            
            }
            .topleft a,.topright a{
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }
            .topleft a:hover,.topright a:hover {
                background-color: #ddd;
                color: black;
            }
            .topleft a.active,.topright a.active{
                background-color: #04AA6D;
                color: white; 
            }
            div.mainbody{
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content:center ;
                background-color: rgba(58, 156, 160, 0.65);
                background-blend-mode: overlay;
                /* opacity: 0.5; */
            }
            div.mainbody > div h1{
                letter-spacing: 5px;
                color: white;
                font-size: 70px;
            }
            div.mainbody > div h4{
                color: white;
                font-size: 25px;
                letter-spacing: 3px;
                padding: 10px;
                margin-bottom: 20px;
            }
            div.mainbody >div input.search{
                height: 50px;
                width: 500px;
                padding: 10px;
                margin-bottom: 20px;
            }

        </style>
    </head>
    <body>
        <div class="topbar">
            <div class="topleft">
              <a class="active" href="#">Home</a>
              <a href="isprequest.php">Isp-Request</a>
              <!-- <a href="login.php">login</a> -->
              <a href="subrequest.php">Sub-Request</a>
            </div>
            <div class="topright">
              <!-- <a href="ispsignup.php">ISP-SIGNUP</a> -->
              <?php
              session_start();
              if(!isset($_SESSION['admin_id'])){
                printf("<a href='login.php'>login</a>");
              }
              else{
                printf("<a href='logout.php'>logout</a>");
              }
              
              ?>
              <a href="adminpanel.php"><i class="blue large user circle icon"></i></a> 
            </div>
        </div>

        <div class="mainbody">
            <div><h1 class="title">DHAKA ISP SOLUTION</h1></div>
            <div><h2 class="">Welcome to Admin Panel</h2></div>
            <!-- <div><h4>Search Your Desire ISP:</h4></div> -->

            <div class="search">
                <!-- <form action="mainsearch.php" method="POST">
                    <input type="text" name="search" class="search" placeholder="ISP Search by LOCATION" size="50" required>
                    <button type="submit" class="ui violet button"  value="Search" name="Search"> Search </button>    
                </form> -->
            </div>

            <div>
                <!-- <form action="customsearch.php" method="GET">
                    </br>
                    <button type="submit" class="ui green button" name="" >Custom Search</button>     
                </form> -->
            </div>

        </div>



    </body>
</html>