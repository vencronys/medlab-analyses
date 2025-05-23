#pragma once
#include "textBuffer.h"

class Analyse
{
public:
	enum class Statut {
		EN_ATTENTE,
		EFFECTUEE,
		ANNULEE
	};

private:
	int m_id;
	TextBuffer m_interpretation;
	TextBuffer m_commentaire;
	Statut m_statut;
	TextBuffer m_date;
	int m_id_prelevement;
	int m_id_examen;
	int m_id_technicien;
	int m_id_chef_technicien;
	int m_id_medecin_biologiste;

public:
    Analyse(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
       Statut statut, const TextBuffer& date, int id_prelevement, int id_examen, 
       int id_technicien, int id_chef_technicien, int id_medecin_biologiste);
	int getId() const;
	TextBuffer getInterpretation() const;
	TextBuffer getCommentaire() const;
	Statut getStatut() const;
	TextBuffer getDate() const;
	int getIdPrelevement() const;
	int getIdExamen() const;
	int getIdTechnicien() const;
	int getIdChefTechnicien() const;
	int getIdMedecinBiologiste() const;
	void setStatut(Statut newStatut);

	virtual void display() const = 0;

};
