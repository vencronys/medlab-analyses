package main.ma.medlab.repository;

import main.ma.medlab.config.DatabaseConfig;
import main.ma.medlab.enums.Privilege;
import main.ma.medlab.model.Compte;
import main.ma.medlab.util.LoggerUtil;

import java.sql.*;

/**
 * Repository class handling database operations for Compte (Account) entities.
 * This class provides methods for account-related database operations such as
 * finding accounts by email and authenticating users.
 */
public class CompteRepository {
//    private static final LoggerUtil logger = LoggerUtil.getLogger(CompteRepository.class);

    /**
     * Finds a user account by email address.
     *
     * @param email The email address to search for
     * @return Compte object if found, null otherwise
     * @throws SQLException if a database access error occurs
     */
    public Compte findByEmail(String email) throws SQLException {
        String query = "SELECT * FROM compte WHERE email_compte like ?";
        LoggerUtil.info("Searching for account with email: " + email);

        try (Connection conn = DatabaseConfig.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {

            stmt.setString(1, email);
            ResultSet rs = stmt.executeQuery();

            if (rs.next()) {
                LoggerUtil.info("Account found for email: " + email);
                return new Compte(
                        rs.getInt("id"),
                        rs.getString("email"),
                        Privilege.valueOf(rs.getString("privilege"))
                );
            }
            LoggerUtil.info("No account found for email: " + email);
            return null;
        } catch (SQLException e) {
            LoggerUtil.error("Error finding account by email: " + e.getMessage());
            throw e;
        }
    }

    /**
     * Authenticates a user by verifying their email and password combination.
     *
     * @param email The user's email address
     * @param password The user's password (should be hashed in production)
     * @return Compte object if authentication successful, null otherwise
     * @throws SQLException if a database access error occurs
     */
    public Compte authenticate(String email, String password) throws SQLException {
        String query = "SELECT * FROM disn1imh_v13_compte WHERE email_compte like ? AND mot_de_passe_compte like ? AND statut_compte like 'ACTIF'";
        LoggerUtil.info("Attempting authentication for email: " + email);

        try (Connection conn = DatabaseConfig.getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {

            stmt.setString(1, email);
            stmt.setString(2, password); // In real application, use hashed password

            ResultSet rs = stmt.executeQuery();

            if (rs.next()) {
                LoggerUtil.info("Authentication successful for email: " + email);
                return new Compte(
                        rs.getInt("id_compte"),
                        rs.getString("email_compte"),
                        Privilege.valueOf(rs.getString("privilege_compte"))
                );
            }
            LoggerUtil.info("Authentication failed for email: " + email);
            return null;
        } catch (SQLException e) {
            LoggerUtil.error("Error during authentication: " + e.getMessage());
            throw e;
        }
    }
}