#pragma once
#include "Analyse.h"
class AnalyseCholesterol :
    public Analyse
{
private:
	float m_cholesterolTotal;
	TextBuffer m_cholesterolTotalUnite;
	float m_cholesterolLDL;
	float m_cholesterolHDL;
	float m_triglycerides;
	TextBuffer m_triglyceridesUnite;
public:
	AnalyseCholesterol(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
		Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
		int id_technicien, int id_chef_technicien, int id_medecin_biologiste, float cholesterolTotal, const TextBuffer& cholesterolTotalUnite,
		float cholesterolLDL, float cholesterolHDL, float triglycerides, const TextBuffer& triglyceridesUnite);
	// Getters
	float getCholesterolTotal() const;
	TextBuffer getCholesterolTotalUnite() const;
	float getCholesterolLDL() const;
	float getCholesterolHDL() const;
	float getTriglycerides() const;
	TextBuffer getTriglyceridesUnite() const;
	void display() const;
};

