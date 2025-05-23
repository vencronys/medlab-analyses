#pragma once
#include "Analyse.h"
class AnalyseHemoglobine :
	public Analyse
{
private:
	float m_hemoglobine;
	TextBuffer m_hemoglobineUnite;
public:
	AnalyseHemoglobine(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
		Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
		int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float hemoglobine, const TextBuffer& hemoglobineUnite);
	float getHemoglobine() const;
	TextBuffer getHemoglobineUnite() const;
	virtual void display() const;
};

