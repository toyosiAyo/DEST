<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Murewa Ayodele">
        <title>DEST</title>
        <link rel="shortcut icon" href="http://results.run.edu.ng/images/run_logo.png" type="image/png">
        <style>
            @font-face{
                font-family: Quicksand;
                src: url(http://results.run.edu.ng/fonts/Quicksand-Regular.otf);
            }

            @font-face{
                font-family: Quicksand;
                font-weight: bold;
                src: url(http://results.run.edu.ng/fonts/Quicksand-Bold.otf);
            }

            body, html{
                width: 100%;
                margin: 0;
                padding: 0;
                background-color: #ffffff;
            }

            header{
                width: 100%;
                height: 100px;
                background: #ffffff;
                border-bottom-style: solid;
                border-bottom-width: 1px;
                border-bottom-color: #eef0ef;
                padding-left: 50px;
                padding-right: 50px;
                padding-top: 5px;
            }

            header img {
                height: 90px;
            }

            header a {
                font-family: Quicksand;
                font-weight: bold;
                font-size: 22px;
                color: #555555;
            }

            .dp_container {
                float: right;
                margin-right: 100px;
                text-align: center;
            }

            #dp {
                height: 90px;
                border-style: solid;
                border-width: 1px;
                border-color: #ffffff;
                border-radius: 200px;
            }

            .dp_container a {
                font-family: Quicksand;
                font-weight: normal;
                font-size: 11px;
                color: #555555;
            }

            .result_container {
                width: 100%;
                background-color: #e8e9f1;
                font-family: Helvetica;
            }

            #blue{
                color: #1c2767;
            }

            .result_table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 70px;
            }

            .result_table th, .result_table td {
                padding: 10px 10px 10px 10px;
                font-family: Quicksand;
                font-weight: normal;
                border: 1px solid #e5e5e5;
            }

            .result_container tr:nth-child(even){
                background-color: #ffffff;
            }
            
            .result_container tr:nth-child(even) td{
                background-color: #ffffff;
            }

            .result_container th {
                background-color: #1c2767;
                color: #ffffff;
                text-align: left;
                font-size: 22px;
            }

            .result_table caption {
                width: 100%;
                text-align: center;
                background-color: #ffffff;
                font-family: Quicksand;
                font-weight: normal;
                color: #222222;
                padding-top: 20px;
                padding-bottom: 5px;
                font-size: 25px;
            }

            #logout_button{
                text-decoration: none;
                font-family: Quicksand;
                color: #7e0000;
            }

            #email-popup-button img {
                height: 20px;
                cursor: pointer;
            }

            footer{
                width: 100%;
                display: block;
                font-size: 14px;
                font-family: Quicksand;
                color: #2a2a2a;
                text-align: center;
                background-color: #ffffff;
            }

            #footer_border{
                height: 2px;
                width: 100%;
                background-color: #977b1f; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(left, #977b1f, #b99f39, #f4ec70); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(right, #977b1f, #b99f39, #f4ec70, #977b1f, #b99f39); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(bright, #977b1f, #b99f39, #f4ec70, #977b1f, #b99f39); /* For Firefox 3.6 to 15 */
                background: linear-gradient(to right, #977b1f, #b99f39, #f4ec70, #977b1f, #b99f39); /* Standard syntax */
                padding: 0;
                margin: 0;
            }

            footer img{
                width: 40px;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="http://results.run.edu.ng/images/logo.gif"/>
            <div class="dp_container">
                <table>
                    <tr>
                        <td><img id="dp" src="" /></td>
                        <td>
                            <a></a><br>
                            <a></a><br>
                            <a></a><br>
                        </td>
                    </tr>
                </table>
            </div>
        </header>
        <div id="footer_border"></div>
        <div class="result_container">
            
        </div>
        <footer>
        <div id="footer_border"></div>
        <table align="center">
            <tr>
                <td>
                    <img src="http://results.run.edu.ng/images/run_logo_2.png" />
                </td>
                <td>
                    &copy; Redeemer\'s University ' . date("Y") . '. All rights reserved<br>
                    <!-- This should not be considered official -->
                </td>
            </tr>
        </table>
    </footer>
    </body>
</html>