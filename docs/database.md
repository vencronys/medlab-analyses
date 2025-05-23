# MedLab Analyses Project - Database Schema Documentation

## TODO: Document stuff, this is just a sample

This document outlines the structure of the database used in the MedLab Analyses project. It includes the tables, fields, relationships, and some example queries to help contributors understand and interact with the database.

## Database Structure

### **Entities**

- **patient**  
  Stores patient information, including name and contact details.

- **rdv**  
  Stores appointment data, linking patients to specific appointments with dates and status.

- **prelevement**  
  Stores blood sample information registered by nurses, linked to patients and appointments.

TODO: Add more

### **Relationships**
- A **patient** can have many **rdv**s.
- An **rdv** is linked to one **patient**.
- A **prelevement** is linked to one **Appointment** and one or more **analyses**.

## Tables and Fields

### **Patients Table**
```sql
CREATE TABLE patient (
    id_patient INT PRIMARY KEY AUTO_INCREMENT,
    nom_patient VARCHAR(100),
    prenom_patient VARCHAR(100),
    cin_patient VARCHAR(10),
    date_naissance_patient DATE,
    phone VARCHAR(20),
    address TEXT,
    ...
);

