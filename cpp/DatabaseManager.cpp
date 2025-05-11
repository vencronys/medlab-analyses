#include "DatabaseManager.h"
#include <iostream>

// Constructor: Establish a connection to the database
DatabaseManager::DatabaseManager(const std::string& host, const std::string& user, const std::string& password, const std::string& schema) {
    try {
        m_driver = sql::mysql::get_mysql_driver_instance();
        m_connection = m_driver->connect(host, user, password);
        m_connection->setSchema(schema);
    }
    catch (sql::SQLException& e) {
        std::cerr << "Database connection error: " << e.what() << std::endl;
        throw;
    }
}

// Destructor: Clean up the connection
DatabaseManager::~DatabaseManager() {
    delete m_connection;
}

// Execute a query and return the result set
sql::ResultSet* DatabaseManager::executeQuery(const std::string& query) {
    try {
        sql::Statement* stmt = m_connection->createStatement();
        return stmt->executeQuery(query);
    }
    catch (sql::SQLException& e) {
        std::cerr << "SQL Error: " << e.what() << std::endl;
        throw;
    }
}

// Execute an update query (INSERT, UPDATE, DELETE)
void DatabaseManager::executeUpdate(const std::string& query) {
    try {
        sql::Statement* stmt = m_connection->createStatement();
        stmt->executeUpdate(query);
        delete stmt;
    }
    catch (sql::SQLException& e) {
        std::cerr << "SQL Error: " << e.what() << std::endl;
        throw;
    }
}

// Check if a technician exists
bool DatabaseManager::verifyTechnician(const std::string& email, const std::string& password, int& technicianId) {
    std::string query = "SELECT t.id_technicien "
        "FROM disn1imh_v13_technicien t "
        "INNER JOIN disn1imh_v13_compte c ON t.id_compte = c.id_compte "
        "WHERE c.email_compte = '" + email + "' AND c.mot_de_passe_compte = '" + password + "' AND c.statut_compte = 'ACTIF'";
    sql::ResultSet* res = executeQuery(query);
    if (res->next()) {
        technicianId = res->getInt("id_technicien");
        delete res;
        return true;
    }
    delete res;
    return false;
}

// Retrieve available exams for a prelevement
sql::ResultSet* DatabaseManager::getAvailableExams(int prelevementId) {
    std::string query = "SELECT e.id_examen, e.code_examen "
        "FROM disn1imh_v13_prelevement p "
        "INNER JOIN disn1imh_v13_prelevement_examen pe ON p.id_prelevement = pe.id_prelevement "
        "INNER JOIN disn1imh_v13_examen e ON pe.id_examen = e.id_examen "
        "WHERE e.statut_examen = 'DISPONIBLE' AND p.id_prelevement = " + std::to_string(prelevementId);
    return executeQuery(query);
}
