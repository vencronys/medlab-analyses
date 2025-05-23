package main.ma.medlab.view;

import main.ma.medlab.model.ChefTechnicien;
import main.ma.medlab.model.Compte;
import main.ma.medlab.model.Technicien;
import main.ma.medlab.repository.ChefTechnicienRepository;
import main.ma.medlab.repository.TechnicienRepository;
import main.ma.medlab.repository.CompteRepository;

import java.util.Scanner;

public class MainMenuView {
    private Scanner scanner;
    private CompteRepository compteRepository;

    public MainMenuView() {
        scanner = new Scanner(System.in);
        compteRepository = new CompteRepository();
    }

    public void display() {
        while (true) {
            System.out.println("\n=== MedLab Login System ===");
            System.out.println("1. Login");
            System.out.println("2. Exit");
            System.out.print("Choose an option: ");

            String choice = scanner.nextLine();

            switch (choice) {
                case "1":
                    handleLogin();
                    break;
                case "2":
                    System.out.println("Goodbye!");
                    return;
                default:
                    System.out.println("Invalid choice. Please try again.");
            }
        }
    }

    private void handleLogin() {
        System.out.print("Email: ");
        String email = scanner.nextLine();

        System.out.print("Password: ");
        String password = scanner.nextLine();

        try {
            Compte compte = compteRepository.authenticate(email, password);

            if (compte != null) {
                System.out.println("Login successful!");
                switch (compte.getPrivilege()) {
                    case TECHNICIEN:
                        Technicien technicien = (new TechnicienRepository()).getLoggedTechnicien(compte.getId());
                        if (technicien != null) {
                            new TechnicienView(technicien).display();
                        } else {
                            System.out.println("Technicien profile not found.");
                        }
                        break;
                    case CHEF_TECHNICIEN:
                        ChefTechnicien chefTechnicien = (new ChefTechnicienRepository()).getLoggedChefTechnicien(compte.getId());
                        if (chefTechnicien != null) {
                            new ChefTechnicienView(chefTechnicien).display();
                        } else {
                            System.out.println("Chef Technicien profile not found.");
                        }
                        break;
                    default:
                        System.out.println("Unknown privilege level");
                }
            } else {
                System.out.println("Invalid credentials. Please try again.");
            }
        } catch (Exception e) {
            System.out.println("Error during login: " + e.getMessage());
        }
    }
}
