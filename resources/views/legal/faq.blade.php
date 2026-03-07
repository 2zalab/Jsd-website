@extends('layouts.app')

@section('styles')
<style>
.faq-page { max-width: 860px; margin: 0 auto; padding: var(--space-10) var(--space-6); }
.faq-page h1 { font-size: var(--font-size-3xl); font-weight: 700; color: var(--color-text); margin-bottom: var(--space-2); }
.faq-page .subtitle { color: var(--color-text-muted); margin-bottom: var(--space-8); }
.faq-item { border: 1px solid var(--color-border, #e5e7eb); border-radius: var(--radius-md); margin-bottom: var(--space-3); overflow: hidden; }
.faq-question { display: flex; justify-content: space-between; align-items: center; padding: var(--space-4) var(--space-5); cursor: pointer; font-weight: 600; color: var(--color-text); background: var(--color-surface, #f8f9fa); user-select: none; }
.faq-question:hover { background: var(--color-surface-hover, #f1f5f9); }
.faq-question .icon { transition: transform .25s ease; font-size: .85rem; }
.faq-item.open .faq-question .icon { transform: rotate(180deg); }
.faq-answer { max-height: 0; overflow: hidden; transition: max-height .3s ease, padding .3s ease; padding: 0 var(--space-5); }
.faq-item.open .faq-answer { max-height: 400px; padding: var(--space-4) var(--space-5); }
.faq-answer p, .faq-answer li { color: var(--color-text-muted); line-height: 1.7; }
.faq-answer ul { padding-left: 1.25rem; }
.faq-answer ul li { list-style: disc; margin-bottom: var(--space-1); }
.faq-category { font-size: var(--font-size-lg); font-weight: 700; color: var(--color-primary, #16a34a); margin: var(--space-8) 0 var(--space-4); }
</style>
@endsection

@section('content')
<section class="faq-page">
    <h1>Foire aux questions</h1>
    <p class="subtitle">Trouvez rapidement les réponses à vos questions sur les Journées Sahel Digital.</p>

    <p class="faq-category">Informations générales</p>

    <div class="faq-item">
        <div class="faq-question">Qu'est-ce que les Journées Sahel Digital ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>Les Journées Sahel Digital (JSD) sont un événement annuel dédié au numérique, à l'innovation et à l'entrepreneuriat technologique dans la région du Sahel. Il réunit étudiants, professionnels, startups et passionnés de technologie autour de concours, conférences et ateliers.</p></div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Où et quand se déroule l'événement ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>L'édition {{ $edition->annee }} se déroule à {{ $edition->lieu ?? 'N\'Djamena, Tchad' }}. Les dates exactes sont communiquées sur la page d'accueil du site et via notre newsletter.</p></div>
    </div>

    <div class="faq-item">
        <div class="faq-question">L'événement est-il gratuit ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>L'accès aux conférences et à la grande salle est gratuit pour le public. Certaines compétitions peuvent nécessiter une inscription préalable. Consultez la page Concours pour plus de détails.</p></div>
    </div>

    <p class="faq-category">Inscriptions &amp; Concours</p>

    <div class="faq-item">
        <div class="faq-question">Comment s'inscrire à un concours ? <span class="icon">▼</span></div>
        <div class="faq-answer">
            <p>Pour vous inscrire à un concours :</p>
            <ul>
                <li>Rendez-vous sur la page <a href="{{ route('concours.index') }}">Concours</a> ;</li>
                <li>Choisissez la catégorie qui vous correspond (Programmeur, Projet Digital, Hackathon, Stand) ;</li>
                <li>Remplissez le formulaire d'inscription en ligne ;</li>
                <li>Vous recevrez une confirmation par email.</li>
            </ul>
        </div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Qui peut participer aux concours ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>Les concours sont ouverts aux lycéens et étudiants du supérieur selon les catégories. Certains concours acceptent également des équipes de professionnels. Consultez chaque page de concours pour les conditions de participation spécifiques.</p></div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Quelle est la date limite d'inscription ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>Les dates limites varient selon les concours. Elles sont précisées sur chaque page de concours. Nous vous conseillons de vous inscrire le plus tôt possible pour garantir votre place.</p></div>
    </div>

    <p class="faq-category">Partenariats &amp; Sponsors</p>

    <div class="faq-item">
        <div class="faq-question">Comment devenir sponsor de JSD ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>Vous pouvez soumettre une demande de partenariat via la page <a href="{{ route('sponsor.form') }}">Devenir Sponsor</a>. Notre équipe vous contactera dans les meilleurs délais pour vous présenter les différentes formules de sponsoring disponibles.</p></div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Comment exposer lors de l'événement ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>Pour réserver un stand d'exposition, remplissez le formulaire dédié sur la page <a href="{{ route('concours.stand') }}">Concours — Stand</a>. Les stands sont disponibles pour les startups, entreprises et associations.</p></div>
    </div>

    <p class="faq-category">Newsletter &amp; Contact</p>

    <div class="faq-item">
        <div class="faq-question">Comment s'inscrire à la newsletter ? <span class="icon">▼</span></div>
        <div class="faq-answer"><p>Entrez votre adresse email dans le formulaire newsletter présent en bas de chaque page du site. Vous recevrez les dernières actualités et annonces de JSD directement dans votre boîte mail.</p></div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Comment contacter l'équipe organisatrice ? <span class="icon">▼</span></div>
        <div class="faq-answer">
            <p>Vous pouvez nous joindre via :</p>
            <ul>
                <li>Le formulaire de <a href="{{ route('contact.index') }}">Contact</a> ;</li>
                <li>Email : <a href="mailto:info@saheldigital.net">info@saheldigital.net</a> ;</li>
                <li>Téléphone : +237 697 460 267.</li>
            </ul>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        item.classList.toggle('open');
    });
});
</script>
@endsection
