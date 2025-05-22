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
	DatabaseManager(const std::string& host, const std::string& user, const std::string& password, const std::string& schema);

	~DatabaseManager();

	sql::ResultSet* executeQuery(const std::string& query);

	void executeUpdate(const std::string& query);

	bool verifyTechnician(const std::string& email, const std::string& password, int& technicianId);

	sql::ResultSet* getAvailableExams(int prelevementId);
};
