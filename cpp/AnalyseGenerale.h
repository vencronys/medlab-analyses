#pragma once
#include "Analyse.h"
class AnalyseGenerale :
	public Analyse
{
private:
	float m_globulesRouges;
	TextBuffer m_globulesRougesUnite;
	float m_globulesBlancs;
	TextBuffer m_globulesBlancsUnite;
	float m_plaquettes;
	TextBuffer m_plaquettesUnite;


public:
	AnalyseGenerale(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
		Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
		int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float globulesRouges, const TextBuffer& globulesRougesUnite,
		float globulesBlancs, const TextBuffer& globulesBlancsUnite, float plaquettes, const TextBuffer& plaquettesUnite);
	float getGlobulesRouges() const;
	TextBuffer getGlobulesRougesUnite() const;
	float getGlobulesBlancs() const;
	TextBuffer getGlobulesBlancsUnite() const;
	float getPlaquettes() const;
	TextBuffer getPlaquettesUnite() const;
	virtual void display() const;
};

