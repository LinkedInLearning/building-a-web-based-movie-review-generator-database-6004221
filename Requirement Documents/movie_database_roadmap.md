# 🧭 Movie Database – Implementation Roadmap

This roadmap outlines the step-by-step development plan for building the MVP.

---

## 🧭 Implementation Roadmap

### Phase 1: Foundations
* Set up project folder structure
* Configure `.htaccess` for admin access
* Create base templates (header/footer)
* Add Bootstrap
* Design DB schema & create MySQL tables
* Load sample data
* Build `db.php` connection script

### Phase 2: Public Interface
* Movie list page
* Movie detail page
* Search bar functionality
* Filter UI (genre, studio, actor, year)
* Apply responsive layout

### Phase 3: Admin Panel
* Create admin dashboard
* CRUD interfaces for:
  * Genres
  * Studios
  * Actors
  * Movies (with actor linking + poster upload)

### Phase 4: Security & File Uploads
* Implement prepared statements
* Validate all form input
* Secure image upload
* Poster + studio logo handling

### Phase 5: Testing & UI Polish
* Test all CRUD and UI interactions
* Add flash messages
* Delete confirmation modals
* Optional: image preview on upload

---

## 📁 Suggested File Structure

```
/index.php
/movie.php?id=...
/search.php?...

/admin/
  index.php
  movies.php
  actors.php
  studios.php
  genres.php
  includes/
    db.php
    auth.php
    functions.php

/uploads/
  /posters/
  /studios/
```
