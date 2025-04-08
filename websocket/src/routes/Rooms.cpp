//
// Created by Cyriac on 08/04/2025.
//

#include "../../include/routes/Rooms.hpp"

void Route::rooms(QString message, QWebSocket* socket) {
    Struct::User* userptr = Service::User::findUser(socket);
    if(userptr == nullptr) {
        std::string response = "{\"type\": \"failed\", \"message\": \"You must logged\"}";
        return WebSocketServer::sendMessage(socket, response.c_str());
    }

    if(!userptr->isAdmin) {
        std::string response = "{\"type\": \"failed\", \"message\": \"Forbidden\"}";
        return WebSocketServer::sendMessage(socket, response.c_str());
    }

    std::string response = "{\"type\": \"rooms\", \"rooms\": " + Service::Room::roomsToJson() + "}";
    return WebSocketServer::sendMessage(socket, response.c_str());
}