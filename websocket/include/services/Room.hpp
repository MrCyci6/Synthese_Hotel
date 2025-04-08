//
// Created by Cyriac on 07/04/2025.
//

#ifndef ROOM_SERVICE_HPP
#define ROOM_SERVICE_HPP

#pragma once
#include "../Includes.hpp"
#include "structs/Struct.hpp"

namespace Service {
    class Room {
    private:
        static QList<Struct::Room> rooms;
    public:
        static bool roomExist(std::string roomId);

        static Struct::Room* findRoom(std::string roomId);
        static Struct::Room* findRoomBySender(Struct::User* user);

        static void deleteRoom(std::string roomId);

        static void addSender(std::string roomId, Struct::User* user);
        static void removeSender(std::string roomId, Struct::User* user);
        static void clearSender(Struct::User* user);

        static void addMessage(std::string roomId, Struct::Message message);
        static void removeMessage(std::string roomId, Struct::Message message);

        static Struct::Room deleteAndCreateRoom(std::string roomId);
        static Struct::Room createRoom();

        static std::string roomsToJson();
    };
}

#endif //ROOM_H
