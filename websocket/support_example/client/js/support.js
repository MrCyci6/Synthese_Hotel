
'use strict';

let websocket;
let user = {
    "id": 2,
    "name": "Cyriac Lenoir",
    "email": "cyriac@hotel.fr"
}

websocket = new WebSocket('ws://192.168.186.88:12345');

websocket.onopen = (event) => {
    websocket.send(JSON.stringify({
        "type": "connection",
        user: user
    }));
}

websocket.onmessage = (event) => {
    const data = JSON.parse(event.data);
    if(data.type == "connected") {
        $('#chat-room').text($('#chat-room').text() + `Connecté à la salle ${data.roomId}\n`);
        $('#chat-room').scrollTop($('#chat-room').prop('scrollHeight'))
    } else if(data.type == "message") {
        $('#chat-room').text($('#chat-room').text() + `${data.sender} : ${data.content}\n`);
        $('#chat-room').scrollTop($('#chat-room').prop('scrollHeight'))
    } else {
        console.log(data)
    }
}

websocket.onclose = (event) => {
    console.log("Le serveur a fermé la connexion");
}

window.addEventListener("submit", (event) => {
    event.preventDefault();
    let message = event.target.input.value;
    websocket.send(JSON.stringify(
        {
            "type": "message",
            "sender": user.name,
            "content": message,
            "timestamp": Date.now()
        }
    ))
    event.target.input.value = "";
})
