The Java Application architecture: 

```
main.ma.medlab/
├── app/
│   └── App.java                  # Main application entry point
├── config/
│   └── DatabaseConfig.java       # Database configuration and connection
├── model/
│   └── User.java                 # Data model/entity
├── repository/
│   └── UserRepository.java       # Database access layer
├── service/
│   └── AuthService.java          # Business logic layer
├── util/
│   ├── LoggerService.java        # Logging functionality
│   └── LoggerUtil.java          
└── view/
├── MainMenuView.java         # UI/presentation layer
├── TechnicianView.java
└── ChefTechnicianView.java
```