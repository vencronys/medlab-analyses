#include "AnalyseGenerale.h"

AnalyseGenerale::AnalyseGenerale(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
	Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
	int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float globulesRouges, const TextBuffer& globulesRougesUnite,
	float globulesBlancs, const TextBuffer& globulesBlancsUnite, float plaquettes, const TextBuffer& plaquettesUnite)
	: Analyse(id, interpretation, commentaire, statut, date, id_prelevement, id_examen,
		id_technicien, id_chef_technicien, id_medecin_biologiste)
{
	m_globulesRouges = globulesRouges;
	m_globulesRougesUnite = globulesRougesUnite;
	m_globulesBlancs = globulesBlancs;
	m_globulesBlancsUnite = globulesBlancsUnite;
	m_plaquettes = plaquettes;
	m_plaquettesUnite = plaquettesUnite;
}

float AnalyseGenerale::getGlobulesRouges() const { return m_globulesRouges; }
TextBuffer AnalyseGenerale::getGlobulesRougesUnite() const { return m_globulesRougesUnite; }
float AnalyseGenerale::getGlobulesBlancs() const { return m_globulesBlancs; }
TextBuffer AnalyseGenerale::getGlobulesBlancsUnite() const { return m_globulesBlancsUnite; }
float AnalyseGenerale::getPlaquettes() const { return m_plaquettes; }
TextBuffer AnalyseGenerale::getPlaquettesUnite() const { return m_plaquettesUnite; }

void AnalyseGenerale::display() const {
	Analyse::display();
	std::cout << "Globules Rouges: " << m_globulesRouges << " " << m_globulesRougesUnite << NEW_LINE
		<< "Globules Blancs: " << m_globulesBlancs << " " << m_globulesBlancsUnite << NEW_LINE
		<< "Plaquettes: " << m_plaquettes << " " << m_plaquettesUnite << NEW_LINE;
}