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
RUN/DEST/REG/ADM/PT/{{21 -22}}    
                                                                                            
{{$data->address}}  
</pre>
        </div>

        <div class="divContents" align="justify">
            <p>
                Dear Mrs. Awoleye,
            </p>
            <h5>
                <u>
                    OFFER OF PROVISIONAL ADMISSION: DEGREE PROGRAMME
                </u>
            </h5>
            
            <p>   

                <p>With reference to your application for admission to a Part-Time degree programme in Redeemer’s
                    University, I have the pleasure to inform you that you have been offered provisional admission to
                    study for a degree course leading to the award of {{B.Sc. Degree in Accounting.}}
                </p>
                    
                <p>The duration of the programme is Six (6) semesters. Please note that this offer is provisional and can
                    be revoked if you fail to produce the original copies of your credentials.
                </p>

                <p>If you accept this offer, please complete the attached Acceptance form and return with an evidence
                    of payment of the Acceptance/Processing Fee (non-refundable deposit) of Twenty-Five Thousand
                    Naira (N25, 000.00) only, not later than {{Friday 11 th June, 2021}}
                </p>

                <p>Please note also that the offer maybe withdrawn if, within the stipulated time, you have not
                    completed and returned the Acceptance form.
                </p>

                <p>The University part time programme resumes for the {{2021/2022}} academic session on {{14 th June, 2021}}
                    Please come along with the completed acceptance form, originals and photocopies of your
                    credentials and two passport photograph to the Directorate of Educational Services and Training (DEST).
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