package main.ma.medlab.view;

import main.ma.medlab.model.Prelevement;
import main.ma.medlab.model.Technicien;
import main.ma.medlab.repository.PrelevementRepository;
import main.ma.medlab.util.LoggerUtil;

import java.util.List;
import java.util.Scanner;

public class TechnicienView {

    private Scanner scanner = new Scanner(System.in);
    private final Technicien technicien;
    private final PrelevementRepository prelevementRepository = new PrelevementRepository();

    public TechnicienView(Technicien technicien) {
        this.technicien = technicien;
    }

    public void display() {
        LoggerUtil.info("Displaying Technicien Menu");
        while (true) {
            System.out.println("\n=== Technicien Menu ===");
            System.out.println("1. View Profile");
            System.out.println("2. View Prelevements");
            System.out.println("3. Logout");
            System.out.print("Choose an option: ");

            String choice = scanner.nextLine();
            LoggerUtil.info("Technicien selected option: " + choice);

            switch (choice) {
                case "1":
                    LoggerUtil.info("Attempting to view the profile");
                    System.out.println("=== Profile Information ===");
                    System.out.println("ID: " + technicien.getId());
                    System.out.println("Name: " + technicien.getNom());
                    System.out.println("First Name: " + technicien.getPrenom());
                    System.out.println("CIN: " + technicien.getCin());
                    System.out.println("Date of Birth: " + technicien.getDateNaissance());
                    System.out.println("Sex: " + technicien.getSexe());
                    System.out.println("Address: " + technicien.getAdresse());
                    System.out.println("Phone: " + technicien.getTelephone());
                    System.out.println("Status: " + technicien.getStatut());
                    System.out.println("Salary: " + technicien.getSalaire());
                    System.out.println("Hire Date: " + technicien.getDateEmbauche());
                    System.out.println("Account: " + (technicien.getCompte() != null ? technicien.getCompte().toString() : "No account assigned"));
                    break;
                case "2":
                    LoggerUtil.info("Attempting to view prelevements");
                    List<Prelevement> prelevements = prelevementRepository.getAllPrelevementsWithExamens();
                    System.out.println("=== Prelevements ===");
                    for (Prelevement prelevement : prelevements) {
                        System.out.println("ID: " + prelevement.getId());
                        System.out.println("Volume (ml): " + prelevement.getVolumeMl());
                        System.out.println("Status: " + prelevement.getStatut());
                        System.out.println("Date: " + prelevement.getDatePrelevement());
                        System.out.println("Stock ID: " + prelevement.getIdStock());
                        System.out.println("Patient ID: " + prelevement.getIdPatient());
                        System.out.println("Infirmier ID: " + prelevement.getIdInfirmier());
                        System.out.println("Examens: " + String.join(", ", prelevement.getExamens()));
                        System.out.println("-----------------------------");
                    }
                    break;
                case "3":
                    LoggerUtil.info("Technicien logging out");
                    return;
                default:
                    LoggerUtil.warning("Invalid menu choice entered in Technicien view: " + choice);
                    System.out.println("Invalid choice. Please try again.");
            }
        }
    }
}
