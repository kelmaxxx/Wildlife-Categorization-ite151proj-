# SQL to NoSQL Redesign Project: Wildlife Categorization System

## Project Overview
In this project, we are redesigning an existing relational (SQL) database system—the **Wildlife Categorization System**—into a NoSQL-based system. The goal is not to simply convert tables into collections, but to rethink and redesign the data structure using NoSQL principles, focusing on flexibility and performance.

## 1. Existing System (SQL-Based)
### Purpose of the system
The Wildlife Categorization System is designed to discover, classify, and protect wildlife. It allows users to browse different animal species, categorize them by their diet (e.g., Carnivore, Herbivore, Omnivore) and habitat, and track their conservation status (e.g., endangered).

### Key features
* Browse and search wildlife species.
* Filter species by category (diet), habitat, and endangered status.
* Admin panel to manage (Add, Edit, Delete) species, habitats, and categories.
* User roles: Admins and Uploaders, with an approval system for new species entries.

### Sample SQL Tables (Current Schema)
The existing MySQL database (`wildlife_categorization`) relies heavily on relationships and joins across these tables:
* `users` (users_ID, username, password)
* `admin_users` (admin_ID, users_ID)
* `uploader_users` (uploader_id, users_ID)
* `category` (Category_ID, Category_Name)
* `habitat` (Habitat_ID, Habitat_Name, Habitat_Location)
* `species` (Species_ID, Category_ID, Species_Name, Species_Sci_Name, is_endangered, Habitat_ID, image_url, uploader_ID)
* `approval` (approval_ID, species_ID, admin_ID, approval_date, status)

---

## 2. NoSQL Redesign *(To Do)*
* **Chosen NoSQL type:** [Specify MongoDB, Firebase, etc.]
* **Data structure in JSON format:**
  ```json
  // Add your proposed JSON structure here
  ```

## 3. Schema Design *(To Do)*
* [Document how the normalized SQL tables are transformed into NoSQL collections (e.g., embedding Category and Habitat inside Species, or keeping them separate depending on access patterns)]

## 4. Implementation *(To Do)*
**Required Operations to Build:**
- [ ] **Create:** Insert new data (e.g., adding a new species or user).
- [ ] **Read:** Retrieve data (e.g., fetching all endangered species).
- [ ] **Update:** Modify existing data.
- [ ] **Delete:** Remove data.

## 5. Performance Considerations *(To Do)*
* [Explain how your NoSQL design improves performance (e.g., avoiding expensive SQL JOINs by embedding data, faster read speeds, scalability)]

## 6. Security Considerations *(To Do)*
* **Authentication or access control:** [Explain how you will secure Admin/Uploader routes]
* **Data protection:** [Explain encryption or secure access rules]

---

## Project Deliverables Checklist
### 1. Documentation (PDF)
- [ ] Introduction
- [ ] Existing SQL System Overview
- [ ] NoSQL Design
- [ ] Data Model (JSON examples)
- [ ] Implementation (screenshots/code)
- [ ] Performance & Security Discussion
- [ ] Conclusion

### 2. System / Demo
- [ ] Working application
- [ ] API (Postman demonstration allowed)

### 3. Presentation
- [ ] 10–15 minutes presentation
- [ ] Explain design decisions
- [ ] Explain challenges encountered
