INSERT INTO DISN1IMH_V13_compte (
    email_compte,
    mot_de_passe_compte,
    privilege_compte,
    statut_compte
) VALUES
('infirmier.amine@labanal.local', 'pass1234', 'INFIRMIER', 'ACTIF'),
('infirmier.fatima@labanal.local', 'inf4567', 'INFIRMIER', 'ACTIF'),
('infirmier.hassan@labanal.local', 'sang@2025', 'INFIRMIER', 'INACTIF'),
('infirmier.yasmine@labanal.local', 'tube+bio', 'INFIRMIER', 'ACTIF'),
('infirmier.noureddine@labanal.local', 'prel3vement', 'INFIRMIER', 'SUSPENDU');


INSERT INTO DISN1IMH_V13_infirmier (
    nom_infirmier,
    prenom_infirmier,
    cin_infirmier,
    date_naissance_infirmier,
    sexe_infirmier,
    adresse_infirmier,
    telephone_infirmier,
    statut_infirmier,
    salaire_infirmier,
    date_embauche_infirmier,
    id_compte
) VALUES
('El Amrani', 'Amine', 'AB12345', '1990-06-12', 'M', 'Rue 12, Rabat', '0612345678', 'ACTIF', 6200.00, '2022-01-15', 7),
('Bennani', 'Fatima', 'CD23456', '1988-04-22', 'F', 'Bd Hassan II, Casablanca', '0623456789', 'ACTIF', 6500.00, '2021-09-10', 8),
('Ouazzani', 'Hassan', 'EF34567', '1985-12-05', 'M', 'Hay Salam, Fès', '0634567890', 'INACTIF', 6000.00, '2020-03-18', 9),
('Chaoui', 'Yasmine', 'GH45678', '1992-07-19', 'F', 'Résidence Atlas, Marrakech', '0645678901', 'ACTIF', 6700.00, '2023-05-05', 10),
('Touhami', 'Noureddine', 'IJ56789', '1989-11-01', 'M', 'Av. Mohammed V, Agadir', '0656789012', 'ACTIF', 6400.00, '2022-11-20', 11);
