<?php 
include "Includes/db.php"; 

// Verileri çekelim 
$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
$education = $pdo->query("SELECT * FROM education ORDER BY id DESC")->fetchAll();
$experience = $pdo->query("SELECT * FROM experience ORDER BY id DESC")->fetchAll();
$skills = $pdo->query("SELECT * FROM skills ORDER BY category ASC, skill_name ASC")->fetchAll();
$languages = $pdo->query("SELECT * FROM languages ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esra Nur Şen | Software Engineer Portfolio</title>
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
                    <?php foreach($education as $edu): ?>
                        <div class="edu-item">
                            <div class="edu-main-info">
                                <strong><?php echo htmlspecialchars($edu['institution']); ?></strong>
                                <span class="edu-separator">|</span>
                                <span class="edu-title-text"><?php echo htmlspecialchars($edu['title']); ?></span>
                            </div>
                            <p class="date-text"><?php echo htmlspecialchars($edu['date_range']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="info-block languages">
                    <h3>LANGUAGES</h3>
                    <?php foreach($languages as $lang): ?>
                        <p><?php echo htmlspecialchars($lang['language_name']); ?> | <?php echo htmlspecialchars($lang['level']); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="technical-expertise">
                <h3>TECHNICAL SKILLS</h3>
                <div class="skills-wrapper">
                    <?php
                    $groupedSkills = [];
                    foreach ($skills as $skill) {
                        $groupedSkills[$skill['category']][] = $skill['skill_name'];
                    }

                    foreach ($groupedSkills as $category => $items): ?>
                        <div class="skill-category">
                            <h4><?php echo htmlspecialchars($category); ?></h4>
                            <ul>
                                <?php foreach ($items as $item): ?>
                                    <li>
                                        <i class="fas fa-caret-right"></i>
                                        <?php echo htmlspecialchars($item); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="experience" class="section-container">
        <h2 class="section-title">Professional Experience</h2>
        <?php foreach($experience as $exp): ?>
            <div class="experience-item">
                <div class="exp-header">
                    <h3><?php echo htmlspecialchars($exp['position']); ?></h3>
                    <span class="date"><?php echo htmlspecialchars($exp['duration'] ?? ''); ?></span>
                </div>
                <p class="company"><?php echo htmlspecialchars($exp['company']); ?></p>
                <?php if(!empty($exp['description'])): ?>
                    <p class="exp-desc"><?php echo htmlspecialchars($exp['description']); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>

    <section id="projects" class="section-container">
        <h2 class="section-title">Projects</h2>
        <div class="slider-container">
            <button class="slider-btn prev-btn" onclick="moveSlide(-1)">&#10094;</button>
            <div id="db-projects" class="project-slider">
                <?php if(count($projects) > 0): ?>
                    <?php foreach($projects as $project): ?>
                        <div class="project-card">
                            <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                            <?php if(!empty($project['project_link'])): ?>
                                <a href="<?php echo htmlspecialchars($project['project_link']); ?>" target="_blank">View Project <i class="fas fa-external-link-alt"></i></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Henüz proje eklenmedi.</p>
                <?php endif; ?>
            </div>
            <button class="slider-btn next-btn" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </section>

    <footer id="contact">
        <div class="section-container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="social-links">
                <a href="https://linkedin.com/in/esra-nur-şen" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                <a href="https://github.com/esra-sen" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
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
                    <div id="form-response"></div>
                </form>
            </div>
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>