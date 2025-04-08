//
// Created by Cyriac on 07/04/2025.
// Based on school archive
//

#ifndef WEBSOCKETSERVER_HPP
#define WEBSOCKETSERVER_HPP

#pragma once
// Includes.
#include "Includes.hpp"

// Utils includes.
#include "routes/AdminConnection.hpp"
#include "routes/Close.hpp"
#include "routes/Connection.hpp"
#include "routes/Message.hpp"
#include "routes/Rooms.hpp"

class WebSocketServer : public QObject {
Q_OBJECT

private:
  QWebSocketServer* server;
public:
  // Constructor.
  WebSocketServer(QString name, int port, QObject* parent = 0);

  // Destructor.
  ~WebSocketServer();

  // Method.
  static void sendMessage(QWebSocket* client, QString message);
  static void sendMessage(Struct::Room room, QString message);

public slots:
  // Slots.
  void newConnection();
  void socketDisconnected();
  void messageReceived(QString message);

signals:
  // Signals.
  void closed ();
};

#endif
