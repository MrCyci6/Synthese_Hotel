//
// Created by Cyriac on 07/04/2025.
//

#ifndef USER_STRUCT_HPP
#define USER_STRUCT_HPP

#pragma once
#include "../Includes.hpp"

namespace Struct {
    struct User {
        int id;
        bool isAdmin;
        std::string name;
        std::string email;
        QWebSocket* socket;
    };
}

#endif //USER_HPP
