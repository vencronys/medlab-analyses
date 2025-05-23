package main.ma.medlab.repository;

import main.ma.medlab.config.DatabaseConfig;
import main.ma.medlab.model.Prelevement;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class PrelevementRepository {

    public List<Prelevement> getAllPrelevementsWithExamens() {
        String query = "SELECT p.*, GROUP_CONCAT(e.nom_examen SEPARATOR ', ') AS examens " +
                       "FROM disn1imh_v13_prelevement p " +
                       "LEFT JOIN disn1imh_v13_prelevement_examen pe ON p.id_prelevement = pe.id_prelevement " +
                       "LEFT JOIN disn1imh_v13_examen e ON pe.id_examen = e.id_examen " +
                       "GROUP BY p.id_prelevement";

        List<Prelevement> prelevements = new ArrayList<>();

        try (Connection connection = DatabaseConfig.getConnection();
             PreparedStatement preparedStatement = connection.prepareStatement(query);
             ResultSet resultSet = preparedStatement.executeQuery()) {

            while (resultSet.next()) {
                List<String> examens = new ArrayList<>();
                String examensStr = resultSet.getString("examens");
                if (examensStr != null) {
                    for (String examen : examensStr.split(", ")) {
                        examens.add(examen);
                    }
                }

                Prelevement prelevement = new Prelevement(
                        resultSet.getInt("id_prelevement"),
                        resultSet.getDouble("volume_ml"),
                        resultSet.getString("statut_prelevement"),
                        resultSet.getTimestamp("date_prelevement"),
                        resultSet.getInt("id_stock"),
                        resultSet.getInt("id_patient"),
                        resultSet.getInt("id_infirmier"),
                        examens
                );

                prelevements.add(prelevement);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return prelevements;
    }
}
