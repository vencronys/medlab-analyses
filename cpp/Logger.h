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

    // Initialize the logger with an optional log file
    Logger(const std::string& logFile = "");

    // Destructor to close the log file
    ~Logger();

    // Log a message with a specific log level
    void log(const std::string& message, LogLevel level = LogLevel::INFO);

private:
    std::ofstream m_logFile;
    bool m_toFile;

    // Helper function to convert log level to string
    std::string logLevelToString(LogLevel level) const;

    // Helper function to get the current date and time
    std::string getCurrentDateTime() const;
};
