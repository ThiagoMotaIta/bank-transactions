
// Start user wallet amount
function getMyWallet(){
    $("#my-wallet-value").html("<span><i class='fa fa-spin fa-spinner fa-lg'></i></span>");

    $.ajax({
    url : 'api/my-wallet',
    type : 'GET',

    data: {
            "user_id":$('#logged-id').val(),
        },

    dataType: 'json',
    success: function(data){
        console.log(data);

        $("#my-wallet-value").html("");
        $("#payee-id").html("");

        for (var i=0; i < data.payload.length; i++) {

            $("#my-wallet-value").append(data.payload[0].value);

            if (data.payload[0].value == '0.00'){
                $("#transfer-button").html("");
                $("#transfer-button").hide();
            }
        }

        for (var i=0; i < data.userList[0].length; i++) {

            $("#payee-id").append("<option value='"+data.userList[0][i].id+"'>"+data.userList[0][i].name+"</option>");
        }

    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
    });

}

// Hide-show transaction DIV
function transferOptions(){
    $("#transfer-options").show(500);
}

function cancelTransfer(){
    $("#transfer-options").hide(500);   
}

// Check the mock API before call transaction function
function checkTransaction(){
    $("#load-transaction").html("<br/><span><i class='fa fa-spin fa-spinner fa-lg'></i> <br/><small>Aguarde... Estamos finalizando a sua Transferência :D</small></span>");
    $("#load-transaction").show();
    $.ajax({
    url : 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6',
    type : 'GET',

    dataType: 'json',
    success: function(data){
        console.log(data);

        if (data.message == "Autorizado"){
            transferValidation();   
        } else {
            $("#validationError").html("Por favor, informe os dados Obrigatórios");
            $("#validationError").show(500);
        }

    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
    });    
}

// Transfer Money Validation
function transferValidation(){

    var validado = true;

    if ($('#payee-id').val() == "" || $('#transfer-value').val() == "" || $('#transfer-value').val() == 0 || $('#transfer-value').val() == "0.00"){
        validado = false;
        $("#validationError").show(500);
    } else {
        $("#validationError").hide();
    }

    if(validado){

        $.ajax({
        url : 'api/transfer',
        type : 'POST',
        data: {
            "payer_id":$('#logged-id').val(),
            "payee_id": $("#payee-id").val(),
            "value": $("#transfer-value").val(),
            "_token": $('#csrf-token')[0].content,
        },
        dataType: 'json',
        success: function(data){
            console.log(data);

            // Send Notify if transaction gone well
            sendNotify();

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
        });
    }

}


// Notify payee user after transaction successfuly sent
function sendNotify(){
    $.ajax({
    url : 'http://o4d9z.mocklab.io/notify',
    type : 'GET',

    dataType: 'json',
    success: function(data){
        console.log(data);

        if (data.message == "Success"){
            $("#load-transaction").hide(500);
            $("#transfer-success-alert").html("<i class='fa fa-check'></i> Transferência realizada com sucesso!");
            $("#transfer-options").hide(500);
            $("#transfer-success-alert").show(500);
            getMyWallet();
        } else {
            $("#validationError").html("Transferência realizada, mas a notificação ainda não foi enviada.");
            $("#validationError").show(500);
        }

    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
    });
}
