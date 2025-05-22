#include <ctime>
#include <sstream>
#include "Analyzer.h"
#include "Logger.h"

// Helper function to get the current date in YYYY-MM-DD format
std::string Analyzer::getCurrentDate() {
	time_t t = time(0);
	tm* now = localtime(&t);
	std::ostringstream oss;
	oss << (now->tm_year + 1900) << "-"
		<< (now->tm_mon + 1 < 10 ? "0" : "") << (now->tm_mon + 1) << "-"
		<< (now->tm_mday < 10 ? "0" : "") << now->tm_mday;
	return oss.str();
}

AnalyseGenerale Analyzer::generateAnalyseGenerale(int id_prelevement, int id_examen, int id_technicien) {
	Logger logger("application.log");
	logger.log("Generating AnalyseGenerale", Logger::LogLevel::INFO);
	return AnalyseGenerale(
		0,
		TextBuffer("Normal blood cell count"),
		TextBuffer("No abnormalities detected"),
		Analyse::Statut::EFFECTUEE,
		TextBuffer(getCurrentDate().c_str()),
		id_prelevement,
		id_examen,
		id_technicien,
		1,
		1,
		4.5 + static_cast<double>(rand()) / RAND_MAX * (6.0 - 4.5),
		TextBuffer("million/uL"),
		4.0 + static_cast<double>(rand()) / RAND_MAX * (11.0 - 4.0),
		TextBuffer("thousand/uL"),
		150.0 + static_cast<double>(rand()) / RAND_MAX * (450.0 - 150.0),
		TextBuffer("thousand/uL")
	);
}

AnalyseCholesterol Analyzer::generateAnalyseCholesterol(int id_prelevement, int id_examen, int id_technicien) {
	Logger logger("application.log");
	logger.log("Generating AnalyseCholesterol", Logger::LogLevel::INFO);
	return AnalyseCholesterol(
		0,
		TextBuffer("Cholesterol levels within normal range"),
		TextBuffer("No abnormalities detected"),
		Analyse::Statut::EFFECTUEE,
		TextBuffer(getCurrentDate().c_str()),
		id_prelevement,
		id_examen,
		id_technicien,
		1,
		1,
		150.0 + static_cast<double>(rand()) / RAND_MAX * (240.0 - 150.0),
		TextBuffer("mg/dL"),
		50.0 + static_cast<double>(rand()) / RAND_MAX * (160.0 - 50.0),
		40.0 + static_cast<double>(rand()) / RAND_MAX * (60.0 - 40.0),
		50.0 + static_cast<double>(rand()) / RAND_MAX * (150.0 - 50.0),
		TextBuffer("mg/dL")
	);
}

AnalyseGlucose Analyzer::generateAnalyseGlucose(int id_prelevement, int id_examen, int id_technicien) {
	Logger logger("application.log");
	logger.log("Generating AnalyseGlucose", Logger::LogLevel::INFO);
	return AnalyseGlucose(
		0,
		TextBuffer("Glucose levels within normal range"),
		TextBuffer("No abnormalities detected"),
		Analyse::Statut::EFFECTUEE,
		TextBuffer(getCurrentDate().c_str()),
		id_prelevement,
		id_examen,
		id_technicien,
		1,
		1,
		70.0 + static_cast<double>(rand()) / RAND_MAX * (140.0 - 70.0),
		TextBuffer("mg/dL")
	);
}

AnalyseHemoglobine Analyzer::generateAnalyseHemoglobine(int id_prelevement, int id_examen, int id_technicien) {
	Logger logger("application.log");
	logger.log("Generating AnalyseHemoglobine", Logger::LogLevel::INFO);
	return AnalyseHemoglobine(
		0,
		TextBuffer("Hemoglobin levels within normal range"),
		TextBuffer("No abnormalities detected"),
		Analyse::Statut::EFFECTUEE,
		TextBuffer(getCurrentDate().c_str()),
		id_prelevement,
		id_examen,
		id_technicien,
		1,
		1,
		12.0 + static_cast<double>(rand()) / RAND_MAX * (18.0 - 12.0),
		TextBuffer("g/dL")
	);
}

AnalyseVitamineD Analyzer::generateAnalyseVitamineD(int id_prelevement, int id_examen, int id_technicien) {
	Logger logger("application.log");
	logger.log("Generating AnalyseVitamineD", Logger::LogLevel::INFO);
	return AnalyseVitamineD(
		0,
		TextBuffer("Vitamin D levels within normal range"),
		TextBuffer("No abnormalities detected"),
		Analyse::Statut::EFFECTUEE,
		TextBuffer(getCurrentDate().c_str()),
		id_prelevement,
		id_examen,
		id_technicien,
		1,
		1,
		20.0 + static_cast<double>(rand()) / RAND_MAX * (50.0 - 20.0),
		TextBuffer("ng/mL")
	);
}

