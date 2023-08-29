<table class="wrapper" role="module" data-type="image" border="0"
    cellpadding="0" cellspacing="0" width="100%"
    style="table-layout: fixed;"
    data-muid="d8508015-a2cb-488c-9877-d46adf313282">
    <tbody>
        <tr>
        <td
            style="font-size:6px; line-height:10px; padding:0px 0px 0px 0px;"
            valign="top" align="center">
            <img class="max-width" border="0"
            style="display:block; color:#000000; text-decoration:none; font-family:Helvetica, arial, sans-serif; font-size:16px;"
            width="100%" alt=""
            data-proportionally-constrained="true"
            data-responsive="false" src="https://dest.run.edu.ng/img/Runny.png">
        </td>
        </tr>
    </tbody>
</table>
<table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
    <tbody>
        <tr>
            <td style="text-align:left;padding: 0 30px 20px">
                <p style="margin-bottom: 10px;">Dear.
                    @if(strtoupper($data->sex) == 'M') {{'Mr.'}}
                        @elseif(strtoupper($data->sex) == 'F') {{'Miss'}}
                        @else <b>{{''}}</b>
                    @endif
                        {{$data->surname.' '.$data->first_name}}  
                </p>
                <p style="margin-bottom: 25px;">With reference to your application for admission to the {{$data->app_type}} Programme of Redeemer’s
                    University and further to the screening exercise, I have the pleasure to inform you that you have been
                    offered provisional admission into the {{$data->app_type}} Programme of the Redeemer’s University, Ede
                    Osun-State
                </p>
                <p>Kindly find attached the necessary documents and logon to your portal (https://destadms.run.edu.ng) to download your admission letter</p>
                <p>Thank you</p>

            </td>
        </tr>
        <tr>
            <td style="text-align:center;padding: 20px 30px 40px">
                <p style="margin: 0; font-size: 13px; line-height: 22px; color:#9ea8bb;">This is an automatically generated email please do not reply to this email. If you face any issues, please contact us</p>
                <p>Redeemers University, Ede/  info.dest@run.edu.ng / https://dest.run.edu.ng</p>
            </td>
        </tr>
    </tbody>
</table>
