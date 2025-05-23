CREATE TABLE DISN1IMH_V13_compte (
    id_compte INT AUTO_INCREMENT PRIMARY KEY,
    email_compte VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe_compte VARCHAR(255) NOT NULL,
    privilege_compte ENUM (
        'ADMIN',
        'SECRETAIRE',
        'INFIRMIER',
        'TECHNICIEN',
        'CHEF_TECHNICIEN',
        'PATIENT'
    ) NOT NULL,
    statut_compte ENUM ('ACTIF', 'INACTIF', 'SUSPENDU') DEFAULT 'ACTIF',
    date_creation_compte DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE DISN1IMH_V13_patient (
    id_patient INT AUTO_INCREMENT PRIMARY KEY,
    nom_patient VARCHAR(100) NOT NULL,
    prenom_patient VARCHAR(100) NOT NULL,
    cin_patient NCHAR(7) UNIQUE NOT NULL,
    date_naissance_patient DATE NOT NULL,
    sexe_patient ENUM ('M', 'F') NOT NULL,
    adresse_patient TEXT,
    telephone_patient NCHAR(10) UNIQUE,
    id_compte INT UNIQUE NOT NULL,
    CONSTRAINT fk_patient_compte_id FOREIGN KEY (id_compte) REFERENCES DISN1IMH_V13_compte (id_compte)
);

CREATE TABLE DISN1IMH_V13_secretaire (
    id_secretaire INT AUTO_INCREMENT PRIMARY KEY,
    nom_secretaire VARCHAR(100) NOT NULL,
    prenom_secretaire VARCHAR(100) NOT NULL,
    cin_secretaire NCHAR(7) UNIQUE NOT NULL,
    date_naissance_secretaire DATE NOT NULL,
    sexe_secretaire ENUM ('M', 'F') NOT NULL,
    adresse_secretaire TEXT,
    telephone_secretaire NCHAR(10) UNIQUE,
    statut_secretaire ENUM ('ACTIF', 'INACTIF') NOT NULL DEFAULT 'ACTIF',
    salaire_secretaire DECIMAL(10, 2) NOT NULL CHECK (salaire_secretaire >= 0),
    date_embauche_secretaire DATE NOT NULL,
    id_compte INT UNIQUE NOT NULL,
    CONSTRAINT fk_secretaire_compte_id FOREIGN KEY (id_compte) REFERENCES DISN1IMH_V13_compte (id_compte)
);

CREATE TABLE DISN1IMH_V13_infirmier (
    id_infirmier INT AUTO_INCREMENT PRIMARY KEY,
    nom_infirmier VARCHAR(100) NOT NULL,
    prenom_infirmier VARCHAR(100) NOT NULL,
    cin_infirmier NCHAR(7) UNIQUE NOT NULL,
    date_naissance_infirmier DATE NOT NULL,
    sexe_infirmier ENUM ('M', 'F') NOT NULL,
    adresse_infirmier TEXT,
    telephone_infirmier NCHAR(10) UNIQUE,
    statut_infirmier ENUM ('ACTIF', 'INACTIF') NOT NULL DEFAULT 'ACTIF',
    salaire_infirmier DECIMAL(10, 2) NOT NULL CHECK (salaire_infirmier >= 0),
    date_embauche_infirmier DATE NOT NULL,
    id_compte INT UNIQUE NOT NULL,
    CONSTRAINT fk_infirmier_compte_id FOREIGN KEY (id_compte) REFERENCES DISN1IMH_V13_compte (id_compte)
);

CREATE TABLE DISN1IMH_V13_technicien (
    id_technicien INT AUTO_INCREMENT PRIMARY KEY,
    nom_technicien VARCHAR(100) NOT NULL,
    prenom_technicien VARCHAR(100) NOT NULL,
    cin_technicien NCHAR(7) UNIQUE NOT NULL,
    date_naissance_technicien DATE NOT NULL,
    sexe_technicien ENUM ('M', 'F') NOT NULL,
    adresse_technicien TEXT,
    telephone_technicien NCHAR(10) UNIQUE,
    statut_technicien ENUM ('ACTIF', 'INACTIF') NOT NULL DEFAULT 'ACTIF',
    salaire_technicien DECIMAL(10, 2) NOT NULL CHECK (salaire_technicien >= 0),
    date_embauche_technicien DATE NOT NULL,
    id_compte INT UNIQUE NOT NULL,
    CONSTRAINT fk_technicien_compte_id FOREIGN KEY (id_compte) REFERENCES DISN1IMH_V13_compte (id_compte)
);

CREATE TABLE DISN1IMH_V13_chef_technicien (
    id_chef_technicien INT AUTO_INCREMENT PRIMARY KEY,
    nom_chef_technicien VARCHAR(100) NOT NULL,
    prenom_chef_technicien VARCHAR(100) NOT NULL,
    cin_chef_technicien NCHAR(7) UNIQUE NOT NULL,
    date_naissance_chef_technicien DATE NOT NULL,
    sexe_chef_technicien ENUM ('M', 'F') NOT NULL,
    adresse_chef_technicien TEXT,
    telephone_chef_technicien NCHAR(10) UNIQUE,
    statut_chef_technicien ENUM ('ACTIF', 'INACTIF') NOT NULL DEFAULT 'ACTIF',
    salaire_chef_technicien DECIMAL(10, 2) NOT NULL CHECK (salaire_chef_technicien >= 0),
    date_embauche_chef_technicien DATE NOT NULL,
    id_compte INT UNIQUE NOT NULL,
    CONSTRAINT fk_chef_technicien_compte_id FOREIGN KEY (id_compte) REFERENCES DISN1IMH_V13_compte (id_compte)
);

CREATE TABLE DISN1IMH_V13_medecin_biologiste (
    id_medecin_biologiste INT AUTO_INCREMENT PRIMARY KEY,
    nom_medecin_biologiste VARCHAR(100) NOT NULL,
    prenom_medecin_biologiste VARCHAR(100) NOT NULL,
    cin_medecin_biologiste NCHAR(7) UNIQUE NOT NULL,
    date_naissance_medecin_biologiste DATE NOT NULL,
    sexe_medecin_biologiste ENUM ('M', 'F') NOT NULL,
    adresse_medecin_biologiste TEXT,
    telephone_medecin_biologiste NCHAR(10) UNIQUE,
    statut_medecin_biologiste ENUM ('ACTIF', 'INACTIF') NOT NULL DEFAULT 'ACTIF',
    salaire_medecin_biologiste DECIMAL(10, 2) NOT NULL CHECK (salaire_medecin_biologiste >= 0),
    date_embauche_medecin_biologiste DATE NOT NULL,
    id_compte INT UNIQUE NOT NULL,
    CONSTRAINT fk_medecin_biologiste_compte_id FOREIGN KEY (id_compte) REFERENCES DISN1IMH_V13_compte (id_compte)
);

CREATE TABLE DISN1IMH_V13_ordonnance (
    id_ordonnance INT AUTO_INCREMENT PRIMARY KEY,
    contenu_ordonnance TEXT NOT NULL,
    date_ordonnance DATE NOT NULL,
    id_patient INT NOT NULL,
    CONSTRAINT fk_ordonnace_patient_id FOREIGN KEY (id_patient) REFERENCES DISN1IMH_V13_patient (id_patient)
);

CREATE TABLE DISN1IMH_V13_rdv (
    id_rdv INT AUTO_INCREMENT PRIMARY KEY,
    date_rdv DATETIME NOT NULL,
    motif_rdv TEXT NOT NULL,
    statut_rdv ENUM ('EN_ATTENTE', 'CONFIRME', 'ANNULE', 'TERMINE') NOT NULL DEFAULT 'EN_ATTENTE',
    date_creation_rdv DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_patient INT NOT NULL,
    id_secretaire INT,
    CONSTRAINT fk_rdv_patient_id FOREIGN KEY (id_patient) REFERENCES DISN1IMH_V13_patient (id_patient),
    CONSTRAINT fk_rdv_secretaire_id FOREIGN KEY (id_secretaire) REFERENCES DISN1IMH_V13_secretaire (id_secretaire)
);

CREATE TABLE DISN1IMH_V13_facture (
    id_facture INT AUTO_INCREMENT PRIMARY KEY,
    montant_facture DECIMAL(10, 2) NOT NULL CHECK (montant_facture >= 0),
    statut_facture ENUM ('NON_PAYEE', 'PAYEE', 'EN_ATTENTE') NOT NULL DEFAULT 'NON_PAYEE',
    methode_paiment_facture ENUM ('CARTE', 'ESPECES', 'VIREMENT', 'CHEQUE') NOT NULL,
    description_facture TEXT,
    date_emission_facture DATE NOT NULL,
    date_payement_facture DATE,
    id_rdv INT NOT NULL,
    CONSTRAINT fk_facture_rdv_id FOREIGN KEY (id_rdv) REFERENCES DISN1IMH_V13_rdv (id_rdv)
);

CREATE TABLE DISN1IMH_V13_examen (
    id_examen INT AUTO_INCREMENT PRIMARY KEY,
    nom_examen VARCHAR(100) NOT NULL,
    code_examen VARCHAR(50) UNIQUE NOT NULL,
    description_examen TEXT,
    cout_examen DECIMAL(10, 2) NOT NULL CHECK (cout_examen >= 0),
    statut_examen ENUM ('DISPONIBLE', 'NON_DISPONIBLE') NOT NULL DEFAULT 'DISPONIBLE',
    date_creation_examen DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE DISN1IMH_V13_facture_examen (
    id_facture INT NOT NULL,
    id_examen INT NOT NULL,
    CONSTRAINT pk_facture_examen PRIMARY KEY (id_facture, id_examen),
    CONSTRAINT fk_facture_exam_id FOREIGN KEY (id_facture) REFERENCES DISN1IMH_V13_facture (id_facture),
    CONSTRAINT fk_examen_facture_id FOREIGN KEY (id_examen) REFERENCES DISN1IMH_V13_examen (id_examen)
);

CREATE TABLE DISN1IMH_V13_stock (
    id_stock INT AUTO_INCREMENT PRIMARY KEY,
    nom_stock VARCHAR(100) NOT NULL,
    categorie_stock VARCHAR(100) NOT NULL,
    quantite_stock INT NOT NULL CHECK (quantite_stock >= 0),
    unite_stock VARCHAR(20) NOT NULL,
    fournisseur_stock VARCHAR(100) NOT NULL,
    emplacement_stock VARCHAR(100) NOT NULL,
    statut_stock ENUM ('DISPONIBLE', 'NON_DISPONIBLE') NOT NULL DEFAULT 'DISPONIBLE',
    date_reception_stock DATE NOT NULL,
    date_expiration_stock DATE
);

CREATE TABLE DISN1IMH_V13_prelevement (
    id_prelevement INT AUTO_INCREMENT PRIMARY KEY,
    volume_ml DECIMAL(10, 2) NOT NULL CHECK (volume_ml >= 0),
    statut_prelevement ENUM ('EN_ATTENTE', 'EFFECTUE', 'ANNULE') NOT NULL DEFAULT 'EN_ATTENTE',
    date_prelevement DATETIME NOT NULL,
    id_stock INT NOT NULL,
    id_patient INT NOT NULL,
    id_infirmier INT NOT NULL,
    CONSTRAINT fk_prelevement_patient_id FOREIGN KEY (id_patient) REFERENCES DISN1IMH_V13_patient (id_patient),
    CONSTRAINT fk_prelevement_infirmier_id FOREIGN KEY (id_infirmier) REFERENCES DISN1IMH_V13_infirmier (id_infirmier),
    CONSTRAINT fk_prelevement_stock_id FOREIGN KEY (id_stock) REFERENCES DISN1IMH_V13_stock (id_stock)
);

CREATE TABLE DISN1IMH_V13_prelevement_examen (
    id_prelevement INT NOT NULL,
    id_examen INT NOT NULL,
    CONSTRAINT pk_prelevement_examen PRIMARY KEY (id_prelevement, id_examen),
    CONSTRAINT fk_prelevement_examen_prelevement_id FOREIGN KEY (id_prelevement) REFERENCES DISN1IMH_V13_prelevement (id_prelevement),
    CONSTRAINT fk_prelevement_examen_examen_id FOREIGN KEY (id_examen) REFERENCES DISN1IMH_V13_examen (id_examen)
);

CREATE TABLE DISN1IMH_V13_analyse_generale (
    id_analyse_generale INT AUTO_INCREMENT PRIMARY KEY,
    globules_rouges DECIMAL(10, 2) NOT NULL CHECK (globules_rouges >= 0),
    globules_rouges_unit VARCHAR(20) NOT NULL,
    globules_blancs DECIMAL(10, 2) NOT NULL CHECK (globules_blancs >= 0),
    globules_blancs_unit VARCHAR(20) NOT NULL,
    plaquettes DECIMAL(10, 2) NOT NULL CHECK (plaquettes >= 0),
    plaquettes_unit VARCHAR(20) NOT NULL,
    interpretation_analyse_generale TEXT,
    commentaire_analyse_generale TEXT,
    statut_analyse_generale ENUM ('EN_ATTENTE', 'EFFECTUEE', 'ANNULEE') NOT NULL DEFAULT 'EN_ATTENTE',
    date_analyse_generale DATETIME NOT NULL,
    id_prelevement INT NOT NULL,
    id_examen INT NOT NULL,
    id_technicien INT NOT NULL,
    id_chef_technicien INT NOT NULL,
    id_medecin_biologiste INT NOT NULL,
    CONSTRAINT fk_analyse_generale_prelevement_id FOREIGN KEY (id_prelevement) REFERENCES DISN1IMH_V13_prelevement (id_prelevement),
    CONSTRAINT fk_analyse_generale_examen_id FOREIGN KEY (id_examen) REFERENCES DISN1IMH_V13_examen (id_examen),
    CONSTRAINT fk_analyse_generale_technicien_id FOREIGN KEY (id_technicien) REFERENCES DISN1IMH_V13_technicien (id_technicien),
    CONSTRAINT fk_analyse_generale_chef_technicien_id FOREIGN KEY (id_chef_technicien) REFERENCES DISN1IMH_V13_chef_technicien (id_chef_technicien),
    CONSTRAINT fk_analyse_generale_medecin_biologiste_id FOREIGN KEY (id_medecin_biologiste) REFERENCES DISN1IMH_V13_medecin_biologiste (id_medecin_biologiste)
);

CREATE TABLE DISN1IMH_V13_analyse_cholesterol (
    id_analyse_cholesterol INT AUTO_INCREMENT PRIMARY KEY,
    cholesterol_total DECIMAL(10, 2) NOT NULL CHECK (cholesterol_total >= 0),
    cholesterol_unit VARCHAR(20) NOT NULL,
    cholesterol_ldl DECIMAL(10, 2) NOT NULL CHECK (cholesterol_ldl >= 0),
    cholesterol_hdl DECIMAL(10, 2) NOT NULL CHECK (cholesterol_hdl >= 0),
    triglycerides DECIMAL(10, 2) NOT NULL CHECK (triglycerides >= 0),
    triglycerides_unit VARCHAR(20) NOT NULL,
    interpretation_analyse_cholesterol TEXT,
    commentaire_analyse_cholesterol TEXT,
    statut_analyse_cholesterol ENUM ('EN_ATTENTE', 'EFFECTUEE', 'ANNULEE') NOT NULL DEFAULT 'EN_ATTENTE',
    date_analyse_cholesterol DATE NOT NULL,
    id_prelevement INT NOT NULL,
    id_examen INT NOT NULL,
    id_technicien INT NOT NULL,
    id_chef_technicien INT NOT NULL,
    id_medecin_biologiste INT NOT NULL,
    CONSTRAINT fk_analyse_cholesterol_prelevement_id FOREIGN KEY (id_prelevement) REFERENCES DISN1IMH_V13_prelevement (id_prelevement),
    CONSTRAINT fk_analyse_cholesterol_examen_id FOREIGN KEY (id_examen) REFERENCES DISN1IMH_V13_examen (id_examen),
    CONSTRAINT fk_analyse_cholesterol_technicien_id FOREIGN KEY (id_technicien) REFERENCES DISN1IMH_V13_technicien (id_technicien),
    CONSTRAINT fk_analyse_cholesterol_chef_technicien_id FOREIGN KEY (id_chef_technicien) REFERENCES DISN1IMH_V13_chef_technicien (id_chef_technicien),
    CONSTRAINT fk_analyse_cholesterol_medecin_biologiste_id FOREIGN KEY (id_medecin_biologiste) REFERENCES DISN1IMH_V13_medecin_biologiste (id_medecin_biologiste)
);

CREATE TABLE DISN1IMH_V13_analyse_glucose (
    id_analyse_glucose INT AUTO_INCREMENT PRIMARY KEY,
    glucose DECIMAL(10, 2) NOT NULL CHECK (glucose >= 0),
    glucose_unit VARCHAR(20) NOT NULL,
    interpretation_analyse_glucose TEXT,
    commentaire_analyse_glucose TEXT,
    statut_analyse_glucose ENUM ('EN_ATTENTE', 'EFFECTUEE', 'ANNULEE') NOT NULL DEFAULT 'EN_ATTENTE',
    date_analyse_glucose DATETIME NOT NULL,
    id_prelevement INT NOT NULL,
    id_examen INT NOT NULL,
    id_technicien INT NOT NULL,
    id_chef_technicien INT NOT NULL,
    id_medecin_biologiste INT NOT NULL,
    CONSTRAINT fk_analyse_glucose_prelevement_id FOREIGN KEY (id_prelevement) REFERENCES DISN1IMH_V13_prelevement (id_prelevement),
    CONSTRAINT fk_analyse_glucose_examen_id FOREIGN KEY (id_examen) REFERENCES DISN1IMH_V13_examen (id_examen),
    CONSTRAINT fk_analyse_glucose_technicien_id FOREIGN KEY (id_technicien) REFERENCES DISN1IMH_V13_technicien (id_technicien),
    CONSTRAINT fk_analyse_glucose_chef_technicien_id FOREIGN KEY (id_chef_technicien) REFERENCES DISN1IMH_V13_chef_technicien (id_chef_technicien),
    CONSTRAINT fk_analyse_glucose_medecin_biologiste_id FOREIGN KEY (id_medecin_biologiste) REFERENCES DISN1IMH_V13_medecin_biologiste (id_medecin_biologiste)
);

CREATE TABLE DISN1IMH_V13_analyse_hemoglobine (
    id_analyse_hemoglobine INT AUTO_INCREMENT PRIMARY KEY,
    hemoglobine DECIMAL(10, 2) NOT NULL CHECK (hemoglobine >= 0),
    hemoglobine_unit VARCHAR(20) NOT NULL,
    interpretation_analyse_hemoglobine TEXT,
    commentaire_analyse_hemoglobine TEXT,
    statut_analyse_hemoglobine ENUM ('EN_ATTENTE', 'EFFECTUEE', 'ANNULEE') NOT NULL DEFAULT 'EN_ATTENTE',
    date_analyse_hemoglobine DATE NOT NULL,
    id_prelevement INT NOT NULL,
    id_examen INT NOT NULL,
    id_technicien INT NOT NULL,
    id_chef_technicien INT NOT NULL,
    id_medecin_biologiste INT NOT NULL,
    CONSTRAINT fk_analyse_hemoglobine_prelevement_id FOREIGN KEY (id_prelevement) REFERENCES DISN1IMH_V13_prelevement (id_prelevement),
    CONSTRAINT fk_analyse_hemoglobine_examen_id FOREIGN KEY (id_examen) REFERENCES DISN1IMH_V13_examen (id_examen),
    CONSTRAINT fk_analyse_hemoglobine_technicien_id FOREIGN KEY (id_technicien) REFERENCES DISN1IMH_V13_technicien (id_technicien),
    CONSTRAINT fk_analyse_hemoglobine_chef_technicien_id FOREIGN KEY (id_chef_technicien) REFERENCES DISN1IMH_V13_chef_technicien (id_chef_technicien),
    CONSTRAINT fk_analyse_hemoglobine_medecin_biologiste_id FOREIGN KEY (id_medecin_biologiste) REFERENCES DISN1IMH_V13_medecin_biologiste (id_medecin_biologiste)
);

CREATE TABLE DISN1IMH_V13_analyse_vitamine_d (
    id_analyse_vitamine_d INT AUTO_INCREMENT PRIMARY KEY,
    vitamine_d DECIMAL(10, 2) NOT NULL CHECK (vitamine_d >= 0),
    vitamine_d_unit VARCHAR(20) NOT NULL,
    interpretation_analyse_vitamine_d TEXT,
    commentaire_analyse_vitamine_d TEXT,
    statut_analyse_vitamine_d ENUM ('EN_ATTENTE', 'EFFECTUEE', 'ANNULEE') NOT NULL DEFAULT 'EN_ATTENTE',
    date_analyse_vitamine_d DATE NOT NULL,
    id_prelevement INT NOT NULL,
    id_examen INT NOT NULL,
    id_technicien INT NOT NULL,
    id_chef_technicien INT NOT NULL,
    id_medecin_biologiste INT NOT NULL,
    CONSTRAINT fk_analyse_vitamine_d_prelevement_id FOREIGN KEY (id_prelevement) REFERENCES DISN1IMH_V13_prelevement (id_prelevement),
    CONSTRAINT fk_analyse_vitamine_d_examen_id FOREIGN KEY (id_examen) REFERENCES DISN1IMH_V13_examen (id_examen),
    CONSTRAINT fk_analyse_vitamine_d_technicien_id FOREIGN KEY (id_technicien) REFERENCES DISN1IMH_V13_technicien (id_technicien),
    CONSTRAINT fk_analyse_vitamine_d_chef_technicien_id FOREIGN KEY (id_chef_technicien) REFERENCES DISN1IMH_V13_chef_technicien (id_chef_technicien),
    CONSTRAINT fk_analyse_vitamine_d_medecin_biologiste_id FOREIGN KEY (id_medecin_biologiste) REFERENCES DISN1IMH_V13_medecin_biologiste (id_medecin_biologiste)
);
