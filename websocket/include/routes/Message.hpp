//
// Created by Cyriac on 08/04/2025.
//

#ifndef MESSAGE_ROUTE_HPP
#define MESSAGE_ROUTE_HPP

#include "../Includes.hpp"
#include "../structs/Struct.hpp"
#include "../services/Service.hpp"
#include "../WebSocketServer.hpp"

namespace Route {
    void message(QString message, QWebSocket* socket);
}

#endif //MESSAGE_HPP
