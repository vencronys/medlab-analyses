#pragma once
#include <string>
#include "AnalyseGenerale.h"
#include "AnalyseCholesterol.h"
#include "AnalyseGlucose.h"
#include "AnalyseHemoglobine.h"
#include "AnalyseVitamineD.h"
#include "Prelevement.h"
#include "DatabaseManager.h"
#include "Technicien.h"

class Analyzer {
public:
	// Generate results for an analyse
	static AnalyseGenerale generateAnalyseGenerale(int id_prelevement, int id_examen, int id_technicien);
	static AnalyseCholesterol generateAnalyseCholesterol(int id_prelevement, int id_examen, int id_technicien);
	static AnalyseGlucose generateAnalyseGlucose(int id_prelevement, int id_examen, int id_technicien);
	static AnalyseHemoglobine generateAnalyseHemoglobine(int id_prelevement, int id_examen, int id_technicien);
	static AnalyseVitamineD generateAnalyseVitamineD(int id_prelevement, int id_examen, int id_technicien);

	// A wrapper for all the functions based on the exam code
	static Analyse* generateAnalyse(int id_prelevement, int id_examen, int id_technicien, const std::string& code_examen);

	// A wrapper to generate and insert an analyse
	static void generateAndInsertAnalyseGenerale(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager);
	static void generateAndInsertAnalyseCholesterol(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager);
	static void generateAndInsertAnalyseGlucose(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager);
	static void generateAndInsertAnalyseHemoglobine(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager);
	static void generateAndInsertAnalyseVitamineD(int id_prelevement, int id_examen, int id_technicien, DatabaseManager& dbManager);

	// A wrapper for the wrapper that takes a list of exam codes to analyse and insert each one in the database using DatabaseManager class
	static void generateAndInsertAnalyses(Technicien technicien, Prelevement prelevement, DatabaseManager& dbManager);

private:
	static std::string getCurrentDate();
};
