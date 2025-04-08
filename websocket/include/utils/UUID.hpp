//
// Created by Cyriac on 07/04/2025.
// from: https://gist.github.com/javierquevedo/ec65d82eeeba1cee8215067b311199b9
//

#ifndef UUID_H
#define UUID_H

#pragma once
#include "Includes.hpp"

namespace Utils {
    class UUID {
    public:
        /**
         * @brief Generates a uuid string in the form
         * b9317db-02a2-4882-9b94-d1e1defe8c56
         *
         * @return std::string
         */
        static std::string generate_uuid();

        /**
         * @brief
         *
         * @param len Length in bytes
         * @return std::string  String random hex chars (2x length of the bytes)
         */
        static std::string generate_hex(const unsigned int len);

    private:
        /**
         * @brief Generates a safe pseudo-random character
         *
         * @return unsigned int
         */
        static unsigned int random_char();
    };
}

#endif //UUID_H
