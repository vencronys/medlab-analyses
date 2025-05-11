#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/statement.h>
#include <iostream>
#include <mysql_connection.h>
#include <mysql_driver.h>
#include "Analyse.h"
#include "AnalyseGenerale.h"
#include "AnalyseCholesterol.h"
#include "AnalyseGlucose.h"
#include "AnalyseHemoglobine.h"
#include "AnalyseVitamineD.h"
#include "Analyzer.h"
#include "Technicien.h"
#include "Examen.h"
#include "Examens.h"
#include "Prelevement.h"
#include "DatabaseManager.h"

using namespace std;
int main(int argc, char** argv)
{
	if (argc < 5) {
		std::cerr << "Usage: " << argv[0] << " <email> <password> <prelevement_id> <nb_examens>" << std::endl;
		return 1;
	}

	std::string email = argv[1];
	std::string password = argv[2];
	// Create a Prelevement object
	Prelevement prelevement(std::stoi(argv[3]), std::stoi(argv[4]));

	try {
		// Initialize the DatabaseManager
		DatabaseManager dbManager("tcp://localhost:3306", "root", "root", "disn1imh_v13_ma");

		// Verify technician login
		int id_technicien;
		if (!dbManager.verifyTechnician(email, password, id_technicien)) {
			std::cerr << "Login failed: Invalid email or password, or account is not active." << std::endl;
			return 1;
		}
		Technicien technicien(id_technicien);
		std::cout << "Technician logged in successfully. ID: " << technicien.getId() << std::endl;


		// Retrieve available exams for the prelevement
		sql::ResultSet* res = dbManager.getAvailableExams(prelevement.getId());
		while (res->next()) {
			int examId = res->getInt("id_examen");
			std::string examCode = res->getString("code_examen");
			prelevement.addExamen(examId, examCode.c_str());
		}
		delete res;

		// Generate and insert analyse data in the database
		Analyzer::generateAndInsertAnalyses(technicien, prelevement, dbManager);

		// Display exams for the prelevement
		//prelevement.getExamens().display();

	}
	catch (sql::SQLException& e) {
		std::cerr << "SQL Error: " << e.what() << std::endl;
		return 1;
	}






	//int count, size = std::stoi(argv[4]);
	//int count;
	//std::cout << "Number of arguments: " << argc << endl;

	//std::string email = argv[1];
	//std::string password = argv[2];
	//Prelevement prelevement(std::stoi(argv[3]), std::stoi(argv[4]));


	////display data:

	////std::cout << email << NEW_LINE;
	////std::cout << password << NEW_LINE;
	////std::cout << prelevement.getId() << NEW_LINE;
	////prelevement.getExamens().display();

	//try {
	//	sql::mysql::MySQL_Driver* driver;
	//	sql::Connection* con;

	//	driver = sql::mysql::get_mysql_driver_instance();
	//	con = driver->connect("tcp://localhost:3306", "root", "root");

	//	con->setSchema("disn1imh_v13_ma"); // your database name

	//	sql::Statement* stmt;
	//	stmt = con->createStatement();

	//	// SQL query to verify technician login
	//	string selectDataSQL = "SELECT t.id_technicien "
	//		"FROM disn1imh_v13_technicien t "
	//		"INNER JOIN disn1imh_v13_compte c ON t.id_compte = c.id_compte "
	//		"WHERE c.email_compte = '" + email + "' AND c.mot_de_passe_compte = '" + password + "' AND c.statut_compte = 'ACTIF'";

	//	sql::ResultSet* res = stmt->executeQuery(selectDataSQL);

	//	// Check if technician exists
	//	if (!res->next()) {
	//		std::cerr << "Login failed: Invalid email or password, or account is not active." << std::endl;
	//		delete res;
	//		delete stmt;
	//		delete con;
	//		return 1; // Exit main with error code
	//	}

	//	// Technician login successful
	//	int technicianId = res->getInt("id_technicien");
	//	std::cout << "Technician logged in successfully. ID: " << technicianId << std::endl;

	//	// SQL query to retrieve data from the table
	//	selectDataSQL = "SELECT e.id_examen, e.code_examen FROM disn1imh_v13_examen e WHERE e.statut_examen like 'DISPONIBLE'";

	//	res = stmt->executeQuery(selectDataSQL);

	//	// Loop through the result set and display data
	//	count = 0;
	//	//while (res->next()) {
	//	//	cout << " id_examen " << ": " << res->getString("id_examen") << endl;
	//	//	cout << " code_examen " << ": "<< res->getString("code_examen") << endl;
	//	//}

	//	// SQL query to retrieve data from the table
	//	selectDataSQL = "SELECT e.id_examen, e.code_examen "
	//		"FROM disn1imh_v13_prelevement p "
	//		"INNER JOIN disn1imh_v13_prelevement_examen pe ON p.id_prelevement = pe.id_prelevement "
	//		"INNER JOIN disn1imh_v13_examen e ON pe.id_examen = e.id_examen "
	//		"WHERE e.statut_examen = 'DISPONIBLE' AND p.id_prelevement = " + to_string(prelevement.getId());

	//	res = stmt->executeQuery(selectDataSQL);

	//	// Loop through the result set and display data
	//	count = 0;
	//	while (res->next()) {
	//		cout << " id_examen " << ": " << res->getString("id_examen") << endl;
	//		cout << " code_examen " << ": " << res->getString("code_examen") << endl;
	//		prelevement.addExamen(std::stoi(res->getString("id_examen")), res->getString("code_examen").c_str());
	//		count++;
	//	}

	//	prelevement.getExamens().display();


		// SQL query to create a table
		//string createTableSQL
		//    = "CREATE TABLE IF NOT EXISTS GFGCourses ("
		//    "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,"
		//    "courses VARCHAR(255) NOT NULL"
		//    ")";

		//stmt->execute(createTableSQL);

		//string insertDataSQL
		//    = "INSERT INTO GFGCourses (courses) VALUES "
		//    "('DSA'),('C++'),('JAVA'),('PYTHON')";

		//stmt->execute(insertDataSQL);

		//// SQL query to retrieve data from the table
		//selectDataSQL = "SELECT * FROM GFGCourses";

		//sql::ResultSet* res
		//    = stmt->executeQuery(selectDataSQL);

		//// Loop through the result set and display data
		//count = 0;
		//while (res->next()) {
		//    cout << " Course " << ++count << ": "
		//        << res->getString("courses") << endl;
		//}

		/*delete res;
		delete stmt;
		delete con;
	}
	catch (sql::SQLException& e) {
		std::cerr << "SQL Error: " << e.what() << std::endl;
	}*/

	//Technicien technicien(13);

	//int id_prelevement = 7;
	//int id_examen_GEN = 1;
	//int id_examen_CHO = 2;
	//int id_examen_GLU = 3;
	//int id_examen_HEM = 4;
	//int id_examen_VID = 5;

	//std::cout << "******************\n\n\n";

	//// Generate and display AnalyseGenerale
	//AnalyseGenerale analyseGenerale = Analyzer::generateAnalyseGenerale(id_prelevement, id_examen_GEN, technicien.getId());
	//analyseGenerale.display();
	//std::cout << "******************\n\n\n";

	//// Generate and display AnalyseCholesterol
	//AnalyseCholesterol analyseCholesterol = Analyzer::generateAnalyseCholesterol(id_prelevement, id_examen_CHO, technicien.getId());
	//analyseCholesterol.display();
	//std::cout << "******************\n\n\n";

	//// Generate and display AnalyseGlucose
	//AnalyseGlucose analyseGlucose = Analyzer::generateAnalyseGlucose(id_prelevement, id_examen_GLU, technicien.getId());
	//analyseGlucose.display();
	//std::cout << "******************\n\n\n";

	//// Generate and display AnalyseHemoglobine
	//AnalyseHemoglobine analyseHemoglobine = Analyzer::generateAnalyseHemoglobine(id_prelevement, id_examen_HEM, technicien.getId());
	//analyseHemoglobine.display();
	//std::cout << "******************\n\n\n";

	//// Generate and display AnalyseVitamineD
	//AnalyseVitamineD analyseVitamineD = Analyzer::generateAnalyseVitamineD(id_prelevement, id_examen_VID, technicien.getId());
	//analyseVitamineD.display();
	//std::cout << "******************\n\n\n";

	return 0;
}