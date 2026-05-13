<?php
include "Includes/db.php";

$query = $pdo -> prepare("SELECT * FROM `projects` ORDER BY id DESC");
$query -> execute();
$projects = $query -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esra Nur Şen | Software Engineer Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
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
        <div class="hero-content">
            <div class="profile-frame">
            <img src="assets/img/profile.jpg" alt="Esra Nur Şen" class="profile-image">

            </div>
            <div class="hero-text">
                <h1>ESRA NUR ŞEN</h1>
                <p class="subtitle"><i>Software Engineering Student</i></p>
                
                <div class="bio">
                    <p>Haliç University | Junior Backend Developer with a focus on <b>.NET Architecture</b> and <b>Data Systems</b>. Passionate about building secure and scalable software solutions.</p>
                </div>

                <div class="technical-expertise">
                    <h3>Technical Expertise</h3>
                    <div class="skills-grid">
                        <span>C# & .NET 8.0</span>
                        <span>ASP.NET Core Web API</span>
                        <span>MS SQL Server</span>
                        <span>Python (Data Analysis)</span>
                        <span>JWT Auth</span>
                        <span>English (B2)</span>
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
            <p class="exp-desc">Developed an end-to-end software solution to modernize and automate corporate data transfer processes. Implemented <b>Policy Data Transfer Project</b> using C# and .NET environments.</p>
        </div>
    </section id= "projects">
        <h2>"Projects"</h2>
        <div class= "slider-container">
            <div id="github-projects" class="project-slider">
                <p>Projects are loading...</p>

            </div>
            <button class= "prev" onclick= "moveSlide(-1)">&#10094</button>
            <button class= "next" onclick= "moveSlide(1)">&#10095</button>
        </div>
    <section>

    </section>
    
    <main id="projects" class="section-container">
        <h2 class="section-title">Featured Projects</h2>
        <div class="projects-grid">
            <?php foreach($projects as $proje): ?>
                <div class="project-card">
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($proje['title']); ?></h3>
                        <p><?php echo htmlspecialchars($proje['description']); ?></p>
                        <div class="card-footer">
                            <span class="category"><?php echo htmlspecialchars($proje['category']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer id="contact">
        <div class="section-container">
            <h2 class="section-title">Get In Touch</h2>
                <a href="https://linkedin.com/in/esra-nur-şen" target="_blank">LinkedIn</a>
                <a href="https://github.com/esra-sen" target="_blank">GitHub</a>
            </div>
        </div>
    </footer>
<script src="assets/js/script.js"></script>
</body>
</html>