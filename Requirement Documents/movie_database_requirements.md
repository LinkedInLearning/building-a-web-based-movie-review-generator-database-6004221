## Movie Database Project – MVP Requirements

### 🎮 Public Features

1. **Movie Listings & Details**
   - View all movies (grid or list layout)
   - View individual movie pages with:
     * Title
     * Synopsis
     * Poster image
     * MPAA rating
     * Release date
     * Studio name
     * List of actors
     * Genre

2. **Search & Filtering**
   - Search by title
   - Filter by:
     * Genre
     * Studio
     * Year
     * Actor

3. **Responsive Frontend**
   - Use **Bootstrap** (or similar) for consistent styling and mobile responsiveness
   - All listing pages use a common layout (`search.html` base template)

---

### 🎭 Data Model & Relationships

4. **Movies**
   - Unique `movie_id`
   - One-to-many: studio, genre
   - Many-to-many: actors

5. **Actors**
   - Unique `actor_id`
   - Name only (no bio or profile)

6. **Studios**
   - Unique `studio_id`
   - Name, optional logo

7. **Genres**
   - Unique `genre_id`
   - Name
   - Stored in database (not hardcoded)

---

### 🛠 Admin Area

8. **Secure Admin Access**
   - Protected by `.htaccess` and password

9. **Admin CRUD**
   - Manage movies:
     * Add/edit/delete
     * Assign genre, studio
     * Associate/disassociate actors
     * Upload poster image
   - Manage studios, actors, genres:
     * Add/edit/delete

---

### 🔒 Post-MVP Features (Planned for Future)

10. **User Authentication**
    - Full user login system
    - Potential to store favorites, comments, etc.

