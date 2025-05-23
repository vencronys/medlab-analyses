package main.ma.medlab.model;

import main.ma.medlab.enums.Statut;

import java.util.Date;

public class Technicien {
    private final int id;
    private final String nom;
    private final String prenom;
    private final String cin;
    private final Statut statut;
    private final Compte compte;
    private final Date dateNaissance;
    private final String sexe;
    private final String adresse;
    private final String telephone;
    private final double salaire;
    private final Date dateEmbauche;

    public Technicien(int id, String nom, String prenom, String cin, Statut statut, Compte compte,
                      Date dateNaissance, String sexe, String adresse, String telephone, double salaire, Date dateEmbauche) {
        this.id = id;
        this.nom = nom;
        this.prenom = prenom;
        this.cin = cin;
        this.statut = statut;
        this.compte = compte;
        this.dateNaissance = dateNaissance;
        this.sexe = sexe;
        this.adresse = adresse;
        this.telephone = telephone;
        this.salaire = salaire;
        this.dateEmbauche = dateEmbauche;
    }

    public int getId() {
        return id;
    }

    public String getNom() {
        return nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public String getCin() {
        return cin;
    }

    public Statut getStatut() {
        return statut;
    }

    public Compte getCompte() {
        return compte;
    }

    public Date getDateNaissance() {
        return dateNaissance;
    }

    public String getSexe() {
        return sexe;
    }

    public String getAdresse() {
        return adresse;
    }

    public String getTelephone() {
        return telephone;
    }

    public double getSalaire() {
        return salaire;
    }

    public Date getDateEmbauche() {
        return dateEmbauche;
    }

    @Override
    public String toString() {
        return "Technicien{" +
                "id=" + id +
                ", nom='" + nom + '\'' +
                ", prenom='" + prenom + '\'' +
                ", cin='" + cin + '\'' +
                ", statut=" + statut +
                ", compte=" + compte +
                ", dateNaissance=" + dateNaissance +
                ", sexe='" + sexe + '\'' +
                ", adresse='" + adresse + '\'' +
                ", telephone='" + telephone + '\'' +
                ", salaire=" + salaire +
                ", dateEmbauche=" + dateEmbauche +
                '}';
    }
}
