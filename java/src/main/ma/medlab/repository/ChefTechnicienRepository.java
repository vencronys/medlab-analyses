package main.ma.medlab.repository;

import main.ma.medlab.config.DatabaseConfig;
import main.ma.medlab.enums.Privilege;
import main.ma.medlab.enums.Statut;
import main.ma.medlab.model.ChefTechnicien;
import main.ma.medlab.model.Compte;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class ChefTechnicienRepository {

    public ChefTechnicien getLoggedChefTechnicien(int idCompte) {
        String query = "SELECT ct.*, email_compte, privilege_compte FROM disn1imh_v13_chef_technicien ct INNER JOIN disn1imh_v13_compte c ON ct.id_compte = c.id_compte WHERE ct.id_compte = ? and c.privilege_compte like 'CHEF_TECHNICIEN' and c.statut_compte like 'ACTIF'";
        try (Connection connection = DatabaseConfig.getConnection();
             PreparedStatement preparedStatement = connection.prepareStatement(query)) {

            preparedStatement.setInt(1, idCompte);
            ResultSet resultSet = preparedStatement.executeQuery();

            if (resultSet.next()) {
                return new ChefTechnicien(
                        resultSet.getInt("id_chef_technicien"),
                        resultSet.getString("nom_chef_technicien"),
                        resultSet.getString("prenom_chef_technicien"),
                        resultSet.getString("cin_chef_technicien"),
                        Statut.valueOf(resultSet.getString("statut_chef_technicien")),
                        new Compte(resultSet.getInt("id_compte"), resultSet.getString("email_compte"), Privilege.CHEF_TECHNICIEN), // Assuming Compte has a constructor with id
                        resultSet.getDate("date_naissance_chef_technicien"),
                        resultSet.getString("sexe_chef_technicien"),
                        resultSet.getString("adresse_chef_technicien"),
                        resultSet.getString("telephone_chef_technicien"),
                        resultSet.getDouble("salaire_chef_technicien"),
                        resultSet.getDate("date_embauche_chef_technicien")
                );
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }
}
