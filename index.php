<?php
include "Includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esra Nur Şen | Software Engineer Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="logo">ESRA NUR ŞEN</div>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero" id="about">
        <div class="hero-top">
            <div class="profile-frame">
                <img src="assets/img/profile.jpg" alt="Esra Nur Şen" class="profile-image">
            </div>
            <div class="hero-title-group">
                <h1>ESRA NUR ŞEN</h1>
                <p class="subtitle"><i>Software Engineering Student</i></p>
            </div>
        </div>

        <div class="bio-details">
            <div class="info-row">
                <div class="info-block education">
                    <h3>EDUCATION</h3>
                    <p>Haliç University | Software Engineering</p>
                    <p class="date-text">2022 - 2027 (Expected)</p>
                </div>

                <div class="info-block languages">
                    <h3>LANGUAGES</h3>
                    <p>English | Professional Proficiency (B2)</p>
                    <p>Turkish | Native</p>
                </div>
            </div>

            <div class="technical-expertise">
                <h3>TECHNICAL SKILLS</h3>
                <div class="skills-wrapper">
                    <div class="skill-category">
                        <h4>Programming Languages</h4>
                        <ul>
                            <li>C#</li>
                            <li>Python</li>
                            <li>Java</li>
                            <li>C++</li>
                            <li>SQL (T-SQL, MySQL)</li>
                            <li>JavaScript</li>
                        </ul>
                    </div>

                    <div class="skill-category">
                        <h4>Web Development & Frameworks</h4>
                        <ul>
                            <li>ASP.NET Core Web API</li>
                            <li>.NET 8.0</li>
                            <li>PHP</li>
                            <li>HTML5 & CSS3</li>
                            <li>RESTful API</li>
                        </ul>
                    </div>

                    <div class="skill-category">
                        <h4>Security & Databases</h4>
                        <ul>
                            <li>JWT Authentication</li>
                            <li>MS SQL Server</li>
                            <li>MySQL</li>
                        </ul>
                    </div>

                    <div class="skill-category">
                        <h4>Tools & Libraries</h4>
                        <ul>
                            <li>Git & GitHub</li>
                            <li>ExcelDataReader</li>
                            <li>Pandas & NumPy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="experience" class="section-container">
        <h2 class="section-title">Professional Experience</h2>
        <div class="experience-item">
            <div class="exp-header">
                <h3>Software Engineering Intern</h3>
                <span class="date">June 2025 – July 2025</span>
            </div>
            <p class="company">Allianz Partners</p>
            <p class="exp-desc">Developed an end-to-end software solution to modernize and automate corporate data transfer processes. Implemented the <b>Policy Data Transfer Project</b>.</p>
        </div>
    </section>

    <section id="projects" class="section-container">
        <h2 class="section-title">Projects</h2>
        <div class="slider-container">
            <button class="slider-btn prev-btn" onclick="moveSlide(-1)">&#10094;</button>
            <div id="db-projects" class="project-slider">
                <p>Projects are loading...</p>
            </div>
            <button class="slider-btn next-btn" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </section>

    <footer id="contact">
        <div class="section-container">
            <h2 class="section-title">Get In Touch</h2>
            
            <div class="social-links">
                <a href="https://linkedin.com/in/esra-nur-şen" target="_blank" title="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://github.com/esra-sen" target="_blank" title="GitHub">
                    <i class="fab fa-github"></i>
                </a>
            </div>

            <button id="toggle-form-btn" class="form-toggle-btn">Leave a Message</button>

            <div id="contact-form-container" class="hidden-form">
                <form id="contact-form">
                    <div class="form-group">
                        <input type="text" name="full_name" placeholder="Full Name" required>
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <input type="text" name="subject" placeholder="Subject" required>
                    <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                    <button type="submit" class="submit-btn">Send Message</button>
                    <div id="form-response" style="margin-top: 20px; padding: 10px; border-radius: 5px; display: none; text-align: center; font-weight: bold;"></div>
                </form>
            </div>
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>