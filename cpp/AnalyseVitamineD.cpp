#include "AnalyseVitamineD.h"

AnalyseVitamineD::AnalyseVitamineD(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
	Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
	int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float vitamineD, const TextBuffer& vitamineDUnite)
	: Analyse(id, interpretation, commentaire, statut, date, id_prelevement, id_examen,
		id_technicien, id_chef_technicien, id_medecin_biologiste)
{
	m_vitamineD = vitamineD;
	m_vitamineDUnite = vitamineDUnite;
}

float AnalyseVitamineD::getVitamineD() const { return m_vitamineD; }
TextBuffer AnalyseVitamineD::getVitamineDUnite() const { return m_vitamineDUnite; }

void AnalyseVitamineD::display() const {
	Analyse::display();
	std::cout << "Vitamine D: " << m_vitamineD << " " << m_vitamineDUnite << NEW_LINE;
}