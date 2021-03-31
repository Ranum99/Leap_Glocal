$(document).ready(function() {
    let messagesDiv = document.getElementById('messagesHere');
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
    var intervalId = window.setInterval(function(){
        getMessages();
    }, 1001);


});

function getMessages() {
    let theReturn = "";
    $.ajax({
        type: "GET",
        url: 'getNewMessages.php',
        data: {conversation: 1},
        success: function(data){
            if (data !== null && data !== "") {
                theReturn = data;
                updateMessages(data);
            }
        }
    });

    return theReturn;
}

function updateMessages(data) {
    document.getElementById('messagesHere').innerHTML += data;
    let messagesDiv = document.getElementById('messagesHere');
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}