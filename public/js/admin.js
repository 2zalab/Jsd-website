// Récupération des données des projets depuis l'attribut data
const projetsData = document.getElementById('projectsData');
const projets = JSON.parse(projetsData.dataset.projects);

function openModal(projectId) {
    const projet = projets.find(p => p.id == projectId);
    if (projet) {
        document.getElementById('modalTitle').textContent = projet.nom_projet;
        document.getElementById('modalContent').innerHTML = `
            <p class="text-sm text-gray-700 mb-2"><strong>Équipe:</strong> ${projet.nom_equipe}</p>
            <p class="text-sm text-gray-700 mb-2"><strong>Chef d'équipe:</strong> ${projet.chef_equipe}</p>
            <p class="text-sm text-gray-700 mb-2"><strong>Email:</strong> ${projet.email_chef_equipe}</p>
            <p class="text-sm text-gray-700 mb-2"><strong>Établissement:</strong> ${projet.etablissement}</p>
            <p class="text-sm text-gray-700 mb-4"><strong>Description:</strong> ${projet.description || 'Non disponible'}</p>
            <a href="${projet.lien_youtube}" target="_blank" class="text-blue-600 hover:text-blue-800">Voir la vidéo YouTube</a>
        `;
        document.getElementById('projectModal').classList.remove('hidden');
    } else {
        alert('Projet non trouvé');
    }
}

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('projectModal').classList.add('hidden');
});

function deleteProject(projectId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) {
        // Ici, vous devriez faire une requête AJAX pour supprimer le projet
        console.log('Projet supprimé:', projectId);
        alert('Le projet a été supprimé (simulation)');
        // Recharger la page ou mettre à jour la liste des projets
    }
}

document.getElementById('search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

function downloadPDF() {
    // Simuler le téléchargement d'un PDF
    alert('Téléchargement du PDF en cours (simulation)');
    // Ici, vous devriez implémenter la logique réelle pour générer et télécharger le PDF
}
