<!DOCTYPE HTML>

<html>
    <head>
        <style type="text/css">
            html {
            margin:0;
            padding:0; 
            }
            @page {
                size: A4;
                margin-top:0.5cm;
                margin-bottom:0;
                margin-left:0;
                margin-right:0;
                padding: 0;
            }
            
            .bodyBody {
                font-family: Arial;
                font-size: 11px;
                /* background-image: url('/www/wwwroot/trans/public/assets/images/original.jpg'); */
                background-size: contain;
                background-repeat: no-repeat;

            }
            .divHeader {
                text-align: right;
                border: 1px solid;
            }
            .divReturnAddress {
                text-align: left;
                float: right;
            }
            .divSubject {
                clear: both;
                font-weight: bold;
                padding-top: 80px;
            }
            .divAdios {
                float: left;
                padding-top: 50px;
            }
            .main{
                margin: 20% auto;
                padding-top: 5px;
                padding-right: 30px; 
                padding-bottom: 15px; 
                padding-left: 30px; 
            }
        </style>
    </head>
    <body class="bodyBody">
            <div class="main"> 
            <div class="divSubject">
<pre>
{{date("F j, Y")}}  
RUN/DEST/REG/ADM/FUND/21-22    
                                                                                            
{{$data->address}}  
</pre>
        </div>

        <div class="divContents" align="justify">
            <p>
                Dear. Mr. Ajayi,
            </p>
            <h5>
                <u>
                    OFFER OF PROVISIONAL ADMISSION: FOUNDATION PROGRAMME
                </u>
            </h5>
            
            <p>   

                <p>With reference to your application for admission to the Foundation Programme of Redeemer’s
                    University and further to the screening exercise, I have the pleasure to inform you that you have been
                    offered provisional admission into the Foundation Programme of the Redeemer’s University, Ede,
                    Osun-State
                </p>
                    
                <p>The duration of the programme is one academic session. You are required to write JUPEB (Joint
                    Universities Preliminary Examinations Board) examinations and, upon successful completion and
                    satisfactory performance, you will be eligible for admission into {{3}}-years degree programme
                    {{Computer Science}} of the Redeemer’s University, Ede, Osun-State via JAMB Direct Entry option.
                </p>

                <p>Please note that this offer is provisional and can be revoked, if you fail to produce the necessary
                    documents that qualifies you for the programme.
                </p>

                <p>If you accept the offer, please complete the <u>Acceptance Form</u> and return same with evidence of
                    payment of the Acceptance/Processing Fee (non-refundable deposit) of <u>Ninety Thousand, Six
                    Hundred Naira (₦90,600.00) and Twenty-Seven Thousand Naira (₦27,000) for JUPEB
                    Examinations</u> not later than October 15 th , 2021. The procedure for payment of fees is herewith
                    attached.
                </p>

                <p>Please note also that the offer may be withdrawn if, within the above stipulated time, you have not
                    completed and returned the Acceptance Form.
                </p>

                <p>
                    Your programme commences on 18 th October, 2021 with registration, which lasts till Friday 22nd October, 2021
                </p>

                <p>
                    Accept my congratulations.
                </p>

                Yours sincerely,

            </p>
            
        </div>

        <div class="divAdios">
            Samuel Ajayi<br>
            Administrative Officer, Directorate of Educational Services and Training (DEST)<br>
            E-mail: info.dest@run.edu.ng.
        </div>
    </body>
</html>