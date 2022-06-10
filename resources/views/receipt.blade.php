<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Student Payment Receipt</title>

        <style>
            body{
                font-family:Verdana, Geneva, sans-serif;
                font-size:14px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <table width="100" border="1" align="center" cellpadding="5" cellspacing="0">
            <tr>
                <td>
                    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3" align="left"><img src="{{ asset('assets/images/runny.png') }}" width="300" height="100" /></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center"><table width="100%" cellspacing="0" cellpadding="5" class="course_reg" border="0">
                                    <tr>
                                        <td width="94%" align="center"><br />
                                            <hr />
                                            <p><strong>  PAYMENT RECEIPT</strong></p>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td width="80%" valign="top"><table width="67%" cellspacing="0" cellpadding="5" class="course_reg" border="0">
                                                            <tr>
                                                                <td align="left" nowrap="nowrap"><strong>Student Name</strong></td>
                                                                <td align="left">{{$payment_data->names}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="49%" align="left" nowrap="nowrap"><strong>Payment Id</strong></td>
                                                                <td width="51%" align="left">{{$payment_data->trans_ref}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" nowrap="nowrap"><strong> Date of Deposit</strong></td>
                                                                <td align="left">{{ date("d M Y", strtotime($payment_data->updated_at)) }}</td>
                                                            </tr>
                                                            
                                                             <tr>
                                                                <td align="left" nowrap="nowrap"><strong>Session</strong></td>
                                                                <td align="left">{{$payment_data->session}}</td>
                                                            </tr>
                                                      </table>
                                                    </td>
                                                    <td width="20%" valign="top"><table width="150" height="143" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td height="143" align="center" valign="top"><img src="{{asset('storage/'. $payment_data->profile_pix) }}" width="118" height="139" border="2" /></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="95%" border="1" align="center" cellpadding="10" cellspacing="0" class="course_reg">
                                                <tr>
                                                    <td width="10%" align="center" bgcolor="#0099CC"><strong>S/N</strong></td>
                                                    <td width="71%" bgcolor="#0099CC"><strong>Payment Description</strong></td>
                                                    <td width="19%" bgcolor="#0099CC"><strong>Amount</strong></td>
                                                </tr>
                                                <tr class="tn">
                                                    <td align="center" valign="top">1</td>
                                                    <td valign="top">{{$payment_data->pay_type}} Application Fee</td>
                                                    <td valign="top">N {{$payment_data->amount}}</td>
                                                </tr>
                                            </table>
                                            <table width="95%" border="0" align="center" cellpadding="10" cellspacing="0">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center"><img src="../bursar/bursar.jpg" width="319" height="145" border="0" /></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="center"><strong>Authorised Signature</strong></td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" bgcolor="#003D62"><strong style="color:#FFF">Note : Fees paid are not re-fundable.</strong></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>