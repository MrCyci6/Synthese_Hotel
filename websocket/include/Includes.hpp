/*
 * @Author: Thibault Napoléon <Imothep>
 * @Company: ISEN Yncréa Ouest
 * @Email: thibault.napoleon@isen-ouest.yncrea.fr
 * @Created Date: 30-May-2018 - 10:16:15
 * @Last Modified: 30-Aug-2018 - 08:56:12
 */

#ifndef INCLUDES_HPP
#define INCLUDES_HPP

#pragma once
// C++ includes.
#include <iostream>
#include <string>
#include <vector>
#include <random>
#include <sstream>
#include <mutex>
#include <memory>
#include <map>
#include <concepts>

// Qt includes.
#include <QtCore/QtCore>
#include <QtCore/QCoreApplication>
#include <QtCore/QThread>
#include <QtNetwork/QtNetwork>
#include <QtWebSockets/QtWebSockets>

// rapidjson includes.
#include "rapidjson/document.h"
#include "rapidjson/writer.h"
#include "rapidjson/stringbuffer.h"

// utils includes
#include "utils/UUID.hpp"
#include "utils/Debug.hpp"

// Constants.
#define MAX_MPS 10

// Namespaces.
using namespace std;
using namespace rapidjson;

#endif
