<!DOCTYPE html>
<html>
    <head>
        <title>editpackage2</title>
        <style type="text/css">
body{
    background-image: url('images/download1.jpg');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-attachment: fixed ;
    margin: 0px;
}
            
div.parent{
    position: static;
    width:auto;
    height:fit-content; 
    display: flex;
    flex-direction: row;
    margin:20px 20px 20px 20px;
    /*background-color: rgb(4, 0, 255);*/
    flex-wrap: wrap;
    
}
div.new_link{
    margin:auto;
    width: 50%;
    height: 50px;
    border-top: 2px solid burlywood;
    padding: 10px;
    background-color: rgb(255, 11, 11);

    position: sticky;
    
    
}
div.child1{
    width: 500px;
    height: 320px;
    font-size: large;
    /*align-items: right;*/
    text-align: left;
    background-color: aqua;
    background-image:url('images/download1.jpg');
    background-image:url('https://www.w3schools.com/images/img_girl.jpg');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    margin-top: 5px;
    margin-left: 450px;
    margin-right: 5px;
    margin-bottom: 5px;
    padding: 50px;

    overflow: auto;
    scrollbar-width: none; /*for firefox,edge*/
    
}
.child1::-webkit-scrollbar{  /* for chrome,safari*/
display: none;
}

div.child2{
    width: fit-content;
    height: fit-content;
    font-size: large;
    align-items: left;
    background-color: aqua;
    margin-left: 1S0px;
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 50px;
    border: 1px solid black;
    box-shadow: 10px 10px 7px 0.08px #aaaaaa;  /*horizonta px, vetical px,color deep, how much spread*/
    
}
h2{ 
    font-size: 20px;
    color:brown;
    background-color: burlywood;
    margin:0px 70px 0px 0px;
}
input[type="text"],input[type="search"]
{
    background: transparent;
    border: solid rgb(255, 0, 0);
    box-shadow:yes;
}
table{
    height: 50%;
    width: 900px;
    border:3px solid #0400ff;
    border-collapse: collapse;
    font-size: 20px;
    color:#ffffff;
    background-color:black;
    opacity:0.8;
    
}
td{
    border:3px solid #0400ff;
    border-collapse: collapse;
    width: 400px;
    height: 50px;
    padding:5px;
    text-align: center;
}

            /*tr{
                width:100px;
                height: 100px;
            }*/
th{
    border:3px solid #0400ff;
    color:red;
    height: 30px;
    width: 20px;
    
}

            

#textboxid
{
    height:70px;
    width: 300px;
    font-size:14pt;
}

                   

        </style>
    </head>
    <body>
        <div class="new_link">
            <p style="color: chartreuse;font-size:20px; text-align:center;">Write Down Your Issues</p>
        </div>
        <div class="parent">
            <div class="child1">
                   
                    <?php

                    require_once("db_connection.php");
                    $id = $_POST['ispid'];
                    $p =$_POST['packagename'];
                    $uid = $_POST['userid'];
                    
                        print("<form action='userreportdatabase.php' method='post'>
                       
                        
                        <input type='hidden' name='ispid' value='".$id."'>
                        <input type='hidden' name='packagename' value='".$p."'>
                        <input type='hidden' name='userid' value='".$uid."'>
                        
                        <label >Your Complain</label><br>
                        <input type='text' id='textboxid' name='complain'  >
                        <br>
               
                        <b><input type='submit' value='submit' ></b>
                        </form>");
                    ?>
                    
        </div>

           

           

                

            </div> -->


    </body>
</html>