$(document).ready(function() {
    const getRemitaConfig = (callback) => {
        $.ajax({
          url: `get_remita_config?email=${email}&payType=${payType}`,
          type: 'GET',
          success: callback
        })
    }
    
    const makePayment = () => {
        var paymentEngine = RmPaymentEngine.init({
          key: 'QzAwMDAxNTY4NzN8OTU3M3w1OWUwZmVmMmUxYWYwZTlhMjk3MTU5MzIwNzcxNjc1NWYwYmI5ZWNkZWYyYzcwYWZiZGIwOGZkYmViYzhiYjI3MTkyYzA3MGRhOWZkZDgxNDhlMjdjNmVkMGI0ZjgwYjQ4ZDM1OTkwMzhmNzU4OTJmN2NjMTUxMTljZDY1NjA1NQ==',
          customerId: mat_no,
          firstName: firstname,
          lastName: surname,
          email: email,
          narration: "Special Payment",
          amount: amount,
          processRrr: true,
          extendedData: {
            customFields: [
              {
                name: "rrr",
                value: rrr,
              },
            ],
          },
          onSuccess: function (response) {
            console.log(response);
            console.log(response.amount);
            if(response.amount !== "" && response.transactionId !== "" && response.paymentReference !== ""){
              $.ajax({
                type : 'POST', 
                url  : `update_applicant_payment?paymentReference=${response.paymentReference}&desc=${payType}&transactionId=${response.transactionId}&amount=${response.amount}&email=${email}`,
                beforeSend: function() { 
                 $("#btn_foundation").html('<i class="fa fa-spinner fa-spin"></i> Logging Payment...');
                },
                success: function (response) {
                  console.log(response);
                  if(response.status == "ok"){
                    toastr.options;
                    toastr['success']('Transaction Successful');
                    $("#btn_foundation").html('Create Application');
                    window.location.href = 'get_app_form'
                  } 
                  else{
                    toastr.options;
                    toastr['error']('Payment Logging Failed');
                    $("#btn_foundation").html('Create Application');
                  }
                },
                error: function (response) {
                  $("#btn_foundation").html('Create Application');
                  toastr.options;
                  toastr['error'](response.responseJSON.msg);
                }
              });
            }
            else{
              $("#btn_foundation").html('Create Application');
              toastr.options;
              toastr['error']('Transaction Failed');
            }
            
          },

          onError: function (response) {
            console.log(response);
            toastr.options;
            toastr['error']('Network error, Try again later!');
            $("#btn_foundation").html('Create Application');
          },

          onClose: function () {
            $("#btn_foundation").html('Create Application');
          }
        });

        paymentEngine.showPaymentWidget();
    }
    
    const processPayment = () => {
        console.log(payType)
        console.log(serviceTypeId)
        console.log(email)
        toHash = merchantId+serviceTypeId+orderId+amount+apiKey;
        apiHash = sha512(toHash);
        settings = {
          "url": "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit",
          "method": "POST",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json",
            "Authorization": "remitaConsumerKey="+merchantId+",remitaConsumerToken="+apiHash
          },
          "data": JSON.stringify({  
            "serviceTypeId": serviceTypeId,
            "amount": amount,
            "orderId": orderId,
            "payerName": fullname,
            "payerEmail": email,
            "payerPhone": phone,
            "description": desc
          }),
        };
        
        $.ajax({
            type : 'GET', 
            url  : `check_pend_rrr?email=${email}&payType=${payType}`,
            beforeSend: function() { 
             $("#btn_foundation").html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            },
            success: function (response) {
              if(response.status == 'ok'){
                rrr = response.p_rrr;
                console.log(rrr);
                $("#btn_foundation").html('<i class="fa fa-spinner fa-spin"></i> Processing Payment...');
                makePayment();
              }
              else if(response.status == 'Nok'){
                $.ajax(settings).done(function (res) {
                  var obj= res.substring(7,res.length-1);
                  var objJson = JSON.parse(obj);
                   rrr = objJson.RRR;
                   console.log(rrr);
                   $.ajax({
                      type : 'POST', 
                      url  : `log_new_rrr?email=${email}&rrr=${rrr}&amount=${amount}&payerName=${fullname}&payType=${payType}&statuscode=${objJson.statuscode}&statusMsg=${objJson.status}&orderID=${orderId}`,
                      beforeSend: function() { 
                       $("#btn_foundation").html('<i class="fa fa-spinner fa-spin"></i> Logging RRR...');
                      },
                      success: function (response) {
                        console.log(response);
                        if(response.status == "ok"){
                          alert("Proceed to Pay");
                          $("#btn_foundation").html('<i class="fa fa-spinner fa-spin"></i> Processing Payment...');
                          makePayment();
                        }
                        else{
                           $("#btn_foundation").html('Create Application');
                           toastr.options;
                           toastr['error'](response.msg); 
                        }
                      },
                      error: function (response) {
                        console.log(response);
                        $("#btn_foundation").html('Create Application');
                        toastr.options;
                        toastr['error'](response.responseJSON.msg);
                      }
                    });
                });
              }
              else{
                $("#btn_foundation").html('Create Application');
                toastr.options;
                toastr['error']('Network Error!, Try again later');
              }                   
            },
            error: function (response) {
                console.log(response);
                $("#btn_foundation").html('Create Application');
                toastr.options;
                toastr['error'](response.responseJSON.msg);
            }
        });
    }
    
    $("#foundation_payment").on("submit", function(e){
        e.preventDefault();
        $("#btn_foundation").html('<i class="fa fa-spinner fa-spin"></i>');
        payType = $("#payType").val();
        console.log(payType);
        desc = 'Application Payment';
        email = $("#email").val();
        amount = $("#amount").val();
        
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "5000",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        
        
        getRemitaConfig(function(response) {
            //config_data = JSON.parse(response);
            if(response.status === 'Nok'){
                merchantId = response.data.merchantId;
                serviceTypeId = response.data.serviceTypeID;
                apiKey = response.data.apiKey;
                orderId = response.data.orderID;
                phone = response.data.phone;
                firstname = response.data.firstname;
                surname = response.data.surname;
                fullname = firstname + ' ' + surname;
                console.log(serviceTypeId);
                setTimeout(function() {
                    processPayment();
                }, 5000);
            }
            else if(response.status === 'ok'){
               // window.location.href = 'get_app_form'
            }
            else{ return false }
        });
        
    });
});