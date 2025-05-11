#include "AnalyseHemoglobine.h"

AnalyseHemoglobine::AnalyseHemoglobine(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
	Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
	int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float hemoglobine, const TextBuffer& hemoglobineUnite)
	: Analyse(id, interpretation, commentaire, statut, date, id_prelevement, id_examen,
		id_technicien, id_chef_technicien, id_medecin_biologiste)
{
	m_hemoglobine = hemoglobine;
	m_hemoglobineUnite = hemoglobineUnite;
}

float AnalyseHemoglobine::getHemoglobine() const { return m_hemoglobine; }
TextBuffer AnalyseHemoglobine::getHemoglobineUnite() const { return m_hemoglobineUnite; }

void AnalyseHemoglobine::display() const {
	Analyse::display();
	std::cout << "Hemoglobine: " << m_hemoglobine << " " << m_hemoglobineUnite << NEW_LINE;
}