#pragma once
#include <string>
#include <fstream>
#include <iostream>

class Logger {
public:
    enum class LogLevel {
        INFO,
        WARNING,
        ERROR
    };

    Logger(const std::string& logFile = "");

    ~Logger();

    void log(const std::string& message, LogLevel level = LogLevel::INFO);

private:
    std::ofstream m_logFile;
    bool m_toFile;

    std::string logLevelToString(LogLevel level) const;

    std::string getCurrentDateTime() const;
};
