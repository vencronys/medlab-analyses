package main.ma.medlab.model;

import java.util.Date;
import java.util.List;

public class Prelevement {
    private final int id;
    private final double volumeMl;
    private final String statut;
    private final Date datePrelevement;
    private final int idStock;
    private final int idPatient;
    private final int idInfirmier;
    private final List<String> examens;

    public Prelevement(int id, double volumeMl, String statut, Date datePrelevement, int idStock, int idPatient, int idInfirmier, List<String> examens) {
        this.id = id;
        this.volumeMl = volumeMl;
        this.statut = statut;
        this.datePrelevement = datePrelevement;
        this.idStock = idStock;
        this.idPatient = idPatient;
        this.idInfirmier = idInfirmier;
        this.examens = examens;
    }

    public int getId() {
        return id;
    }

    public double getVolumeMl() {
        return volumeMl;
    }

    public String getStatut() {
        return statut;
    }

    public Date getDatePrelevement() {
        return datePrelevement;
    }

    public int getIdStock() {
        return idStock;
    }

    public int getIdPatient() {
        return idPatient;
    }

    public int getIdInfirmier() {
        return idInfirmier;
    }

    public List<String> getExamens() {
        return examens;
    }
}
