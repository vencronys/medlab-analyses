#include "Logger.h"
#include <ctime>
#include <sstream>
#include <iomanip>

Logger::Logger(const std::string& logFile) {
	if (logFile.empty()) {
		std::cerr << "Log file name is empty. Logging to console only." << std::endl;
		m_toFile = false;
	}
	else {
		std::cout << "Logging to file: " << logFile << std::endl;
	}
    if (m_toFile) {
        m_logFile.open(logFile, std::ios::app);
        if (!m_logFile.is_open()) {
            throw std::runtime_error("Failed to open log file: " + logFile);
        }
    }
}

Logger::~Logger() {
    if (m_toFile && m_logFile.is_open()) {
        m_logFile.close();
    }
}

void Logger::log(const std::string& message, LogLevel level) {
    std::string timestamp = getCurrentDateTime();
    std::string logMessage = "[" + timestamp + "] [" + logLevelToString(level) + "] " + message;

    std::cout << logMessage << std::endl;

    if (m_toFile && m_logFile.is_open()) {
        m_logFile << logMessage << std::endl;
    }
}

std::string Logger::logLevelToString(LogLevel level) const {
    switch (level) {
    case LogLevel::INFO: return "INFO";
    case LogLevel::WARNING: return "WARNING";
    case LogLevel::ERROR: return "ERROR";
    default: return "UNKNOWN";
    }
}

std::string Logger::getCurrentDateTime() const {
    std::time_t now = std::time(nullptr);
    std::tm* localTime = std::localtime(&now);

    std::ostringstream oss;
    oss << std::put_time(localTime, "%Y-%m-%d %H:%M:%S");
    return oss.str();
}
