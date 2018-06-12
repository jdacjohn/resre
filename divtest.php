<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
            <style>
                .border-bottom {
                    border: none;
                    border-bottom: 2px solid black;
                    width: 5%;
                    margin-left: 2.5%;
                }
                .border-top {
                    border: none;
                    border-top: 2px solid black;
                    width: 5%;
                    margin-left: 2.5%;
                }
                .border-middle {
                    border: none;
                    border-left: 2px solid black;
                    height: 100px;
                    margin-left: 5%;
                }
                .border-middle-hide {
                    border: none;
                    border-left: 2px solid white;
                    height: 50px;
                    margin-left: 5%;
                    margin-top: -50px;
                }
                .centerline {
                    position: relative;
                    float: left;
                    top: -60px;
                    left: 5%;
                    margin-left: -5px;
                }
            </style>
        </head>
        <body>
            <div>
                <div class="border-bottom"></div>
                <div class="border-middle"></div>
                <div class="centerline">A</div>
            </div>
            <div>
                <div class="border-middle"></div>
                <div class="centerline">B</div>
            </div>
            <div>
                <div class="border-middle"></div>
                <div class="centerline">C</div>
            </div>
            <div>
                <div class="border-middle" style="margin-top:20px"></div>
                <div class="border-top"></div>
            </div>
            <div>
                How about some stupid text in here to break things up?
            </div>
            <div>
                <div class="border-bottom"></div>
                <div class="border-middle"></div>
                <div class="border-middle-hide"></div>
            </div>
            
        </body>
    </html>
