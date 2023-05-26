function modalAddNew(){
    $("#msnSystem").hide();
    $('#addNew').modal('show');
}


function getMyWallet(){
    $("#my-wallet-value").html("<span><i class='fa fa-spin fa-spinner fa-lg'></i></span>");

    $.ajax({
    url : 'api/my-wallet',
    type : 'GET',

    data: {
            "user_id":$('#logged-id').val(),
            "_token": $('#csrf-token')[0].content,
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

function transferOptions(){
    $("#transfer-options").show(500);
}

function cancelTransfer(){
    $("#transfer-options").hide(500);   
}

// Transfer Money
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

            $("#transfer-success-alert").html(data.message);
            $("#transfer-options").hide(500);
            $("#transfer-success-alert").show(500);
            getMyWallet();

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
        });
    }

}
