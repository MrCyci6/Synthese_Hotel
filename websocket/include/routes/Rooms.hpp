//
// Created by Cyriac on 08/04/2025.
//

#ifndef ROOMS_ROUTE_HPP
#define ROOMS_ROUTE_HPP

#include "../Includes.hpp"
#include "../structs/Struct.hpp"
#include "../services/Service.hpp"
#include "../WebSocketServer.hpp"

namespace Route {
    void rooms(QString message, QWebSocket* socket);
}

#endif //ROOMS_HPP
