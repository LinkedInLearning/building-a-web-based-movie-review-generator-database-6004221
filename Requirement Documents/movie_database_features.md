# 🎬 Movie Database – MVP Features

## ✅ Overview

This document outlines the necessary features for the Movie Database MVP project. The goal is to build a simple, Bootstrap-styled, PHP-based CRUD application with a secure admin area, using a MariaDB backend.

---

## 📦 MVP Features & Functions

### 🖥 Public Interface

1. **Movie Listings**
   - Grid or list view using Bootstrap
   - Each movie shows title, poster, year

2. **Movie Details**
   - Individual movie page with:
     * Title
     * Synopsis
     * Poster image
     * MPAA rating
     * Release date
     * Studio name
     * Genre
     * List of actors

3. **Search & Filtering**
   - Search by movie title (via SQL `LIKE`)
   - Filter by:
     * Genre
     * Studio
     * Year
     * Actor

4. **Responsive Layout**
   - Bootstrap-based styling
   - Shared layout (`search.html`) across all listing pages

---

### 🗃 Data Model

- **Movies**
  - `movie_id`, `title`, `synopsis`, `poster`, `rating`, `release_date`, `studio_id`, `genre_id`
  - Many-to-many with actors via `movie_actor` table

- **Actors**
  - `actor_id`, `name`

- **Studios**
  - `studio_id`, `name`, optional `logo`

- **Genres**
  - `genre_id`, `name` (stored in DB, not hardcoded)

- **movie_actor** (join table)
  - `movie_id`, `actor_id`

---

### 🔧 Admin Interface

- Accessible only via `.htaccess` password protection
- CRUD for:
  * Movies
  * Studios
  * Genres
  * Actors
- Poster image uploads
- Associate/disassociate actors with movies
- Optional: Studio logo upload

---

### 🔒 Security & File Handling

- Admin folder protected via `.htaccess`
- Prepared statements for all SQL
- Input validation and sanitization
- Allowed upload types: `.jpg`, `.png`
- Unique filenames via `uniqid()` or `md5()`
- Upload folders:
  * `/uploads/posters/`
  * `/uploads/studios/`
