package main.ma.medlab.model;

import main.ma.medlab.enums.Statut;

import java.util.Date;

public class ChefTechnicien extends Technicien {

    public ChefTechnicien(int id, String nom, String prenom, String cin, Statut statut, Compte compte,
                          Date dateNaissance, String sexe, String adresse, String telephone, double salaire, Date dateEmbauche) {
        super(id, nom, prenom, cin, statut, compte, dateNaissance, sexe, adresse, telephone, salaire, dateEmbauche);
    }
}
