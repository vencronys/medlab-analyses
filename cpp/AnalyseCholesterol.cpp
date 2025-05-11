#include "AnalyseCholesterol.h"

AnalyseCholesterol::AnalyseCholesterol(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
	Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
	int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float cholesterolTotal, const TextBuffer& cholesterolTotalUnite,
	float cholesterolLDL, float cholesterolHDL, float triglycerides, const TextBuffer& triglyceridesUnite)
	: Analyse(id, interpretation, commentaire, statut, date, id_prelevement, id_examen,
		id_technicien, id_chef_technicien, id_medecin_biologiste)
{
	m_cholesterolTotal = cholesterolTotal;
	m_cholesterolTotalUnite = cholesterolTotalUnite;
	m_cholesterolLDL = cholesterolLDL;
	m_cholesterolHDL = cholesterolHDL;
	m_triglycerides = triglycerides;
	m_triglyceridesUnite = triglyceridesUnite;
}

float AnalyseCholesterol::getCholesterolTotal() const { return m_cholesterolTotal; }
TextBuffer AnalyseCholesterol::getCholesterolTotalUnite() const { return m_cholesterolTotalUnite; }
float AnalyseCholesterol::getCholesterolLDL() const { return m_cholesterolLDL; }
float AnalyseCholesterol::getCholesterolHDL() const { return m_cholesterolHDL; }
float AnalyseCholesterol::getTriglycerides() const { return m_triglycerides; }
TextBuffer AnalyseCholesterol::getTriglyceridesUnite() const { return m_triglyceridesUnite; }

void AnalyseCholesterol::display() const {
	Analyse::display();
	std::cout << "Cholesterol Total: " << m_cholesterolTotal << " " << m_cholesterolTotalUnite << NEW_LINE
		<< "Cholesterol LDL: " << m_cholesterolLDL << NEW_LINE
		<< "Cholesterol HDL: " << m_cholesterolHDL << NEW_LINE
		<< "Triglycerides: " << m_triglycerides << " " << m_triglyceridesUnite << NEW_LINE;
}