# MedLab Analyses Git Workflow Guidelines

This document outlines the Git workflow for the MedLab Analyses project to ensure smooth collaboration and maintain a clean, organized repository.

---

## 📌 Branching Strategy

To keep development structured, we follow this branching model:

- `main` → Stable, production-ready code. No direct commits.
- `dev` → Main development branch. All features merge here before `main`.
- `feature/<feature-name>` → Individual feature branches (one per feature/bugfix).
- `hotfix/<issue-name>` → For urgent fixes on production.

### **Branching Rules:**
- **Always create a new branch** for each feature or bugfix.
- **Never commit directly to `main` or `dev`.**
- **Use descriptive names** for feature branches (e.g., `feature/user-authentication`).
- **Delete branches** after merging to keep the repo clean.

---

## 📌 Commit Message Guidelines

Follow a consistent commit message format:

```
type: short description

Optional longer description (if needed)
```

### **Commit Types:**
- `feat:` New feature.
- `fix:` Bug fix.
- `refactor:` Code improvement without changing functionality.
- `docs:` Documentation changes.
- `test:` Adding or modifying tests.
- `style:` Code style changes (whitespace, formatting, etc.).
- `chore:` Maintenance or build-related changes.

#### **Examples:**
```
feat: implemented user login system
fix: corrected database connection issue
refactor: improved PHP validation logic
```

---

## 📌 Pull Request (PR) Process

All changes must go through a pull request (PR) before merging.

### **Steps to Open a PR:**
1. Push your branch to GitHub:
   ```sh
   git push origin feature/<your-feature>
   ```
2. Open a pull request **into `dev`**.
3. Add a **clear description** of what was changed and why.
4. Assign at least one **reviewer** from the team.
5. Ensure **all comments are addressed** before merging.

### **Merging Rules:**
- A PR must have at least **one approval** before merging.
- Run tests and manually verify features before merging.
- **No direct commits to `main`!**

---

## 📌 Git Best Practices

- **Commit often**, but keep commits meaningful.
- **Pull the latest changes** from `dev` before starting work:
  ```sh
  git checkout dev
  git pull origin dev
  ```
- **Rebase when necessary** to avoid merge conflicts.
- **Use `.gitignore`** to avoid committing unnecessary files.

---

Following this workflow will ensure smooth collaboration and maintainability. If you have questions, refer to this guide before committing or merging changes.


