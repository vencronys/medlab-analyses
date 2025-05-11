#pragma once
#include "Analyse.h"
class AnalyseVitamineD :
    public Analyse
{
private:
	float m_vitamineD;
	TextBuffer m_vitamineDUnite;
public:
	AnalyseVitamineD(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
		Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
		int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float vitamineD, const TextBuffer& vitamineDUnite);
	// Getters
	float getVitamineD() const;
	TextBuffer getVitamineDUnite() const;
	void display() const;
};

