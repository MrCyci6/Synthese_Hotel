//
// Created by Cyriac on 08/04/2025.
//

#include "../../include/routes/Message.hpp"

void Route::message(QString message, QWebSocket* socket) {
    Document json;
    json.Parse(message.toStdString().c_str());

    Struct::User* userptr = Service::User::findUser(socket);
    if(userptr == nullptr) {
        std::string response = "{\"type\": \"failed\", \"message\": \"You must logged in before send message\"}";
        return WebSocketServer::sendMessage(socket, response.c_str());
    }

    Struct::Room* roomptr = Service::Room::findRoomBySender(userptr);
    if(roomptr == nullptr) {
        std::string response = "{\"type\": \"failed\", \"message\": \"You must join a room before send message\"}";
        return WebSocketServer::sendMessage(socket, response.c_str());
    }

    Struct::Message msg;
    msg.sender = *userptr;
    msg.content = json["content"].GetString();
    msg.timestamp = json["timestamp"].GetInt64();

    Utils::Debug::Log(roomptr->roomId + " -> " + userptr->name + " : " + msg.content, "MESSAGE");

    Service::Room::addMessage(roomptr->roomId, msg);
    return WebSocketServer::sendMessage(*roomptr, message);
}