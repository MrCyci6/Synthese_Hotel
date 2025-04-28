
'use strict';

let websocket;
let user = {
    "id": 1,
    "name": "Super Admin",
    "email": "admin@hotel.fr"
}

websocket = new WebSocket('ws://192.168.186.88:12345');

websocket.onopen = () => {
    const params = new URLSearchParams(document.location.search);
    const roomId = params.get("room_id");
    
    if(roomId) {
        websocket.send(JSON.stringify({
            "type": "admin_connection",
            "roomId": roomId,
            user: user
        }));
    } else {
        websocket.send(JSON.stringify({
            "type": "connection",
            user: user
        }));
    }

    websocket.send(JSON.stringify({"type": "rooms"}))
}

websocket.onmessage = (event) => {
    const data = JSON.parse(event.data);
    if(data.type == "connected") {
        $('#chat-room').text($('#chat-room').text() + `Connecté à la salle ${data.roomId}\n`);
        $('#chat-room').scrollTop($('#chat-room').prop('scrollHeight'))
    } else if(data.type == "message") {
        $('#chat-room').text($('#chat-room').text() + `${data.sender} : ${data.content}\n`);
        $('#chat-room').scrollTop($('#chat-room').prop('scrollHeight'))
    } else if(data.type == "rooms") {
        for(const roomId in data.rooms) {
            const room = data.rooms[roomId];
            const params = new URLSearchParams(document.location.search);
            const hotelId = params.get("hotel_id");
            
            $('#rooms').html(
                $('#rooms').html() + `<a href="support?hotel_id=${hotelId}&room_id=${roomId}" class="d-flex justify-content-between">
                    <span>${roomId}</span>
                    <span>${room.senders.length} utilisateur(s)</span>
                    <span>${room.messages.length} message(s)</span>
                </a>`
            )
        }
    } else {
        console.log(data)
    }
}

websocket.onclose = (event) => {
    console.log("Le serveur a fermé la connexion");
}

document.addEventListener("submit", (event) => {
    event.preventDefault();
    let message = event.target.input.value;

    console.log(message)
    
    websocket.send(JSON.stringify(
        {
            "type": "message",
            "sender": user.name,
            "content": message,
            "timestamp": Date.now()
        }
    ));
    
    event.target.input.value = "";
})
