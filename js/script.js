
let statusBox = $('#status');

function send()
{
    $.ajax({
        url: 'ServerClass.php',
        cache: false,
        method: 'POST',
        data: $('form').serialize(),
        success: function(response) {
            if (typeof response === 'number') {
                lastPostId = -1;
                fetchData();
            }
        },
        error: function() {
            statusBox.html('Wystąpił błąd podczas wysyłania');
        }
    });
}

function fetchData()
{
    console.log('fetching...');
    $.ajax({
        url: 'ServerClass.php',
        cache: false,
        method: 'POST',
        data: {action: 'fetch', id: lastPostId},
        success: function (response) {
            parseResponse(response);
        },
        error: function() {
            statusBox.html('Wystąpił błąd...');
        }
    });
}

function parseResponse(response)
{
    try {
        let data = response.data;
        for(let i = 0; i < data.length; i++) {
            $('#chat-content').append('<p><strong>#' + data[i].id + ' ' + data[i].name + ':</strong> ' + data[i].content + ' <small>[' + data[i].created_at + ']</small></p>');
            lastPostId = parseInt(data[data.length-1].id);
        }
    } catch(error) {
        statusBox.html(error);
        //statusBox.html('Wystąpił błąd...');
    }

    $("#chat-content").scrollTop($("#chat-content")[0].scrollHeight);
}

function startChat(){
   setInterval( function() { fetchData(); }, 2000);
}

$(function(){
    startChat();
});