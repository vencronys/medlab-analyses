INSERT INTO DISN1IMH_V13_compte (
    email_compte,
    mot_de_passe_compte,
    privilege_compte,
    statut_compte
) VALUES
('sara.benali@gmail.com', 'mdp123', 'PATIENT', 'ACTIF'),
('youssef.elmansouri@yahoo.com', 'azerty', 'PATIENT', 'ACTIF'),
('imane.chaibi@hotmail.com', '123456', 'PATIENT', 'ACTIF'),
('rachid.hassani@gmail.com', 'motdepasse', 'PATIENT', 'INACTIF'),
('salma.boukhriss@outlook.com', 'pass2024', 'PATIENT', 'ACTIF');


INSERT INTO DISN1IMH_V13_patient (
    nom_patient,
    prenom_patient,
    cin_patient,
    date_naissance_patient,
    sexe_patient,
    adresse_patient,
    telephone_patient,
    id_compte
) VALUES
('Benali', 'Sara', '1234567', '2000-05-15', 'F', '123 Rue des Lilas, Casablanca', '0612345678', 12),
('El Mansouri', 'Youssef', '2345678', '2001-08-22', 'M', '456 Rue des Roses, Marrakech', '0623456789', 13),
('Chaibi', 'Imane', '3456789', '2002-11-05', 'F', '789 Rue des Jasmin, Fès', '0634567890', 14),
('Hassani', 'Rachid', '4567890', '2003-02-18', 'M', '101 Rue des Lotus, Rabat', '0645678901', 15),
('Boukhriss', 'Salma', '5678901', '2004-07-25', 'F', '131 Rue des Violettes, Marrakech', '0656789012', 16);
