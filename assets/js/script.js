const username = 'esra-sen';

document.addEventListener('DOMContentLoaded', () => {

    fetchDBProjects(); 

    const toggleBtn = document.getElementById('toggle-form-btn');
    const formContainer = document.getElementById('contact-form-container');
    const contactForm = document.getElementById('contact-form');

    // Form açma/kapama mantığı
    if (toggleBtn && formContainer) {
        toggleBtn.addEventListener('click', function() {
            const isHidden = formContainer.style.display === 'none' || formContainer.style.display === '';
            formContainer.style.display = isHidden ? 'block' : 'none';
            this.textContent = isHidden ? 'Close Form' : 'Leave a Message';
        });
    }

    // İletişim formu gönderimi
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const fullName = formData.get("full_name");
            const email = formData.get("email");
            const message = formData.get("message");

            if (!fullName || !email || !message) {
                alert("Please fill in all required fields.");
                return;
            }

            const responseDiv = document.getElementById('form-response');

            fetch('Includes/send_message.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                responseDiv.style.display = "block";
                responseDiv.style.opacity = "1";
               
                if (data.trim().toLowerCase().includes("success")) {
                    responseDiv.className = "response-success";
                    responseDiv.textContent = "Your message has been sent successfully!";
                    contactForm.reset();
                } else {
                    responseDiv.className = "response-error";
                    responseDiv.textContent = "An error occurred. Please try again.";
                }
               
                setTimeout(() => {
                    responseDiv.style.opacity = "0";
                    setTimeout(() => responseDiv.style.display = "none", 500);
                }, 5000);
            })
            .catch(err => {
                console.error("Error:", err);
                responseDiv.style.display = "block";
                responseDiv.textContent = "Connection error.";
            });
        });
    }
});

/**
 * Slider Kaydırma Fonksiyonu
 */
function moveSlide(direction) {
    const slider = document.getElementById('db-projects'); 
    if (!slider) return;

    const card = slider.querySelector('.project-card');
    if (!card) return;

    const cardWidth = card.offsetWidth;
    const style = window.getComputedStyle(slider);
    const gap = parseInt(style.gap) || 20;

    const scrollAmount = cardWidth + gap;

    slider.scrollBy({
        left: direction * scrollAmount,
        behavior: 'smooth'
    });
}

/**
 * Veritabanından projeleri çeken fonksiyon
 */
async function fetchDBProjects() {
    try {
        const response = await fetch('Includes/get_projects.php');
        const projects = await response.json();
        renderProjects(projects, 'db-projects');
    } catch (error) { 
        console.error('DB Error:', error); 
    }
}

/**
 * Projeleri ekrana basan fonksiyon
 */
function renderProjects(data, containerId) {
    const container = document.getElementById(containerId);
    if(!container) return;

    container.innerHTML = ''; // Önce temizle

    data.forEach(item => {
        const card = `
            <div class='project-card' onclick="window.open('${item.project_link}', '_blank')">
                <h3>${item.title}</h3>
                <p style="margin-top: 15px; color: #555;">${item.description || 'Project details'}</p>            </div>`;
        container.innerHTML += card;
    });
}