# 🎞️ Movie Database – Entity Relationship Diagram (ERD)

![ERD Diagram](movie_database_erd.png)

## 🔑 Primary Keys
- `movies`: movie_id
- `actors`: actor_id
- `studios`: studio_id
- `genres`: genre_id
- `movie_actor`: id
- `users`: user_id

## 🔗 Foreign Keys
- `movies.studio_id` → `studios.studio_id`
- `movies.genre_id` → `genres.genre_id`
- `movie_actor.movie_id` → `movies.movie_id`
- `movie_actor.actor_id` → `actors.actor_id`

## 🧑‍💻 User Table Notes
- Used to authenticate admins now, and can support public user features later (favorites, comments, etc.)
- Includes a `role` column to distinguish between 'admin' and 'user'

## 📌 Notes
- The `movie_actor` join table uses an auto-increment ID for easier admin CRUD.
- Each movie is associated with exactly one studio and one genre.
- Each movie can have many actors (many-to-many).
