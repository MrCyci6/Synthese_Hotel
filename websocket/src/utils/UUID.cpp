//
// Created by Cyriac on 07/04/2025.
//

#include "../include/utils/UUID.hpp"

std::string Utils::UUID::generate_uuid() {
    std::stringstream hexstream;
    hexstream << Utils::UUID::generate_hex(4) << "-" << Utils::UUID::generate_hex(2) << "-"
              << Utils::UUID::generate_hex(2) << "-" << Utils::UUID::generate_hex(2) << "-"
              << Utils::UUID::generate_hex(6);
    return hexstream.str();
}

unsigned int Utils::UUID::random_char() {
    std::random_device rd;
    std::mt19937 gen(rd());
    std::uniform_int_distribution<> dis(0, 255);
    return dis(gen);
}

std::string Utils::UUID::generate_hex(const unsigned int len) {
    std::stringstream ss;
    for (auto i = 0; i < len; i++) {
        const auto rc = random_char();
        std::stringstream hexstream;
        hexstream << std::hex << rc;
        auto hex = hexstream.str();
        ss << (hex.length() < 2 ? '0' + hex : hex);
    }
    return ss.str();
}