Analyse* Analyzer::generateAnalyse(int id_prelevement, int id_examen, int id_technicien, const std::string& code_examen) {
	if (code_examen == "GEN") {
		return new AnalyseGenerale(generateAnalyseGenerale(id_prelevement, id_examen, id_technicien));
	}
	else if (code_examen == "CHO") {
		return new AnalyseCholesterol(generateAnalyseCholesterol(id_prelevement, id_examen, id_technicien));
	}
	else if (code_examen == "GLU") {
		return new AnalyseGlucose(generateAnalyseGlucose(id_prelevement, id_examen, id_technicien));
	}
	else if (code_examen == "HEM") {
		return new AnalyseHemoglobine(generateAnalyseHemoglobine(id_prelevement, id_examen, id_technicien));
	}
	else if (code_examen == "VID") {
		return new AnalyseVitamineD(generateAnalyseVitamineD(id_prelevement, id_examen, id_technicien));
	}
	return nullptr;
}

void Analyzer::generateAndInsertAnalyseGenerale(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager) {
	Logger logger("application.log");
	logger.log("Generating and inserting AnalyseGenerale", Logger::LogLevel::INFO);
	AnalyseGenerale analyseGenerale = generateAnalyseGenerale(id_prelevement, id_examen, id_technicien);

	std::string insertQuery = "INSERT INTO disn1imh_v13_analyse_generale "
		"(globules_rouges, globules_rouges_unit, globules_blancs, globules_blancs_unit, plaquettes, plaquettes_unit, interpretation_analyse_generale, "
		"commentaire_analyse_generale, statut_analyse_generale, date_analyse_generale, id_prelevement, id_examen, id_technicien, id_chef_technicien, id_medecin_biologiste) "
		"VALUES (" + std::to_string(analyseGenerale.getGlobulesRouges()) + ", '" + analyseGenerale.getGlobulesRougesUnite().toString() + "', " + 
		std::to_string(analyseGenerale.getGlobulesBlancs()) + ", '" + analyseGenerale.getGlobulesBlancsUnite().toString() + "', " +
		std::to_string(analyseGenerale.getPlaquettes()) + ", '" + analyseGenerale.getPlaquettesUnite().toString() + "', '" + 
		analyseGenerale.getInterpretation().toString() + "', '" + analyseGenerale.getCommentaire().toString() + "', 'EFFECTUEE', '" + getCurrentDate() + "', " +
		std::to_string(id_prelevement) + ", " + std::to_string(id_examen) + ", " + std::to_string(id_technicien) + ", 1, 1)";
	
	dbManager.executeUpdate(insertQuery);

	std::cout << "AnalyseGenerale inserted successfully." << std::endl;
	logger.log("AnalyseGenerale inserted successfully.", Logger::LogLevel::INFO);
}

void Analyzer::generateAndInsertAnalyseCholesterol(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager) {
	Logger logger("application.log");
	logger.log("Generating and inserting AnalyseCholesterol", Logger::LogLevel::INFO);
	AnalyseCholesterol analyseCholesterol = generateAnalyseCholesterol(id_prelevement, id_examen, id_technicien);

	std::string insertQuery = "INSERT INTO disn1imh_v13_analyse_cholesterol "
		"(cholesterol_total, cholesterol_unit, cholesterol_ldl, cholesterol_hdl, triglycerides, triglycerides_unit, interpretation_analyse_cholesterol, "
		"commentaire_analyse_cholesterol, statut_analyse_cholesterol, date_analyse_cholesterol, id_prelevement, id_examen, id_technicien, id_chef_technicien, id_medecin_biologiste) "
		"VALUES (" + std::to_string(analyseCholesterol.getCholesterolTotal()) + ", '" + analyseCholesterol.getCholesterolTotalUnite().toString() + "', " + 
		std::to_string(analyseCholesterol.getCholesterolLDL()) + ", " + std::to_string(analyseCholesterol.getCholesterolHDL()) + ", " +
		std::to_string(analyseCholesterol.getTriglycerides()) + ", '" + analyseCholesterol.getTriglyceridesUnite().toString() + "', '" +
		analyseCholesterol.getInterpretation().toString() + "', '" + analyseCholesterol.getCommentaire().toString() + "', 'EFFECTUEE', '" + getCurrentDate() + "', " +
		std::to_string(id_prelevement) + ", " + std::to_string(id_examen) + ", " + std::to_string(id_technicien) + ", 1, 1)";
	
	dbManager.executeUpdate(insertQuery);
	
	std::cout << "AnalyseCholesterol inserted successfully." << std::endl;
	logger.log("AnalyseCholesterol inserted successfully.", Logger::LogLevel::INFO);
}

