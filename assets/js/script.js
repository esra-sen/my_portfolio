const username = 'esra-sen';

async function fetchProjects() {
    try {
        const response = await fetch(`https://api.github.com/users/${username}/repos?sort=updated`);
        const repos = await response.json();
        const container = document.getElementById('github-projects');
        container.innerHTML = '';

        repos.forEach(repo => {
            if (!repo.fork) {
                const card = `
                    <div class='project-card'>
                        <h3><a href='${repo.html_url}' target='_blank'>${repo.name}</a></h3>
                        <p>${repo.description ? repo.description : ''}</p>
                        <div class='tags'>${repo.language || 'Code'}</div>
                    </div>`; 
                container.innerHTML += card;
            }
        });
    } catch (error) {
        console.error('Error fetching projects:', error);
    }
}

let scrollAmount = 0;
function moveSlide(direction) {
    const slider = document.getElementById('github-projects');
    const step = 320;
    if (direction === 1) {
        scrollAmount += step;
    } else {
        scrollAmount -= step;
    }
    slider.scrollTo({
        left: scrollAmount,
        behavior: 'smooth'
    });
}

fetchProjects();