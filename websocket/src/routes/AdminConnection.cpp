//
// Created by Cyriac on 08/04/2025.
//

#include "../../include/routes/AdminConnection.hpp"

void Route::adminConnection(QString message, QWebSocket* socket) {
    Document json;
    json.Parse(message.toStdString().c_str());

    Struct::User* userptr = Service::User::deleteAndCreateUser(json, socket);
    if(!userptr->isAdmin) {
        std::string response = "{\"type\": \"failed\", \"message\": \"Forbidden\"}";
        return WebSocketServer::sendMessage(socket, response.c_str());
    }

    Struct::Room* roomptr = Service::Room::findRoomBySender(userptr);
    if(roomptr != nullptr) {
        Service::Room::removeSender(roomptr->roomId, userptr);
    }

    std::string roomId = json["roomId"].GetString();
    roomptr = Service::Room::findRoom(roomId);
    if(roomptr == nullptr) {
        std::string response = "{\"type\": \"failed\", \"message\": \"Room does not exist\"}";
        return WebSocketServer::sendMessage(socket, response.c_str());
    }

    Service::Room::addSender(roomId, userptr);

    std::ostringstream oss;
    oss << userptr->name << " (" << static_cast<void*>(userptr) << ") -> " << roomId;
    Utils::Debug::Log(oss.str(), "ADMIN_CONNECTION");

    std::string response = "{\"type\": \"connected\", \"roomId\": \"" + roomId + "\"}";
    return WebSocketServer::sendMessage(socket, response.c_str());
}