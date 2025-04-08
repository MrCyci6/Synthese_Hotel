//
// Created by Cyriac on 08/04/2025.
// From https://github.com/ISENLabs/volum-backend/blob/main/src/utils/debug.hpp
//

#ifndef DEBUG_HPP
#define DEBUG_HPP

#pragma once
#include "../Includes.hpp"

#define LOG_DEFAULT_POLICY true;

namespace Utils {
    class Debug {
    private:
        std::mutex mutex_;
        Debug(const Debug&) = delete;
        Debug& operator=(const Debug&) = delete;

        std::map<std::string, bool> prefixPolicies;
        std::map<std::string, int> prefixColors;
        static const bool defaultPolicy = LOG_DEFAULT_POLICY;
        int largestPrefix = 2;

        // Colors & rnd stuff
        std::vector<std::string> colors = {
            "\033[0;31m", "\033[0;32m", "\033[0;33m", "\033[0;34m", "\033[0;35m", "\033[0;36m",
            "\033[0;91m", "\033[0;92m", "\033[0;93m", "\033[0;94m", "\033[0;95m", "\033[0;96m"
        };
        std::random_device rd;
        std::mt19937 gen;

        int getRandomColor();

        bool checkWildcardPolicy(const std::string& prefix);

    public:

        Debug();

        static Debug& getInstance();

        static void Log(const std::string& log, const std::string& prefix);

        static std::string separator(int len, int skip);

        static void addShow(std::string prefix);

        static void addIgnore(std::string prefix);

        static void displayPolicies();
    };
}

#endif //DEBUG_HPP
