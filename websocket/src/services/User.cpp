//
// Created by Cyriac on 07/04/2025.
//

#include "../../include/services/User.hpp"

#include <bits/fs_fwd.h>

QList<Struct::User*> Service::User::users = QList<Struct::User*>();

bool Service::User::userExists(QWebSocket* socket) {
    for(int i = 0; i < users.size(); i++) {
        if(users[i]->socket == socket) {
            return true;
        }
    }
    return false;
}

bool Service::User::userExists(int userId) {
    for(int i = 0; i < users.size(); i++) {
        if(users[i]->id == userId) {
            return true;
        }
    }
    return false;
}

Struct::User* Service::User::findUser(QWebSocket* socket) {
    for(int i = 0; i < users.size(); i++) {
        if(users[i]->socket == socket) {
            return users[i];
        }
    }
    return nullptr;
}

void Service::User::deleteUser(QWebSocket* socket) {
    for(int i = 0; i < users.size(); i++) {
        if(users[i]->socket == socket) {
            users.removeAt(i);
        }
    }
}

void Service::User::deleteUser(int userId) {
    for(int i = 0; i < users.size(); i++) {
        if(users[i]->id == userId) {
            users.removeAt(i);
        }
    }
}

Struct::User* Service::User::deleteAndCreateUser(Value& json, QWebSocket* socket) {
    deleteUser(socket);
    deleteUser(json["user"]["id"].GetInt());

    return createUser(json, socket);
}

Struct::User* Service::User::createUser(Value& json, QWebSocket* socket) {
    auto user = new Struct::User();
    user->id = json["user"]["id"].GetInt();
    user->isAdmin = user->id == 1 ? true : false;
    user->name = json["user"]["name"].GetString();
    user->email = json["user"]["email"].GetString();
    user->socket = socket;

    users.append(user);
    return user;
}