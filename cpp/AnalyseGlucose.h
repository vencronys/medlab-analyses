#pragma once
#include "Analyse.h"
class AnalyseGlucose :
    public Analyse
{
private:
	float m_glucose;
	TextBuffer m_glucoseUnite;
public:
	AnalyseGlucose(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
		Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
		int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float glucose, const TextBuffer& glucoseUnite);
	float getGlucose() const;
	TextBuffer getGlucoseUnite() const;
	virtual void display() const;
};

