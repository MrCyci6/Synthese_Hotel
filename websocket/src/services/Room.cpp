//
// Created by Cyriac on 07/04/2025.
//

#include "../../include/services/Room.hpp"

QList<Struct::Room> Service::Room::rooms = QList<Struct::Room>();

bool Service::Room::roomExist(std::string roomId) {
    for(int i = 0; i < rooms.size(); i++) {
        if(rooms[i].roomId == roomId) {
          return true;
        }
    }
    return false;
}

Struct::Room* Service::Room::findRoom(std::string roomId) {
    for(int i = 0; i < rooms.size(); i++) {
      if(rooms[i].roomId == roomId) {
        return &rooms[i];
      }
    }
    return nullptr;
}

Struct::Room* Service::Room::findRoomBySender(Struct::User* user) {
    for(int i = 0; i < rooms.size(); i++) {
        if(rooms[i].senders.contains(user)) {
            return &rooms[i];
        }
    }

    return nullptr;
}

void Service::Room::deleteRoom(std::string roomId) {
    for(int i = 0; i < rooms.size(); i++) {
        if(rooms[i].roomId == roomId) {
          rooms.removeAt(i);
        }
    }
}

void Service::Room::addSender(std::string roomId, Struct::User* user) {
    Struct::Room* room = findRoom(roomId);
    if(room == nullptr) {
        cout << "Room " << roomId << " does not exist" << endl;
        return;
    }

    room->senders.append(user);
}

void Service::Room::removeSender(std::string roomId, Struct::User* user) {
    Struct::Room* room = findRoom(roomId);
    if(room == nullptr) {
        cout << "Room " << roomId << " does not exist" << endl;
        return;
    }

    room->senders.removeAll(user);
}

void Service::Room::clearSender(Struct::User* user) {
    for(int i = 0; i < rooms.size(); i++) {
        if(rooms[i].senders.contains(user)) {
            rooms[i].senders.removeAll(user);
        }
    }
}

void Service::Room::addMessage(std::string roomId, Struct::Message message) {
    Struct::Room* room = findRoom(roomId);
    if(room == nullptr) {
        cout << "Room " << roomId << " does not exist" << endl;
        return;
    }

    room->messages.append(message);
}

void Service::Room::removeMessage(std::string roomId, Struct::Message message) {
    Struct::Room* room = findRoom(roomId);
    if(room == nullptr) {
        cout << "Room " << roomId << " does not exist" << endl;
        return;
    }

}

Struct::Room Service::Room::deleteAndCreateRoom(std::string roomId) {
    deleteRoom(roomId);

    Struct::Room room;
    room.messages = QList<Struct::Message>();
    room.roomId = roomId;
    room.senders = QList<Struct::User*>();

    rooms.append(room);

    return room;
}

Struct::Room Service::Room::createRoom() {
    Struct::Room room;
    room.messages = QList<Struct::Message>();
    room.roomId = Utils::UUID::generate_uuid();
    room.senders = QList<Struct::User*>();

    rooms.append(room);

    return room;
}

std::string Service::Room::roomsToJson() {
    std::string response = "{";
    for(int i = 0; i < rooms.size(); i++) {
        response += "\"" + rooms[i].roomId + "\": {";
        response += "\"senders\": [";
        for(int j = 0; j < rooms[i].senders.size(); j++) {
            Struct::User* user = rooms[i].senders[j];
            response += "{";
            response += "\"id\": " + std::to_string(user->id) + ",";
            response += "\"name\": \"" + user->name + "\",";
            response += "\"email\": \"" + user->email + "\",";
            response += "\"isAdmin\": ";
            response += user->isAdmin ? "true" : "false";
            response += "}";
            response += (j+1 == rooms[i].senders.size() ? "" : ",");
        }
        response += "],";

        response += "\"messages\": [";
        for(int j = 0; j < rooms[i].messages.size(); j++) {
            Struct::Message message = rooms[i].messages[j];
            response += "{";
            response += "\"sender\": \"" + message.sender.name + "\",";
            response += "\"content\": \"" + message.content + "\",";
            response += "\"timestamp\": " + std::to_string(message.timestamp);
            response += "}";
            response += (j+1 == rooms[i].messages.size() ? "" : ",");
        }
        response += "]";

        response += "}";
        response += (i+1 == rooms.size() ? "" : ", ");
    }
    response += "}";
    return response;
}