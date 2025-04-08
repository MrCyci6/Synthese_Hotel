//
// Created by Cyriac on 08/04/2025.
//

#ifndef CONNECTION_ROUTE_HPP
#define CONNECTION_ROUTE_HPP

#include "../Includes.hpp"
#include "../structs/Struct.hpp"
#include "../services/Service.hpp"
#include "../WebSocketServer.hpp"

namespace Route {
    void connection(QString message, QWebSocket* socket);
}

#endif //CONNECTION_HPP
