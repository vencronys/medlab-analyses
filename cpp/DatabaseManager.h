#pragma once
#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/statement.h>
#include <cppconn/resultset.h>
#include <mysql_driver.h>
#include <string>

class DatabaseManager {
private:
	sql::mysql::MySQL_Driver* m_driver;
	sql::Connection* m_connection;

public:
	// Constructor
	DatabaseManager(const std::string& host, const std::string& user, const std::string& password, const std::string& schema);

	// Destructor
	~DatabaseManager();

	// Execute a query and return the result set
	sql::ResultSet* executeQuery(const std::string& query);

	// Execute an update query (INSERT, UPDATE, DELETE)
	void executeUpdate(const std::string& query);

	// Check if a technician exists
	bool verifyTechnician(const std::string& email, const std::string& password, int& technicianId);

	// Retrieve available exams for a prelevement
	sql::ResultSet* getAvailableExams(int prelevementId);
};
