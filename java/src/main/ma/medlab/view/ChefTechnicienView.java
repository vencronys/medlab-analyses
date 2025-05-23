package main.ma.medlab.view;

import main.ma.medlab.model.ChefTechnicien;
import main.ma.medlab.util.LoggerUtil;

import java.util.Scanner;

public class ChefTechnicienView {

    private Scanner scanner = new Scanner(System.in);
    private final ChefTechnicien chefTechnicien;

    public ChefTechnicienView(ChefTechnicien chefTechnicien) {
        this.chefTechnicien = chefTechnicien;
    }

    public void display() {
        LoggerUtil.info("Displaying ChefTechnicien Menu");
        while (true) {
            System.out.println("\n=== Chef Technicien Menu ===");
            System.out.println("1. View Profile");
            System.out.println("2. View Tasks");
            System.out.println("3. Logout");
            System.out.print("Choose an option: ");

            String choice = scanner.nextLine();
            LoggerUtil.info("Technicien selected option: " + choice);

            switch (choice) {
                case "1":
                    LoggerUtil.info("Attempting to view the profile");
                    System.out.println("=== Profile Information ===");
                    System.out.println("ID: " + chefTechnicien.getId());
                    System.out.println("Name: " + chefTechnicien.getNom());
                    System.out.println("First Name: " + chefTechnicien.getPrenom());
                    System.out.println("CIN: " + chefTechnicien.getCin());
                    System.out.println("Date of Birth: " + chefTechnicien.getDateNaissance());
                    System.out.println("Sex: " + chefTechnicien.getSexe());
                    System.out.println("Address: " + chefTechnicien.getAdresse());
                    System.out.println("Phone: " + chefTechnicien.getTelephone());
                    System.out.println("Status: " + chefTechnicien.getStatut());
                    System.out.println("Salary: " + chefTechnicien.getSalaire());
                    System.out.println("Hire Date: " + chefTechnicien.getDateEmbauche());
                    System.out.println("Account: " + (chefTechnicien.getCompte() != null ? chefTechnicien.getCompte().toString() : "No account assigned"));
                    break;
                case "2":
                    LoggerUtil.info("Attempting to view tasks");
                    System.out.println("Task viewing not implemented yet");
                    break;
                case "3":
                    LoggerUtil.info("ChefTechnicien logging out");
                    return;
                default:
                    LoggerUtil.warning("Invalid menu choice entered in ChefTechnicien view: " + choice);
                    System.out.println("Invalid choice. Please try again.");
            }
        }
    }
}
