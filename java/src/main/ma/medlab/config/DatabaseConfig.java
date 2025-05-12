package main.ma.medlab.config;

import main.ma.medlab.util.LoggerUtil;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DatabaseConfig {
    private static final String URL = "jdbc:mysql://localhost:3306/disn1imh_v13_ma";
    private static final String USER = "root";
    private static final String PASSWORD = "root";
    
    private static Connection connection;
    
    public static Connection getConnection() throws SQLException {
        if (connection == null || connection.isClosed()) {
            try {
                LoggerUtil.info("Initializing database connection...");
                Class.forName("com.mysql.cj.jdbc.Driver");
                connection = DriverManager.getConnection(URL, USER, PASSWORD);
                LoggerUtil.info("Database connection established successfully");
            } catch (ClassNotFoundException e) {
                LoggerUtil.error("Database driver not found: " + e.getMessage());
                throw new SQLException("Database driver not found", e);
            } catch (SQLException e) {
                LoggerUtil.error("Failed to establish database connection: " + e.getMessage());
                throw e;
            }
        } else {
            LoggerUtil.info("Reusing existing database connection");
        }
        return connection;
    }
    
    public static void closeConnection() {
        if (connection != null) {
            try {
                LoggerUtil.info("Closing database connection...");
                connection.close();
                LoggerUtil.info("Database connection closed successfully");
            } catch (SQLException e) {
                LoggerUtil.error("Error closing database connection: " + e.getMessage());
            }
        } else {
            LoggerUtil.warning("Attempted to close null database connection");
        }
    }
}