//
// Created by Cyriac on 07/04/2025.
//

#ifndef MESSAGE_STRUCT_HPP
#define MESSAGE_STRUCT_HPP

#pragma once
#include "../Includes.hpp"

namespace Struct {
    struct Message {
        User sender;
        std::string content;
        qint64 timestamp;
    };
}

#endif //MESSAGE_HPP
