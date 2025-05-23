package main.ma.medlab.repository;

import main.ma.medlab.config.DatabaseConfig;
import main.ma.medlab.enums.Privilege;
import main.ma.medlab.enums.Statut;
import main.ma.medlab.model.Compte;
import main.ma.medlab.model.Technicien;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class TechnicienRepository {

    public Technicien getLoggedTechnicien(int idCompte) {
        String query = "SELECT t.*, email_compte, privilege_compte FROM disn1imh_v13_technicien t " +
                       "INNER JOIN disn1imh_v13_compte c ON t.id_compte = c.id_compte " +
                       "WHERE t.id_compte = ? AND c.privilege_compte LIKE 'TECHNICIEN' AND c.statut_compte LIKE 'ACTIF'";
        try (Connection connection = DatabaseConfig.getConnection();
             PreparedStatement preparedStatement = connection.prepareStatement(query)) {

            preparedStatement.setInt(1, idCompte);
            ResultSet resultSet = preparedStatement.executeQuery();

            if (resultSet.next()) {
                return new Technicien(
                        resultSet.getInt("id_technicien"),
                        resultSet.getString("nom_technicien"),
                        resultSet.getString("prenom_technicien"),
                        resultSet.getString("cin_technicien"),
                        Statut.valueOf(resultSet.getString("statut_technicien")),
                        new Compte(resultSet.getInt("id_compte"), resultSet.getString("email_compte"), Privilege.TECHNICIEN),
                        resultSet.getDate("date_naissance_technicien"),
                        resultSet.getString("sexe_technicien"),
                        resultSet.getString("adresse_technicien"),
                        resultSet.getString("telephone_technicien"),
                        resultSet.getDouble("salaire_technicien"),
                        resultSet.getDate("date_embauche_technicien")
                );
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }
}
