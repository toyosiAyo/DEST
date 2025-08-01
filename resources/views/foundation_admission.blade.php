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
                /* padding-top: 5px; */
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
RUN/DEST/REG/ADM/FUND/{{$data->session_formulated}} 
                                                                                    
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
                    satisfactory performance, you will be eligible for admission into {{$data->duration}}-year degree programme
                    {{$data->Programme1}} of the Redeemer’s University, Ede, Osun-State via JAMB Direct Entry option.
                </p>

                <p>Please note that this offer is provisional and can be revoked, if you fail to produce the necessary
                    documents that qualifies you for the programme.
                </p>

                <p>If you accept the offer, please complete the <u>Acceptance Form</u> and return same with evidence of
                    payment of the Acceptance Fee (non-refundable deposit) of <u>Fifty Thousand,
                    (₦50,000.00) and Fifty-Five Thousand Naira (₦55,000) for JUPEB
                    Examinations</u> not later than {{$data->accept_date}}. The procedure for payment of fees is herewith
                    attached.
                </p>

                <p>Please note also that the offer may be withdrawn if, within the above stipulated time, you have not
                    completed and returned the Acceptance Form, moreover it is mandatory for the fees to be paid before JUPEB examination commences,
                    otherwise you will not be allowed into the examination hall.
                </p>

                <p>
                    Your programme commences on {{$data->resumption_date}} with registration, which lasts till {{$data->registration_closing}}.
                </p>

                <p>
                    Accept my congratulations.
                </p>
            </p>
        </div>

        <div class="divAdios">
            Yours sincerely,<br>
            <img alt="" src="http://destadms.run.edu.ng/images/sd.png" style=" height: auto; width: 100px;" title="DEST" /><br>
            Samuel Ajayi<br>
            Senior Administrative Officer, Directorate of Educational Services and Training (DEST)<br>
            E-mail: info.dest@run.edu.ng.
        </div>
    </body>
</html>