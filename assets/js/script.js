const username = 'esra-sen';

async function fetchProjects() {
    try {
        const response = await fetch(`https://api.github.com/users/${username}/repos?sort=updated`);
        const repos = await response.json();
        const container = document.getElementById('github-projects');
        if(container) {
            container.innerHTML = '';
            repos.forEach(repo => {
                if (!repo.fork) {
                    const card = `
                        <div class='project-card' onclick="window.open('${repo.html_url}', '_blank')">
                            <h3>${repo.name}</h3>
                            <p style="margin-top: 15px; color: #555;">${repo.description ? repo.description : 'Explore this repository on GitHub.'}</p>
                            <div class='category' style="margin-top: 20px;">${repo.language || 'Software Development'}</div>
                        </div>`; 
                    container.innerHTML += card;
                }
            });
        }
    } catch (error) { console.error('Error:', error); }
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
    const responseDiv = document.getElementById('form-response');

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
            console.log("Form gönderiliyor...");

            const formData = new FormData(this);
            // responseDiv'in bu kapsamda tanımlı olduğundan emin oluyoruz
            const responseDiv = document.getElementById('form-response');

            fetch('Includes/send_message.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                console.log("Sunucu yanıtı:", data);
                responseDiv.style.display = "block";
                responseDiv.style.opacity = "1"; // Kaybolduktan sonra tekrar görünmesi için
                
                if (data.trim().toLowerCase().includes("success")) {
                    responseDiv.className = "response-success";
                    responseDiv.textContent = "Your message has been sent successfully!";
                    contactForm.reset(); // Kutuları temizle
                } else {
                    responseDiv.className = "response-error";
                    responseDiv.textContent = "Oops! Something went wrong. Please try again.";
                }
                
                // 5 saniye sonra yavaşça kaybolması için
                setTimeout(() => { 
                    responseDiv.style.opacity = "0";
                    setTimeout(() => {
                        responseDiv.style.display = "none";
                        responseDiv.style.opacity = "1";
                    }, 500);
                }, 5000);
            })
            .catch(err => {
                console.error("Hata oluştu:", err);
                responseDiv.style.display = "block";
                responseDiv.className = "response-error";
                responseDiv.textContent = "Connection error. Please try again.";
            });
        });
    }
}); // DOMContentLoaded kapanışı