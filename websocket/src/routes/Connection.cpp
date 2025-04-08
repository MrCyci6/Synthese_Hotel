//
// Created by Cyriac on 08/04/2025.
//

#include "../../include/routes/Connection.hpp"

void Route::connection(QString message, QWebSocket* socket) {
    Document json;
    json.Parse(message.toStdString().c_str());

    Struct::User* userptr = Service::User::createUser(json, socket);
    Struct::Room room = Service::Room::deleteAndCreateRoom(Utils::UUID::generate_uuid());
    Service::Room::addSender(room.roomId, userptr);

    std::ostringstream oss;
    oss << userptr->name << " (" << static_cast<void*>(userptr) << ") -> " << room.roomId;
    Utils::Debug::Log(oss.str(), "CONNECTION");

    std::string response = "{\"type\": \"connected\", \"roomId\": \"" + room.roomId + "\"}";
    return WebSocketServer::sendMessage(socket, response.c_str());
}