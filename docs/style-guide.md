# MedLab Analyses Project - Code Style Guide

This document provides coding standards and best practices for contributors working on the MedLab Analyses project. Following this guide ensures code consistency, readability, and maintainability.

---

## General Guidelines
- Use meaningful variable and function names.
- Keep functions short and focused on a single task.
- Write comments for complex logic, but avoid redundant comments.
- Maintain consistent indentation and spacing.
- Follow the defined naming conventions for each language.
- Use version control properly (commit often, write meaningful commit messages).

---

## PHP Coding Standards
- Use **4 spaces** for indentation (no tabs).
- Use `<?php` and `?>` only when necessary.
- Use **camelCase** for function and variable names.
- Use **PascalCase** for class names.
- Separate logic and presentation (avoid embedding PHP directly into HTML when possible).
- Use single quotes for strings unless interpolation is required.
- Example:
  ```php
  class User {
      private $name;

      public function __construct($name) {
          $this->name = $name;
      }

      public function getName() {
          return $this->name;
      }
  }
  ```

---

## Java Coding Standards
- Use **4 spaces** for indentation.
- Class names should be **PascalCase**.
- Variable and method names should be **camelCase**.
- Constants should be **UPPER_CASE_WITH_UNDERSCORES**.
- Always use braces `{}` for loops and conditionals, even for single-line statements.
- Example:
  ```java
  public class Patient {
      private String name;

      public Patient(String name) {
          this.name = name;
      }

      public String getName() {
          return name;
      }
  }
  ```

---

## C++ Coding Standards
- Use **4 spaces** for indentation.
- Use `.hpp` for header files and `.cpp` for implementation files.
- Class names should be **PascalCase**.
- Variable and method names should be **camelCase**.
- Constants should be **UPPER_CASE_WITH_UNDERSCORES**.
- Example:
  ```cpp
  class Sample {
  private:
      std::string name;

  public:
      Sample(const std::string& name) : name(name) {}

      std::string getName() const {
          return name;
      }
  };
  ```

---

## HTML, CSS, and JavaScript
### HTML
- Use **lowercase** for element names.
- Use **double quotes** for attributes.
- Indent properly (2 spaces for nesting).
- Example:
  ```html
  <input type="text" name="username" placeholder="Enter your name">
  ```

### CSS
- Use **kebab-case** for class names.
- Use **2 spaces** for indentation.
- Example:
  ```css
  .login-button {
    background-color: #007bff;
    color: white;
  }
  ```

### JavaScript
- Use **camelCase** for variables and functions.
- Use `let` and `const`, avoid `var`.
- Always end statements with a semicolon.
- Example:
  ```js
  function validateForm() {
      let username = document.getElementById("username").value;
      if (username === "") {
          alert("Username cannot be empty");
      }
  }
  ```

---

## Documentation Standards
- Write documentation using **Markdown (`.md`)** format.
- Keep documentation clear and concise.
- Use **sections** and **headings (`#`, `##`, `###`)** to organize content.
- Include **code snippets** where necessary using fenced code blocks (` ``` `).
- For inline documentation, use:
  - **PHP**: `/** Javadoc-style comments */`
  - **Java**: `/** Javadoc-style comments */`
  - **C++**: `/// Doxygen-style comments`
  - **JavaScript**: `// Single-line or /** Block comments */`
- Example:
  ```java
  /**
   * Retrieves the name of the patient.
   * @return String - Patient's name.
   */
  public String getName() {
      return name;
  }
  ```
- Place documentation in the `docs/` directory, with separate files for:
  - `installation.md` (Installation and setup instructions)
  - `api.md` (API documentation if applicable in the future)
  - `database.md` (Database schema and queries)
  - `contributing.md` (Contribution guidelines)

---

## Git Best Practices
- Use meaningful commit messages:
  ```
  feat: added login functionality
  fix: corrected database connection issue
  refactor: cleaned up PHP validation logic
  ```
- Work on feature branches and create pull requests.
- Avoid committing generated or unnecessary files.

---

Following this guide will help maintain code quality and improve collaboration within the team. If any questions arise, refer to this document before making style decisions.


