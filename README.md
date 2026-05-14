Professional Full-Stack Portfolio - README
This project is a comprehensive Full-Stack Web Portfolio developed as the final assignment for the SEN 3002 Internet and Web Programming course at Haliç University. It serves as a professional digital identity to showcase technical skills and projects to potential employers.

🛠 Technologies Used
Frontend: Semantic HTML5, Advanced CSS3 (Flexbox/Grid), JavaScript (ES6+).

Backend: PHP 8.x.

Database: MySQL.

Libraries: SweetAlert2 (for interactive alerts), FontAwesome (for iconography).

Design: Google Fonts (Playfair Display & Montserrat), Responsive Layouts.

🌟 Key Features
Dynamic Admin Dashboard: A secure, session-based management panel where projects, education, experience, and skills can be added or deleted.

AJAX Integration: Modern asynchronous data fetching using the Fetch API. Message details in the Admin Panel are loaded dynamically without refreshing the page.

Contact Management: A functional "Contact Me" section that validates user input via JavaScript and persists messages to the MySQL database.

Responsive Design: Fully compatible with mobile, tablet, and desktop devices using modern CSS techniques.

Secure Authentication: Protected admin routes using PHP Sessions to prevent unauthorized access.

📂 Project Structure
index.php: The main landing page showcasing the portfolio.

admin_panel.php: The central hub for content management.

get_message.php: AJAX endpoint for fetching message details.

Includes/db.php: Database connection settings.

assets/: Directory for CSS, JS, and image files.

sql_export.sql: Database schema and initial data (Essential for setup).

🔧 Setup Instructions
Clone the repository to your local server directory (e.g., htdocs for XAMPP).

Import the sql_export.sql file into your MySQL database via phpMyAdmin.

Configure your database credentials in Includes/db.php.

Access the project via localhost/my_portfolio.

👤 Developer
Esra Nur Şen
Software Engineering Student at Haliç University
