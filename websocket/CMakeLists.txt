cmake_minimum_required(VERSION 3.16)
project(WebSocket VERSION 1.0.0 LANGUAGES CXX)

set(CMAKE_CXX_STANDARD 17)
set(CMAKE_CXX_STANDARD_REQUIRED ON)
set(CMAKE_AUTOMOC ON)
set(CMAKE_AUTOUIC ON)
set(CMAKE_AUTORCC ON)

find_package(Qt5 REQUIRED COMPONENTS Core WebSockets)

set(SOURCES main.cpp
    src/WebSocketServer.cpp

    src/utils/UUID.cpp
    src/utils/Debug.cpp

    src/services/User.cpp
    src/services/Room.cpp

    src/routes/AdminConnection.cpp
    src/routes/Close.cpp
    src/routes/Connection.cpp
    src/routes/Message.cpp
    src/routes/Rooms.cpp
)
set(HEADERS include/Main.hpp
    include/Includes.hpp
    include/WebSocketServer.hpp

    include/utils/UUID.hpp
    include/utils/Debug.hpp

    include/structs/User.hpp
    include/structs/Message.hpp
    include/structs/Room.hpp
    include/structs/Struct.hpp

    include/services/User.hpp
    include/services/Message.hpp
    include/services/Room.hpp
    include/services/Service.hpp

    include/routes/AdminConnection.hpp
    include/routes/Close.hpp
    include/routes/Connection.hpp
    include/routes/Message.hpp
    include/routes/Rooms.hpp
)

add_executable(WebSocket ${SOURCES} ${HEADERS})

target_include_directories(WebSocket PUBLIC libs/rapidjson/include)
target_include_directories(WebSocket PRIVATE include)
target_link_libraries(WebSocket PRIVATE Qt5::Core Qt5::WebSockets)