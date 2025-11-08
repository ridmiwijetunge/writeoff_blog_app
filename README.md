# WriteOff Blog App

A full-featured blogging platform built with PHP, MySQL, and Markdown support. Create, edit, and manage your blog posts with an intuitive interface and real-time Markdown preview.

## Features

- 📝 **Markdown Editor** - Write blog posts using Markdown with live preview
- 👤 **User Authentication** - Secure registration and login system
- ✏️ **CRUD Operations** - Create, Read, Update, and Delete blog posts
- 🎨 **Modern UI** - Clean and responsive design
- 👁️ **Blog Viewing** - Read and browse published blog posts
- 🔐 **User Accounts** - Personal account management
- 📱 **Responsive Design** - Works on desktop and mobile devices

## Technologies Used

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Markdown**: EasyMDE (Markdown Editor)
- **Server**: Apache (XAMPP)

## Prerequisites

Before you begin, ensure you have the following installed:
- [XAMPP](https://www.apachefriends.org/) (or any PHP + MySQL environment)
- A modern web browser
- Git (optional, for version control)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/ridmiwijetunge/writeoff_blog_app.git
cd writeoff_blog_app
```

### 2. Set Up the Database

1. Start your XAMPP Control Panel and start Apache and MySQL
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Create a new database (e.g., `blog_app`)
4. Import the database schema or create the necessary tables

### 3. Configure Database Connection

Update the database credentials in `db_connect.php`:

```php
<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "blog_app";
?>
```

### 4. Place Files in htdocs

Move the project folder to your XAMPP `htdocs` directory:
```
C:\xampp\htdocs\blog_app
```

### 5. Access the Application

Open your browser and navigate to:
```
http://localhost/blog_app
```

## Project Structure

```
blog_app/
│
├── config.php              # Configuration settings
├── db_connect.php          # Database connection
├── credentials.php         # Authentication credentials
│
├── login.php               # User login
├── register.php            # User registration
├── logout.php              # Logout functionality
│
├── home.php                # Homepage
├── my_account.php          # User account page
│
├── create_blog.php         # Create new blog post
├── edit_blog.php           # Edit existing blog post
├── delete_blog.php         # Delete blog post
├── view_blog.php           # View single blog post
├── view_my_blog.php        # View user's blogs
├── upload_blog.php         # Upload blog handler
├── update_blog.php         # Update blog handler
│
├── editor.php              # Markdown editor
├── easy_mde.js             # EasyMDE library
├── markdown_render.js      # Markdown rendering
├── edit_markdown.js        # Edit markdown functionality
├── view_blog.js            # View blog functionality
│
├── style.css               # Main stylesheet
├── create_blog.css         # Create blog styles
├── edit_blog.css           # Edit blog styles
├── my_blog.css             # My blog styles
├── my_blog_content.css     # Blog content styles
├── recent_blogs.css        # Recent blogs styles
├── edit_delete.css         # Edit/delete styles
├── edit.css                # Edit page styles
│
├── test.php                # Testing file
├── test_connection.php     # Database connection test
├── check.php               # Validation checks
│
└── .gitignore              # Git ignore file
```

## Usage

### Creating a Blog Post

1. Register or log in to your account
2. Navigate to "Create Blog"
3. Write your post using Markdown syntax
4. Preview your post in real-time
5. Click "Publish" to save your blog post

### Managing Your Blogs

1. Go to "My Blogs" to see all your posts
2. Click "Edit" to modify a post
3. Click "Delete" to remove a post

## Database Schema

The application requires the following tables (example):

**users table:**
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- username (VARCHAR)
- email (VARCHAR)
- password (VARCHAR, hashed)
- created_at (TIMESTAMP)

**blogs table:**
- id (INT, PRIMARY KEY, AUTO_INCREMENT)
- user_id (INT, FOREIGN KEY)
- title (VARCHAR)
- content (TEXT)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)

## Security Features

- Password hashing for user credentials
- SQL injection prevention
- Session management
- Input validation and sanitization

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Open a Pull Request

## Future Enhancements

- [ ] Add comment system
- [ ] Implement categories and tags
- [ ] Add search functionality
- [ ] Include image upload for blog posts
- [ ] Add user profile pages
- [ ] Implement social sharing
- [ ] Add pagination for blog listings

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

**Ridmi Wijetunge**
- GitHub: [@ridmiwijetunge](https://github.com/ridmiwijetunge)
- Email: ridmiwijetunge@gmail.com

## Acknowledgments

- EasyMDE for the Markdown editor
- XAMPP for the local development environment
- The PHP and MySQL communities

---

⭐ If you found this project helpful, please consider giving it a star on GitHub!