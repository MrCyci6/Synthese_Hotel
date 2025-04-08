//
// Created by Cyriac on 08/04/2025.
//

#include "../../include/routes/Close.hpp"

void Route::close(QString message, QWebSocket* socket) {
    Struct::User* userptr = Service::User::findUser(socket);
    if(userptr != nullptr) {
        Struct::Room* roomptr = Service::Room::findRoomBySender(userptr);
        if(roomptr != nullptr) {
            Service::Room::removeSender(roomptr->roomId, userptr);
        }

        Utils::Debug::Log(userptr->name + " disconnected", "DISCONNECTION");
    }
}