$(document).ready(function() {
    $(function() {
        $("#messageToSend").keypress(function (e) {
            if(e.which === 13) {
                e.preventDefault();
                sendMessage();
            }
        });
    });

    $('#sendTheMessage').on('click', function () {
        sendMessage();
    });
});

function sendMessage() {
    let messageToSend = document.getElementById('messageToSend');
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const product = urlParams.get('message');

    $.ajax({
        url: "sendMessage.php",
        type: "POST",
        data: {
            conversation: product,
            message: messageToSend.value
        },
        cache: false,
        success: function(dataResult){
            if(dataResult === '200'){
                messageToSend.value = "";
            }
            else if(dataResult === '201'){
                alert("Error occured !");
            }
        }
    });
}