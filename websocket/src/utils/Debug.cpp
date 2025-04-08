//
// Created by Cyriac on 08/04/2025.
//

#include "../../include/utils/Debug.hpp"

Utils::Debug::Debug() : gen(rd()) {}

int Utils::Debug::getRandomColor() {
    std::uniform_int_distribution<> dis(0, colors.size() - 1);
    return dis(gen);
}

bool Utils::Debug::checkWildcardPolicy(const std::string& prefix) {
    for (const auto& policy : prefixPolicies) {
        if (policy.first.back() == '*') {
            if (prefix.compare(0, policy.first.length() - 1, policy.first, 0, policy.first.length() - 1) == 0) {
                return policy.second;
            }
        }
    }
    return defaultPolicy;
}

Utils::Debug& Utils::Debug::getInstance() {
    static Debug instance;
    return instance;
}

void Utils::Debug::Log(const std::string& log, const std::string& prefix) {
    auto& _debug = Debug::getInstance();
    bool locked = false;
    // Unknown prefix ? Add it to the policies and assign a color
    if(_debug.prefixPolicies.find(prefix) == _debug.prefixPolicies.end()) {
        bool policy = _debug.checkWildcardPolicy(prefix);
        std::lock_guard<std::mutex> lock(_debug.mutex_);
        locked = true;
        _debug.prefixPolicies[prefix] = policy;
        _debug.prefixColors[prefix] = _debug.getRandomColor();
        if(prefix.length() > _debug.largestPrefix)
            _debug.largestPrefix = prefix.length();
    }

    if(_debug.prefixPolicies[prefix]) {
        if(!locked) std::lock_guard<std::mutex> lock(_debug.mutex_);
        std::cout << _debug.colors[_debug.prefixColors[prefix]]
                  << "\e[1m" // bold
                  << "[" << prefix << "]"
                  << "\e[0m" // non bold
                  << _debug.colors[_debug.prefixColors[prefix]]
                  << separator(_debug.largestPrefix, prefix.length())
                  << log
                  << "\033[0m" // Reset color
                  << std::endl;
    }
}

std::string Utils::Debug::separator(int len, int skip){
    std::string sep("");
    for(int i = skip; i < len+2; i ++)
        sep += " ";
    return sep;
}

void Utils::Debug::addShow(std::string prefix){
    auto& _debug = Debug::getInstance();
    std::lock_guard<std::mutex> lock(_debug.mutex_);
    // Wildcard ?
    if(prefix[prefix.length()-1] == '*'){
        for(auto& it : _debug.prefixPolicies){
            if(it.first.substr(0, prefix.length()-1) == prefix.substr(0, prefix.length()-1)){
                std::cout << "Showing " << it.first << std::endl;
                it.second = true;
            }
        }
    }
    _debug.prefixPolicies[prefix] = true;
}

void Utils::Debug::addIgnore(std::string prefix){
    auto& _debug = Debug::getInstance();
    std::lock_guard<std::mutex> lock(_debug.mutex_);
    // Wildcard ?
    if(prefix[prefix.length()-1] == '*'){
        for(auto& it : _debug.prefixPolicies){
            if(it.first.substr(0, prefix.length()-1) == prefix.substr(0, prefix.length()-1)){
                std::cout << "Ignoring " << it.first << std::endl;
                it.second = false;
            }
        }
    }
    _debug.prefixPolicies[prefix] = false;
}

void Utils::Debug::displayPolicies(){
    auto& _debug = Debug::getInstance();

    for(auto it : _debug.prefixPolicies){
        std::cout << "  " << it.first << " : " << (it.second ? "true" : "false") << std::endl;
    }
}