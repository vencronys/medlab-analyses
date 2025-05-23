# MedLab Analyses - Laboratory Analysis Management System

## Overview
MedLab Analyses is a management system for a medical analysis laboratory. It provides a structured solution for handling blood sample analysis, patient appointments, and staff management. The system consists of multiple components tailored for different user roles.

## Features
### External Web Application (Patients)
- User authentication (sign-up/login)
- Appointment booking
- Access to analysis results

### Internal Web Application (Lab Staff)
- **Secretaries**: Register new patients, manage appointments, and access results.
- **Nurses**: Log patient blood samples into the system.
- **Head Doctor**: Manage lab personnel, monitor statistics, and oversee operations.

### Java Application (Technicians)
- Authentication system for lab technicians.
- View and process pending blood samples.
- Manage sample status and processing.

### C++ Application (Analysis Processing)
- Implements algorithms to generate sample analysis results.
- Processes blood sample data for result generation.
- Stores generated results in a structured format.

## Tech Stack
- **Frontend**: HTML, CSS, JavaScript (for UI and interactivity)
- **Backend**: PHP (for handling logic and database interactions)
- **Database**: MySQL (for storing patient, appointment, and analysis data)
- **Java**: Used for technician operations
- **C++**: Used for blood analysis data processing

## Project Structure
```
medlab-analyses/
├── docs/        # Documentation
├── database/    # SQL scripts and schema
├── www/         # Web application (public and internal)
│   ├── external/  # Public website for patients
│   ├── internal/  # Internal dashboard for staff
│   ├── assets/    # Shared images, stylesheets, and JavaScript files
├── java/    # Java application for technicians
├── cpp/     # C++ application for analysis processing
├── scripts/     # Utility scripts (database reset, helpers)
├── .gitignore   # Git ignore rules
├── README.md    # Project overview
└── LICENSE      # Licensing information
```

## Installation & Setup
### Prerequisites
- PHP and MySQL installed on the server
- Java Runtime Environment (JRE) for the technician application
- C++ compiler (GCC or Clang) for analysis algorithms

### Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/vencronys/labanal.git
   ```
2. Set up the database using the provided SQL script:
   ```sh
   mysql -u root -p < database/create_tables.sql
   ```
3. Deploy the web application (`www/`) to a web server.
4. Compile the C++ application from `cpp/`.
5. Run the Java application from `java/`.

## License
This project is licensed under the MIT License. See `LICENSE` for details.


