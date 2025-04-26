//
// Created by Cyriac on 07/04/2025.
// Based on school archive
//

// Include.
#include "../include/WebSocketServer.hpp"

//------------------------------------------------------------------------------
//--- Constructor --------------------------------------------------------------
//------------------------------------------------------------------------------
WebSocketServer::WebSocketServer(QString name, int port, QObject* parent):
    QObject(parent),
    server(new QWebSocketServer(name, QWebSocketServer::NonSecureMode, this)) {

    if (this->server->listen(QHostAddress::Any, port)) {
        cout << name.toStdString() << " listening on port " << port << endl;
        connect(this->server, &QWebSocketServer::newConnection, this, &WebSocketServer::newConnection);
        connect(this->server, &QWebSocketServer::closed, this, &WebSocketServer::closed);
    }
}

//------------------------------------------------------------------------------
//--- Destructor ---------------------------------------------------------------
//------------------------------------------------------------------------------
WebSocketServer::~WebSocketServer() {
    this->server->close();
}

//------------------------------------------------------------------------------
//--- Method -------------------------------------------------------------------
//------------------------------------------------------------------------------
void WebSocketServer::sendMessage(QWebSocket* client, QString message) {
    client->sendTextMessage(message);
}

void WebSocketServer::sendMessage(Struct::Room room, QString message) {
    for (int j = 0; j < room.senders.size (); j++) {
        sendMessage(room.senders[j]->socket, message);
    }
}

//------------------------------------------------------------------------------
//--- Slots --------------------------------------------------------------------
//------------------------------------------------------------------------------
void WebSocketServer::newConnection() {
    QWebSocket* clientSocket;

    clientSocket = this->server->nextPendingConnection();

    /*cout << "Client connect: " << clientSocket->peerAddress()
        .toString().toStdString() << " (" << clientSocket << ")" << endl;*/

    connect(clientSocket, &QWebSocket::textMessageReceived, this, &WebSocketServer::messageReceived);
    connect(clientSocket, &QWebSocket::disconnected, this, &WebSocketServer::socketDisconnected);
}

//------------------------------------------------------------------------------
void WebSocketServer::socketDisconnected() {
    QWebSocket* clientSocket;

    clientSocket = qobject_cast<QWebSocket*>(sender());
    if(clientSocket) {
        Struct::User* userptr = Service::User::findUser(clientSocket);
        if(userptr != nullptr) {
            Struct::Room* roomptr = Service::Room::findRoomBySender(userptr);
            if(roomptr != nullptr) {
                Service::Room::removeSender(roomptr->roomId, userptr);
                if(roomptr->senders.size() <= 0) {
                    Service::Room::deleteRoom(roomptr->roomId);
                }
            }

            Service::User::deleteUser(clientSocket);
        }
    }
}

//------------------------------------------------------------------------------
void WebSocketServer::messageReceived(QString message) {
    QWebSocket* clientSocket;
    clientSocket = qobject_cast<QWebSocket*>(sender());

    Document json;
    json.Parse(message.toStdString().c_str());
    std::string type = json["type"].GetString();

    if(type == "connection") {
        Route::connection(message, clientSocket);
    } else if(type == "admin_connection") {
        Route::adminConnection(message, clientSocket);
    } else if(type == "message") {
        Route::message(message, clientSocket);
    } else if(type == "close") {
        Route::close(message, clientSocket);
    } else if(type == "rooms") {
        Route::rooms(message, clientSocket);
    }
}
