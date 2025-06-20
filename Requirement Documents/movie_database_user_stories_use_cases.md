# 🧾 User Stories – Movie Database MVP

## 👤 Visitor (Public User)

### 🎬 Discovering Movies
- As a visitor, I want to view a list of all movies, so that I can browse what's available.
- As a visitor, I want to view detailed information about a movie, so that I can learn more before deciding to watch it.

### 🔍 Finding Specific Content
- As a visitor, I want to search for a movie by title, so that I can quickly find what I’m looking for.
- As a visitor, I want to filter movies by genre, so that I can find movies in a category I enjoy.
- As a visitor, I want to filter movies by actor, so that I can find movies featuring my favorite performers.
- As a visitor, I want to filter movies by studio or release year, so that I can narrow my options by publisher or timeframe.

### 📱 Usability
- As a visitor, I want the site to work well on mobile and desktop, so that I can browse on any device.

---

## 🛠 Administrator

### 🔐 Access Control
- As an admin, I want the admin area to be password protected, so that only authorized users can make changes.

### 🎞 Managing Movies
- As an admin, I want to add a new movie with all its details, so that it shows up on the public site.
- As an admin, I want to assign a genre and studio to a movie, so that the movie is properly categorized.
- As an admin, I want to associate and disassociate actors with a movie, so that cast information is accurate.
- As an admin, I want to upload a poster image for each movie, so that the frontend is visually appealing.
- As an admin, I want to edit or delete existing movies, so that I can fix errors or remove outdated content.

### 👤 Managing Related Data
- As an admin, I want to add/edit/delete actors, so that the actor list remains accurate and up to date.
- As an admin, I want to add/edit/delete studios and their optional logos, so that I can keep publisher data clean.
- As an admin, I want to add/edit/delete genres, so that categorization options remain relevant.

### 🧹 Content Integrity
- As an admin, I want form inputs to be validated and sanitized, so that I don’t introduce bad data or security issues.
- As an admin, I want to only upload secure image formats, so that uploads don’t break the site or introduce vulnerabilities.


# 🧾 Use Cases – Movie Database MVP

## 👤 Visitor Use Cases

### View Movie List
**Actor:** Visitor  
**Goal:** Browse all available movies  
**Steps:**  
1. Visit homepage or movie listing page  
2. See list/grid of movie titles with posters and release years  
3. Click a title to view details  
**Success:** List of movies is displayed and navigable

---

### View Movie Details
**Actor:** Visitor  
**Goal:** Learn more about a specific movie  
**Steps:**  
1. Click on a movie from a list or search result  
2. View movie details: title, synopsis, rating, release date, genre, studio, actors, poster  
**Success:** Detailed movie page is rendered

---

### Search for a Movie
**Actor:** Visitor  
**Goal:** Find a specific movie by title  
**Steps:**  
1. Type a movie name into the search bar  
2. Submit search  
3. View matching results  
**Success:** Matching movies appear based on title query

---

### Filter Movie Listings
**Actor:** Visitor  
**Goal:** Narrow down movie list by genre, studio, actor, or year  
**Steps:**  
1. Select one or more filters  
2. Results update to show only matching movies  
**Success:** Filtered movie list is shown

---

## 🛠 Administrator Use Cases

### Login to Admin Area
**Actor:** Administrator  
**Goal:** Access the protected admin panel  
**Steps:**  
1. Navigate to `/admin/`  
2. Enter username/password (via `.htaccess`)  
**Success:** Admin dashboard loads

---

### Add a New Movie
**Actor:** Administrator  
**Goal:** Add a new movie to the database  
**Steps:**  
1. Go to “Movies” section in admin panel  
2. Click “Add Movie”  
3. Fill in movie details  
4. Upload poster image  
5. Select studio and genre  
6. Choose actors to associate  
7. Save  
**Success:** Movie appears on public site with full details

---

### Edit an Existing Movie
**Actor:** Administrator  
**Goal:** Update details of an existing movie  
**Steps:**  
1. Go to “Movies” section  
2. Click “Edit” on a movie  
3. Modify fields or associations  
4. Save changes  
**Success:** Changes are reflected on the public site

---

### Delete a Movie
**Actor:** Administrator  
**Goal:** Permanently remove a movie  
**Steps:**  
1. Go to “Movies” list  
2. Click “Delete”  
3. Confirm deletion  
**Success:** Movie is removed from the database

---

### Manage Studios, Actors, and Genres
**Actor:** Administrator  
**Goal:** Add/edit/delete supporting data  
**Steps:**  
1. Navigate to appropriate admin section  
2. Perform create/edit/delete actions  
**Success:** Data is updated and reflects correctly on related movies
