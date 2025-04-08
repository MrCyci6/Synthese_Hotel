//
// Created by Cyriac on 08/04/2025.
//

#ifndef CLOSE_ROUTE_HPP
#define CLOSE_ROUTE_HPP

#include "../Includes.hpp"
#include "../structs/Struct.hpp"
#include "../services/Service.hpp"

namespace Route {
    void close(QString message, QWebSocket* socket);
}

#endif //CLOSE_HPP
