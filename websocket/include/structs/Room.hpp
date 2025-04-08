//
// Created by Cyriac on 07/04/2025.
//

#ifndef ROOM_STRUCT_HPP
#define ROOM_STRUCT_HPP

#pragma once
#include "../Includes.hpp"

namespace Struct {
    struct Room {
        QList<User*> senders;
        std::string roomId;
        QList<Message> messages;
    };
}

#endif //ROOM_HPP
