#include "AnalyseGlucose.h"

AnalyseGlucose::AnalyseGlucose(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
	Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
	int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float glucose, const TextBuffer& glucoseUnite)
	: Analyse(id, interpretation, commentaire, statut, date, id_prelevement, id_examen,
		id_technicien, id_chef_technicien, id_medecin_biologiste)
{
	m_glucose = glucose;
	m_glucoseUnite = glucoseUnite;
}

float AnalyseGlucose::getGlucose() const { return m_glucose; }
TextBuffer AnalyseGlucose::getGlucoseUnite() const { return m_glucoseUnite; }

void AnalyseGlucose::display() const {
	Analyse::display();
	std::cout << "Glucose: " << m_glucose << " " << m_glucoseUnite << NEW_LINE;
}