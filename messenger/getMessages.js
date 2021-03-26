$(document).ready(function() {
    var intervalId = window.setInterval(function(){
        let newMessage = getMessages();
    }, 999);
});

function getMessages() {
    let theReturn = "";
    $.ajax({
        type: "GET",
        url: 'getNewMessages.php',
        data: {conversation: 1},
        success: function(data){
            theReturn = data;
            updateMessages(data);
        }
    });

    return theReturn;
}

function updateMessages(data) {
    document.getElementById('messagesHere').innerHTML += data;
}