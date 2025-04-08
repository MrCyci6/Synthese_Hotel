//
// Created by Cyriac on 07/04/2025.
//

#ifndef USER_SERVICE_HPP
#define USER_SERVICE_HPP

#pragma once
#include "../Includes.hpp"

#include "structs/Struct.hpp"

namespace Service {
    class User {
    private:
        static QList<Struct::User*> users;
    public:
        static bool userExists(QWebSocket* socket);
        static bool userExists(int userId);

        static Struct::User* findUser(QWebSocket* socket);

        static void deleteUser(QWebSocket* socket);
        static void deleteUser(int userId);

        static Struct::User* deleteAndCreateUser(Value& json, QWebSocket* socket);
        static Struct::User* createUser(Value& json, QWebSocket* socket);
    };
}

#endif //USER_HPP