void Analyzer::generateAndInsertAnalyseGlucose(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager) {
	Logger logger("application.log");
	logger.log("Generating and inserting AnalyseGlucose", Logger::LogLevel::INFO);
	AnalyseGlucose analyseGlucose = generateAnalyseGlucose(id_prelevement, id_examen, id_technicien);
	
	std::string insertQuery = "INSERT INTO disn1imh_v13_analyse_glucose "
		"(glucose, glucose_unit, interpretation_analyse_glucose, commentaire_analyse_glucose, statut_analyse_glucose, date_analyse_glucose, id_prelevement, id_examen, "
		"id_technicien, id_chef_technicien, id_medecin_biologiste) "
		"VALUES (" + std::to_string(analyseGlucose.getGlucose()) + ", '" + analyseGlucose.getGlucoseUnite().toString() + "', '" +
		analyseGlucose.getInterpretation().toString() + "', '" + analyseGlucose.getCommentaire().toString() + "', 'EFFECTUEE', '" + getCurrentDate() + "', " +
		std::to_string(id_prelevement) + ", " + std::to_string(id_examen) + ", " + std::to_string(id_technicien) + ", 1, 1)";
	
	dbManager.executeUpdate(insertQuery);
	
	std::cout << "AnalyseGlucose inserted successfully." << std::endl;
	logger.log("AnalyseGlucose inserted successfully.", Logger::LogLevel::INFO);
}
void Analyzer::generateAndInsertAnalyseHemoglobine(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager) {
	Logger logger("application.log");
	logger.log("Generating and inserting AnalyseHemoglobine", Logger::LogLevel::INFO);
	AnalyseHemoglobine analyseHemoglobine = generateAnalyseHemoglobine(id_prelevement, id_examen, id_technicien);
	
	std::string insertQuery = "INSERT INTO disn1imh_v13_analyse_hemoglobine "
		"(hemoglobine, hemoglobine_unit, interpretation_analyse_hemoglobine, commentaire_analyse_hemoglobine, statut_analyse_hemoglobine, date_analyse_hemoglobine, "
		"id_prelevement, id_examen, id_technicien, id_chef_technicien, id_medecin_biologiste) "
		"VALUES (" + std::to_string(analyseHemoglobine.getHemoglobine()) + ", '" + analyseHemoglobine.getHemoglobineUnite().toString() + "', '" +
		analyseHemoglobine.getInterpretation().toString() + "', '" + analyseHemoglobine.getCommentaire().toString() + "', 'EFFECTUEE', '" + getCurrentDate() + "', " +
		std::to_string(id_prelevement) + ", " + std::to_string(id_examen) + ", " + std::to_string(id_technicien) + ", 1, 1)";
	
	dbManager.executeUpdate(insertQuery);
	
	std::cout << "AnalyseHemoglobine inserted successfully." << std::endl;
	logger.log("AnalyseHemoglobine inserted successfully.", Logger::LogLevel::INFO);
}
void Analyzer::generateAndInsertAnalyseVitamineD(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager) {
	Logger logger("application.log");
	logger.log("Generating and inserting AnalyseVitamineD", Logger::LogLevel::INFO);
	AnalyseVitamineD analyseVitamineD = generateAnalyseVitamineD(id_prelevement, id_examen, id_technicien);
	
	std::string insertQuery = "INSERT INTO disn1imh_v13_analyse_vitamine_d "
		"(vitamine_d, vitamine_d_unit, interpretation_analyse_vitamine_d, commentaire_analyse_vitamine_d, statut_analyse_vitamine_d, date_analyse_vitamine_d, "
		"id_prelevement, id_examen, id_technicien, id_chef_technicien, id_medecin_biologiste) "
		"VALUES (" + std::to_string(analyseVitamineD.getVitamineD()) + ", '" + analyseVitamineD.getVitamineDUnite().toString() + "', '" +
		analyseVitamineD.getInterpretation().toString() + "', '" + analyseVitamineD.getCommentaire().toString() + "', 'EFFECTUEE', '" + getCurrentDate() + "', " +
		std::to_string(id_prelevement) + ", " + std::to_string(id_examen) + ", " + std::to_string(id_technicien) + ", 1, 1)";
	
	dbManager.executeUpdate(insertQuery);
	
	std::cout << "AnalyseVitamineD inserted successfully." << std::endl;
	logger.log("AnalyseVitamineD inserted successfully.", Logger::LogLevel::INFO);
}


void Analyzer::generateAndInsertAnalyses(Technicien technicien, Prelevement prelevement, DatabaseManager& dbManager) {
	for (int i = 0; i < prelevement.getExamens().getSize(); ++i) {
		if (prelevement.getExamens()[i].getCode() == std::string("GEN")) {
			generateAndInsertAnalyseGenerale(prelevement.getId(), prelevement.getExamens()[i].getId(), technicien.getId(), dbManager);

		}
		else if (prelevement.getExamens()[i].getCode() == std::string("CHO")) {
			generateAndInsertAnalyseCholesterol(prelevement.getId(), prelevement.getExamens()[i].getId(), technicien.getId(), dbManager);

		}
		else if (prelevement.getExamens()[i].getCode() == std::string("GLU")) {
			generateAndInsertAnalyseGlucose(prelevement.getId(), prelevement.getExamens()[i].getId(), technicien.getId(), dbManager);

		}
		else if (prelevement.getExamens()[i].getCode() == std::string("HEM")) {
			generateAndInsertAnalyseHemoglobine(prelevement.getId(), prelevement.getExamens()[i].getId(), technicien.getId(), dbManager);

		}
		else if (prelevement.getExamens()[i].getCode() == std::string("VID")) {
			generateAndInsertAnalyseVitamineD(prelevement.getId(), prelevement.getExamens()[i].getId(), technicien.getId(), dbManager);

		}

	}
}