package main.ma.medlab.model;

import main.ma.medlab.enums.Privilege;

public class Compte {
    private final int id;
    private final String email;
    private final Privilege privilege;

    public Compte(int id, String email, Privilege privilege) {
        this.id = id;
        this.email = email;
        this.privilege = privilege;
    }

    public int getId() {
        return id;
    }

    public String getEmail() {
        return email;
    }

    public Privilege getPrivilege() {
        return privilege;
    }

    @Override
    public String toString() {
        return "Compte{" +
                "id=" + id +
                ", email='" + email + '\'' +
                ", privilege=" + privilege +
                '}';
    }
}