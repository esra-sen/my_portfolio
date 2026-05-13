// 1. Form Doğrulama Fonksiyonu 
function validateForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let message = document.getElementById("message").value.trim();

    if (name === "" || email === "" || message === "") {
        alert("Please fill in all fields!");
        return false;
    }
    return true; // Her şey tamamsa true döner
}

// 2. Veritabanından Projeleri Çeken Fonksiyon 
async function fetchProjects() {
    try {
        // GitHub API yerine kendi PHP dosyamıza istek atıyoruz
        const response = await fetch('Includes/get_projects.php'); 
        const projects = await response.json();
        const container = document.getElementById('github-projects');
        
        if(container) {
            container.innerHTML = '';
            if(projects.length === 0) {
                container.innerHTML = '<p>No projects found in database.</p>';
                return;
            }
            projects.forEach(project => {
                const card = `
                    <div class='project-card' onclick="window.open('${project.project_link}', '_blank')">
                        <h3>${project.title}</h3>
                        <p style="margin-top: 15px; color: #555;">${project.description}</p>
                        <div class='category' style="margin-top: 20px;">Software Development</div>
                    </div>`; 
                container.innerHTML += card;
            });
        }
    } catch (error) { 
        console.error('Error:', error); 
    }
}

function moveSlide(direction) {
    const slider = document.getElementById('github-projects');
    if(slider) {
        const step = slider.clientWidth; 
        slider.scrollBy({ left: direction * step, behavior: 'smooth' });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetchProjects();

    const toggleBtn = document.getElementById('toggle-form-btn');
    const formContainer = document.getElementById('contact-form-container');
    const contactForm = document.getElementById('contact-form');

    if (toggleBtn && formContainer) {
        toggleBtn.addEventListener('click', function() {
            const isHidden = formContainer.style.display === 'none' || formContainer.style.display === '';
            formContainer.style.display = isHidden ? 'block' : 'none';
            this.textContent = isHidden ? 'Close Form' : 'Leave a Message';
        });
    }

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            //  Doğrulama burada çağrılmalı
            if (!validateForm()) {
                return; // Eğer boşsa fonksiyonu fetch'e geçme.
            }

            console.log("Form doğrulamadan geçti, gönderiliyor...");

            const formData = new FormData(this);
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
                    responseDiv.textContent = "Oops! Something went wrong.";
                }
                
                setTimeout(() => { 
                    responseDiv.style.opacity = "0";
                    setTimeout(() => {
                        responseDiv.style.display = "none";
                    }, 500);
                }, 5000);
            })
            .catch(err => {
                console.error("Hata:", err);
            });
        });
    }
});