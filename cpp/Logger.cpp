#include "Logger.h"
#include <ctime>
#include <sstream>
#include <iomanip>

// Constructor: Open the log file
Logger::Logger(const std::string& logFile) : m_toFile(!logFile.empty()) {
    if (m_toFile) {
        m_logFile.open(logFile, std::ios::app); // Open in append mode
        if (!m_logFile.is_open()) {
            throw std::runtime_error("Failed to open log file: " + logFile);
        }
    }
}

// Destructor: Close the log file
Logger::~Logger() {
    if (m_toFile && m_logFile.is_open()) {
        m_logFile.close();
    }
}

// Log a message with a specific log level
void Logger::log(const std::string& message, LogLevel level) {
    std::string timestamp = getCurrentDateTime();
    std::string logMessage = "[" + timestamp + "] [" + logLevelToString(level) + "] " + message;

    // Output to console
    std::cout << logMessage << std::endl;

    // Output to file if enabled
    if (m_toFile && m_logFile.is_open()) {
        m_logFile << logMessage << std::endl;
    }
}

// Helper function to convert log level to string
std::string Logger::logLevelToString(LogLevel level) const {
    switch (level) {
    case LogLevel::INFO: return "INFO";
    case LogLevel::WARNING: return "WARNING";
    case LogLevel::ERROR: return "ERROR";
    default: return "UNKNOWN";
    }
}

// Helper function to get the current date and time
std::string Logger::getCurrentDateTime() const {
    std::time_t now = std::time(nullptr);
    std::tm* localTime = std::localtime(&now);

    std::ostringstream oss;
    oss << std::put_time(localTime, "%Y-%m-%d %H:%M:%S");
    return oss.str();
}
