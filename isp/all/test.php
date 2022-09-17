<!DOCTYPE html>
<html lang="en">
    <head>
        <meta  charset="utf-8">
        <title>Dhaka ISP Solution</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">    <!-- semantic-ui cdn -->   <!--bootstrep-->

        <style>

                /* body {
                font-family: Arial, sans-serif;
                background: url(http://www.shukatsu-note.com/wp-content/uploads/2014/12/computer-564136_1280.jpg) no-repeat;
                background-size: cover;
                height: 100vh;
                } */

                /* h1 {
                text-align: center;
                font-family: Tahoma, Arial, sans-serif;
                color: #06D85F;
                margin: 80px 0;
                } */

                .box {
                width: 40%;
                margin: 0 auto;
                background: rgba(255,255,255,0.2);
                padding: 35px;
                border: 2px solid #fff;
                border-radius: 20px/50px;
                background-clip: padding-box;
                text-align: center;
                }

                .button {
                font-size: 1em;
                padding: 10px;
                color: #fff;
                border: 2px solid #06D85F;
                border-radius: 20px/50px;
                text-decoration: none;
                cursor: pointer;
                transition: all 0.3s ease-out;
                }
                .button:hover {
                background: #06D85F;
                }

                .overlay {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0, 0, 0, 0.7);
                transition: opacity 500ms;
                visibility: hidden;
                opacity: 0;
                }
                .overlay:target {
                visibility: visible;
                opacity: 1;
                }

                .popup {
                margin: 70px auto;
                padding: 20px;
                background: #fff;
                border-radius: 5px;
                width: 30%;
                position: relative;
                transition: all 5s ease-in-out;
                }

                .popup h2 {
                margin-top: 0;
                color: #333;
                font-family: Tahoma, Arial, sans-serif;
                }
                .popup .close {
                position: absolute;
                top: 20px;
                right: 30px;
                transition: all 200ms;
                font-size: 30px;
                font-weight: bold;
                text-decoration: none;
                color: #333;
                }
                .popup .close:hover {
                color: #06D85F;
                }
                .popup .content {
                max-height: 30%;
                overflow: auto;
                }

                @media screen and (max-width: 700px){
                .box{
                    width: 70%;
                }
                .popup{
                    width: 70%;
                }
                }

                            

        </style>
    </head>
    <body>

            <!-- <h1>Popup/Modal Windows without JavaScript</h1> -->
            <div class="box">
                <a class="button" href="#popup1">Rate Us</a>
            </div>

            <div id="popup1" class="overlay">
                <div class="popup">
                    <h3>Review and Rating</h3>
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        <!-- Thank to pop me out of that button, but now i'm done so you can close this window. -->
                        <form action="submitreview.php" method="POST"> 
                            <label id="rating"> Give your rating</label><br>
                            <select name="rating" id="rating" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="may"></option>
                                
                            </select><br><br>
                            <label id="review"> Give an honest Review</label><br>
                            <textarea class="" id="review" name ="review" placeholder="Write your Review" row="2" col="15" >
                            </textarea><br>
                            <input type="submit" name="submit" value="submit">
                            
                        </form>
                    </div>
                </div>
            </div>
        

    </body>
</html>



	</div>
</div>