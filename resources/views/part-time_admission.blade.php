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
            }
            .divAdios {
                float: left;
                padding-top: 40px;
            }
            .main{
                margin: 5% auto;
                padding-right: 30px; 
                padding-bottom: 5px; 
                padding-left: 30px; 
            }
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 400px;
                height: auto;
            }
        </style>
    </head>
    <body class="bodyBody">
            <div class="main"> 
            <div class="divSubject">
                <header>
                    <img src="https://dest.run.edu.ng/img/Runny.png" class="center"/>
                </header>
<pre>
{{date("d M Y", strtotime($data->approved_at))}} 
RUN/DEST/REG/ADM/PT/{{$data->session_formulated}}
                                                                                            
{{$data->address_resident}}  
</pre>
        </div>

        <div class="divContents" align="justify">
            <p>
            Dear.
                @if(strtoupper($data->sex) == 'M') {{'Mr.'}}
                    @elseif(strtoupper($data->sex) == 'F') {{'Miss'}}
                    @else <b>{{''}}</b>
                    @endif
                    {{$data->surname.' '.$data->first_name.' '.$data->other_name}} 
            </p>
            <h5>
                <u>
                    OFFER OF PROVISIONAL ADMISSION: DEGREE PROGRAMME
                </u>
            </h5>
            
            <p>   

                <p>With reference to your application for admission to a Part-Time degree programme in Redeemer’s
                    University, I have the pleasure to inform you that you have been offered provisional admission to
                    study for a degree programme leading to the award of {{$data->degree_4_pt}}
                </p>
                    
                <p>The duration of the programme is {{ $data->duration }} semesters. Please note that this offer is provisional and can
                    be revoked if you fail to produce the original copies of your credentials.
                </p>

                <p>If you accept this offer, please complete the attached Acceptance form and return with an evidence
                    of payment of the Acceptance/Processing Fee (non-refundable deposit) of Twenty-Five Thousand
                    Naira (N25, 000.00) only, not later than {{ $data->accept_date}}
                </p>

                <p>Please note also that the offer maybe withdrawn if, within the stipulated time, you have not
                    completed and returned the Acceptance form.
                </p>

                <p>The University part time programme resumes for the {{$data->session_admitted}} academic session on {{$data->resumption_date}}.
                    Please come along with the completed acceptance form, originals and photocopies of your
                    credentials and two passport photographs to the Directorate of Educational Services and Training (DEST).
                </p>                

                <p>
                    Accept my congratulations.
                </p>

            </p>
        </div>

        <div class="divAdios">
            Yours sincerely,<br>
            <img alt="" src="https://destadms.run.edu.ng/images/sd.png" style=" height: auto; width: 100px;" title="DEST" /><br>
            Samuel Ajayi<br>
            Administrative Officer, Directorate of Educational Services and Training (DEST)<br>
            E-mail: info.dest@run.edu.ng.
        </div>
    </body>
</html>