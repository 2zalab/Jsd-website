@extends('layouts.app')

@section('styles')
@include('legal._styles')
@endsection

@section('content')

{{-- Hero --}}
<section class="lp-hero">
    <div class="lp-hero-inner">
        <div class="lp-hero-icon"><i class="fas fa-circle-question"></i></div>
        <h1 style="color: aliceblue;">Foire aux questions</h1>
        <div class="lp-meta">
            <p class="faq-hero-desc">Trouvez rapidement les réponses à vos questions sur les Journées Sahel Digital.</p>
        </div>
    </div>
</section>

{{-- Breadcrumb --}}
<div class="lp-breadcrumb">
    <a href="{{ route('home') }}">Accueil</a>
    <span class="sep"><i class="fas fa-chevron-right" style="font-size:.65rem"></i></span>
    <span>FAQ</span>
</div>

<div class="faq-layout">

    {{-- Category filters --}}
    <div class="faq-categories" id="faqCats">
        <button class="faq-cat-btn active" data-cat="all"><i class="fas fa-border-all"></i> Tout afficher</button>
        <button class="faq-cat-btn" data-cat="general"><i class="fas fa-info-circle"></i> Informations générales</button>
        <button class="faq-cat-btn" data-cat="inscriptions"><i class="fas fa-pen-to-square"></i> Inscriptions &amp; Concours</button>
        <button class="faq-cat-btn" data-cat="sponsors"><i class="fas fa-handshake"></i> Partenariats &amp; Sponsors</button>
        <button class="faq-cat-btn" data-cat="contact"><i class="fas fa-envelope"></i> Newsletter &amp; Contact</button>
    </div>

    {{-- Groupe : Informations générales --}}
    <div class="faq-group" data-group="general">
        <div class="faq-group-title"><i class="fas fa-info-circle"></i> Informations générales</div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Qu'est-ce que les Journées Sahel Digital ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>Les Journées Sahel Digital (JSD) sont un événement annuel dédié au numérique, à l'innovation et à l'entrepreneuriat technologique dans la région du Sahel. Il réunit étudiants, professionnels, startups et passionnés de technologie autour de concours, conférences et ateliers.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Où et quand se déroule l'événement ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>L'édition {{ $edition->annee }} se déroule à {{ $edition->lieu ?? "N'Djamena, Tchad" }}. Les dates exactes sont communiquées sur la page d'accueil du site et via notre newsletter.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">L'événement est-il gratuit ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>L'accès aux conférences et à la grande salle est <strong>gratuit</strong> pour le public. Certaines compétitions peuvent nécessiter une inscription préalable. Consultez la page Concours pour plus de détails.</p>
            </div>
        </div>
    </div>

    {{-- Groupe : Inscriptions & Concours --}}
    <div class="faq-group" data-group="inscriptions">
        <div class="faq-group-title"><i class="fas fa-pen-to-square"></i> Inscriptions &amp; Concours</div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Comment s'inscrire à un concours ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
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
            <div class="faq-question">
                <span class="faq-q-text">Qui peut participer aux concours ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>Les concours sont ouverts aux lycéens et étudiants du supérieur selon les catégories. Certains concours acceptent également des équipes de professionnels. Consultez chaque page de concours pour les conditions de participation spécifiques.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Quelle est la date limite d'inscription ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>Les dates limites varient selon les concours. Elles sont précisées sur chaque page de concours. Nous vous conseillons de vous inscrire le plus tôt possible pour garantir votre place.</p>
            </div>
        </div>
    </div>

    {{-- Groupe : Partenariats & Sponsors --}}
    <div class="faq-group" data-group="sponsors">
        <div class="faq-group-title"><i class="fas fa-handshake"></i> Partenariats &amp; Sponsors</div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Comment devenir sponsor de JSD ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>Vous pouvez soumettre une demande de partenariat via la page <a href="{{ route('sponsor.form') }}">Devenir Sponsor</a>. Notre équipe vous contactera dans les meilleurs délais pour vous présenter les différentes formules de sponsoring disponibles.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Comment exposer lors de l'événement ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>Pour réserver un stand d'exposition, remplissez le formulaire dédié sur la page <a href="{{ route('concours.stand') }}">Concours — Stand</a>. Les stands sont disponibles pour les startups, entreprises et associations.</p>
            </div>
        </div>
    </div>

    {{-- Groupe : Newsletter & Contact --}}
    <div class="faq-group" data-group="contact">
        <div class="faq-group-title"><i class="fas fa-envelope"></i> Newsletter &amp; Contact</div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Comment s'inscrire à la newsletter ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>Entrez votre adresse email dans le formulaire newsletter présent en bas de chaque page du site. Vous recevrez les dernières actualités et annonces de JSD directement dans votre boîte mail.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span class="faq-q-text">Comment contacter l'équipe organisatrice ?</span>
                <span class="faq-icon"><i class="fas fa-plus"></i></span>
            </div>
            <div class="faq-answer">
                <p>Vous pouvez nous joindre via :</p>
                <ul>
                    <li>Le formulaire de <a href="{{ route('contact.index') }}">Contact</a> ;</li>
                    <li>Email : <a href="mailto:info@saheldigital.net">info@saheldigital.net</a> ;</li>
                    <li>Téléphone : +237 697 460 267.</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="faq-cta">
        <h3>Vous n'avez pas trouvé votre réponse ?</h3>
        <p>Notre équipe est disponible pour répondre à toutes vos questions.</p>
        <div class="cta-links">
            <a href="{{ route('contact.index') }}" class="cta-btn primary"><i class="fas fa-paper-plane"></i> Nous contacter</a>
            <a href="mailto:info@saheldigital.net" class="cta-btn secondary"><i class="fas fa-envelope"></i> info@saheldigital.net</a>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
// Accordion
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        const wasOpen = item.classList.contains('open');
        // Close all in same group
        btn.closest('.faq-group').querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
        if (!wasOpen) item.classList.add('open');
    });
});

// Category filter
document.querySelectorAll('.faq-cat-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.faq-cat-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const cat = btn.dataset.cat;
        document.querySelectorAll('.faq-group').forEach(group => {
            group.style.display = (cat === 'all' || group.dataset.group === cat) ? '' : 'none';
        });
    });
});
</script>
@endsection
