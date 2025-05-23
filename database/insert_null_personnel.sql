-- First, create a dedicated "null" accounts in `compte`
INSERT INTO DISN1IMH_V13_compte (email_compte, mot_de_passe_compte, privilege_compte, statut_compte)
VALUES
('null_secretaire@system.local', 'dummy', 'SECRETAIRE', 'INACTIF'),
('null_technicien@system.local', 'dummy', 'TECHNICIEN', 'INACTIF'),
('null_cheftech@system.local', 'dummy', 'CHEF_TECHNICIEN', 'INACTIF'),
('null_biologiste@system.local', 'dummy', 'ADMIN', 'INACTIF');


-- Then insert the null personnels using those accounts
INSERT INTO DISN1IMH_V13_secretaire (
    nom_secretaire, prenom_secretaire, cin_secretaire,
    date_naissance_secretaire, sexe_secretaire, adresse_secretaire,
    telephone_secretaire, salaire_secretaire, date_embauche_secretaire, id_compte
)
VALUES (
    'NULL', 'NULL', '0000000',
    '1900-01-01', 'M', 'NULL',
    '0000000000', 0.00, '1900-01-01', 1
);


INSERT INTO DISN1IMH_V13_technicien (
    nom_technicien, prenom_technicien, cin_technicien,
    date_naissance_technicien, sexe_technicien, adresse_technicien,
    telephone_technicien, salaire_technicien, date_embauche_technicien, id_compte
)
VALUES (
    'NULL', 'NULL', '0000001',
    '1900-01-01', 'M', 'NULL',
    '0000000001', 0.00, '1900-01-01', 2
);

INSERT INTO DISN1IMH_V13_chef_technicien (
    nom_chef_technicien, prenom_chef_technicien, cin_chef_technicien,
    date_naissance_chef_technicien, sexe_chef_technicien, adresse_chef_technicien,
    telephone_chef_technicien, salaire_chef_technicien, date_embauche_chef_technicien, id_compte
)
VALUES (
    'NULL', 'NULL', '0000002',
    '1900-01-01', 'M', 'NULL',
    '0000000002', 0.00, '1900-01-01', 3
);

INSERT INTO DISN1IMH_V13_medecin_biologiste (
    nom_medecin_biologiste, prenom_medecin_biologiste, cin_medecin_biologiste,
    date_naissance_medecin_biologiste, sexe_medecin_biologiste, adresse_medecin_biologiste,
    telephone_medecin_biologiste, salaire_medecin_biologiste, date_embauche_medecin_biologiste, id_compte
)
VALUES (
    'NULL', 'NULL', '0000003',
    '1900-01-01', 'M', 'NULL',
    '0000000003', 0.00, '1900-01-01', 4
);
