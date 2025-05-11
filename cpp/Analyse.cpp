#include "Analyse.h"

Analyse::Analyse(int id, const TextBuffer& interpretation, const TextBuffer& commentaire,
	Statut statut, const TextBuffer& date, int id_prelevement, int id_examen,
	int id_technicien, int id_chef_technicien, int id_medecin_biologiste) {
	m_id = id;
	m_interpretation = interpretation;
	m_commentaire = commentaire;
	m_statut = statut;
	m_date = date;
	m_id_prelevement = id_prelevement;
	m_id_examen = id_examen;
	m_id_technicien = id_technicien;
	m_id_chef_technicien = id_chef_technicien;
	m_id_medecin_biologiste = id_medecin_biologiste;
}
// Getters
int Analyse::getId() const { return m_id; }
TextBuffer Analyse::getInterpretation() const { return m_interpretation; }
TextBuffer Analyse::getCommentaire() const { return m_commentaire; }
Analyse::Statut Analyse::getStatut() const { return m_statut; }
TextBuffer Analyse::getDate() const { return m_date; }
int Analyse::getIdPrelevement() const { return m_id_prelevement; }
int Analyse::getIdExamen() const { return m_id_examen; }
int Analyse::getIdTechnicien() const { return m_id_technicien; }
int Analyse::getIdChefTechnicien() const { return m_id_chef_technicien; }
int Analyse::getIdMedecinBiologiste() const { return m_id_medecin_biologiste; }
// Setters
void Analyse::setStatut(Statut newStatut) { m_statut = newStatut; }

void Analyse::display() const {
	std::cout << "Analyse ID: " << m_id << NEW_LINE
		<< "Interpretation: " << m_interpretation << NEW_LINE
		<< "Commentaire: " << m_commentaire << NEW_LINE
		<< "Statut: " << (m_statut == Statut::EN_ATTENTE ? "EN_ATTENTE" :
			m_statut == Statut::EFFECTUEE ? "EFFECTUEE" : "ANNULEE") << NEW_LINE
		<< "Date: " << m_date << NEW_LINE
		<< "ID Prelevement: " << m_id_prelevement << NEW_LINE
		<< "ID Examen: " << m_id_examen << NEW_LINE
		<< "ID Technicien: " << m_id_technicien << NEW_LINE
		<< "ID Chef Technicien: " << m_id_chef_technicien << NEW_LINE
		<< "ID Medecin Biologiste: " << m_id_medecin_biologiste << NEW_LINE;
}