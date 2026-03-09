@extends('layouts.app')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════ --}}
<section class="res-hero">
    <div class="res-hero__bg" style="background-image:url('{{ asset('images/ct_hack.png') }}')"></div>
    <div class="res-hero__overlay"></div>
    <div class="res-hero__content">
        <span class="res-eyebrow"><i class="fas fa-photo-video"></i> Médiathèque</span>
        <h1 class="res-hero__title">Ressources<br><em>JSD</em></h1>
        <p class="res-hero__sub">Photos, vidéos et documents officiels de chaque édition des Journées Sahel Digital</p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     EDITION SWITCHER
═══════════════════════════════════════════════════ --}}
<div class="res-switcher-wrap">
    <div class="res-switcher">
        @foreach($editions as $i => $ed)
        <button class="res-ed-btn {{ $i === 0 ? 'active' : '' }}"
                data-edition-tab="ed{{ $ed->id }}"
                role="tab"
                aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
            <span class="res-ed-btn__num">{{ $ed->numero }}{{ $ed->numero == 1 ? 'ère' : 'ème' }}</span>
            <span class="res-ed-btn__name">{{ $ed->nom }}</span>
            @if($ed->est_courante)
            <span class="res-ed-btn__badge">En cours</span>
            @endif
        </button>
        @endforeach
    </div>
</div>

{{-- ═══════════════════════════════════════════════════
     PANNEAUX PAR ÉDITION
═══════════════════════════════════════════════════ --}}
@foreach($editions as $i => $ed)
@php
    $data   = $ressourcesParEdition[$i];
    $photos = $data['photos'];
    $docs   = $data['docs'];
@endphp

<div id="panel-ed{{ $ed->id }}" class="edition-panel {{ $i === 0 ? 'active' : '' }}">

    {{-- Inner tab bar --}}
    <div class="res-inner-tabs-wrap">
        <div class="res-inner-tabs">
            <button class="res-inner-btn active"
                    data-inner-panel="photos{{ $ed->id }}"
                    role="tab" aria-selected="true">
                <i class="fas fa-images"></i>
                <span>Photos</span>
                @if($photos->isNotEmpty())
                <em>{{ $photos->count() }}</em>
                @endif
            </button>
            <button class="res-inner-btn"
                    data-inner-panel="docs{{ $ed->id }}"
                    role="tab" aria-selected="false">
                <i class="fas fa-file-alt"></i>
                <span>Documents</span>
                @if($docs->isNotEmpty())
                <em>{{ $docs->count() }}</em>
                @endif
            </button>
        </div>
    </div>

    {{-- ── Photos ── --}}
    <div id="photos{{ $ed->id }}" class="res-section inner-panel active">
        @if($photos->isNotEmpty())

        {{-- Première photo en hero --}}
        @php $heroPhoto = $photos->first(); $restPhotos = $photos->skip(1); @endphp
        <div class="res-photo-hero">
            @if($heroPhoto->fichier)
                <img src="{{ asset('storage/images/' . $heroPhoto->fichier) }}" alt="{{ $heroPhoto->titre }}" loading="lazy">
            @elseif($heroPhoto->lien)
                <img src="{{ $heroPhoto->lien }}" alt="{{ $heroPhoto->titre }}" loading="lazy">
            @endif
            <div class="res-photo-hero__caption">
                <h3>{{ $heroPhoto->titre }}</h3>
                @if($heroPhoto->description)<p>{{ $heroPhoto->description }}</p>@endif
            </div>
        </div>

        {{-- Mosaïque du reste --}}
        @if($restPhotos->isNotEmpty())
        <div class="res-mosaic">
            @foreach($restPhotos as $photo)
            <div class="res-mosaic__item">
                @if($photo->fichier)
                    <img src="{{ asset('storage/images/' . $photo->fichier) }}" alt="{{ $photo->titre }}" loading="lazy">
                @elseif($photo->lien)
                    <img src="{{ $photo->lien }}" alt="{{ $photo->titre }}" loading="lazy">
                @endif
                <div class="res-mosaic__caption">
                    <strong>{{ $photo->titre }}</strong>
                    @if($photo->description)<span>{{ $photo->description }}</span>@endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @else
        {{-- Empty state photo --}}
        <div class="res-empty-simple">
            <span class="res-empty-simple__icon"><i class="fas fa-camera-retro"></i></span>
            <h3>Photos bientôt disponibles</h3>
            <p>Les photos de <strong>{{ $ed->nom }}</strong> seront publiées ici
                @if($ed->date_fin && $ed->date_fin->isPast())
                    prochainement.
                @else
                    après l'événement. Restez connectés&nbsp;!
                @endif
            </p>
            @if($ed->est_courante)
            <a href="{{ route('dashboard') }}" class="res-btn">
                <i class="fas fa-user-plus"></i> S'inscrire à {{ $ed->nom }}
            </a>
            @endif
        </div>
        @endif
    </div>

    {{-- ── Documents ── --}}
    <div id="docs{{ $ed->id }}" class="res-section inner-panel">
        @if($docs->isNotEmpty())
        <div class="res-docs-grid">
            @foreach($docs as $doc)
            @php
                $cat       = strtolower($doc->categorie ?? 'pdf');
                $iconClass = match($cat) { 'ppt' => 'ppt', 'zip' => 'zip', default => 'pdf' };
                $iconFa    = match($cat) {
                    'ppt'  => 'fa-file-powerpoint',
                    'zip'  => 'fa-file-archive',
                    'docx' => 'fa-file-word',
                    'xlsx' => 'fa-file-excel',
                    default => 'fa-file-pdf',
                };
                $clr = match($cat) {
                    'ppt'  => '#ea580c',
                    'zip'  => '#16a34a',
                    'docx' => '#2563eb',
                    'xlsx' => '#16a34a',
                    default => '#dc2626',
                };
                $bg = match($cat) {
                    'ppt'  => '#fff7ed',
                    'zip'  => '#f0fdf4',
                    'docx' => '#eff6ff',
                    'xlsx' => '#f0fdf4',
                    default => '#fef2f2',
                };
                $href = $doc->lien ?? ($doc->fichier ? asset('storage/documents/' . $doc->fichier) : '#');
            @endphp
            <a href="{{ $href }}" class="res-doc-card"
               @if($doc->lien) target="_blank" rel="noopener" @endif>
                <div class="res-doc-card__icon" style="background:{{ $bg }}; color:{{ $clr }}">
                    <i class="fas {{ $iconFa }}"></i>
                </div>
                <div class="res-doc-card__body">
                    <h4>{{ $doc->titre }}</h4>
                    @if($doc->description)<p>{{ $doc->description }}</p>@endif
                    <span class="res-doc-card__type">{{ strtoupper($cat) }}</span>
                </div>
                <div class="res-doc-card__arrow">
                    <i class="fas fa-download"></i>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="res-empty-simple">
            <span class="res-empty-simple__icon"><i class="fas fa-folder-open"></i></span>
            <h3>Documents bientôt disponibles</h3>
            <p>Les documents officiels de <strong>{{ $ed->nom }}</strong> seront publiés ici prochainement.</p>
        </div>
        @endif
    </div>

</div>{{-- /edition-panel --}}
@endforeach

<style>
/* ═══════════════════════════════════════════
   RESSOURCES PAGE
═══════════════════════════════════════════ */

/* ── Hero ── */
.res-hero {
    position: relative;
    height: 65vh;
    min-height: 420px;
    display: flex;
    align-items: center;
    overflow: hidden;
}
.res-hero__bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center 40%;
    animation: resZoom 16s ease-in-out infinite alternate;
}
@keyframes resZoom {
    from { transform: scale(1.04); }
    to   { transform: scale(1.1); }
}
.res-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg,
        rgba(3,20,50,.9) 0%,
        rgba(3,40,30,.65) 55%,
        rgba(0,0,0,.2) 100%);
}
.res-hero__content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    width: 100%;
}
.res-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #34d399;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .18em;
    text-transform: uppercase;
    margin-bottom: 1.2rem;
}
.res-hero__title {
    font-size: clamp(3rem, 8vw, 6rem);
    font-weight: 900;
    line-height: 1.02;
    color: #fff;
    margin-bottom: 1.2rem;
    letter-spacing: -.03em;
}
.res-hero__title em {
    font-style: normal;
    background: linear-gradient(90deg, #34d399, #6ee7b7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.res-hero__sub {
    color: rgba(255,255,255,.7);
    font-size: 1rem;
    max-width: 480px;
    line-height: 1.7;
}

/* ── Switcher éditions ── */
.res-switcher-wrap {
    background: #0a1628;
    padding: 2rem;
    position: sticky;
    top: 64px;
    z-index: 20;
}
.res-switcher {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    gap: .8rem;
    overflow-x: auto;
    scrollbar-width: none;
    flex-wrap: wrap;
}
.res-switcher::-webkit-scrollbar { display: none; }
.res-ed-btn {
    display: flex;
    align-items: center;
    gap: .7rem;
    padding: .7rem 1.4rem;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 100px;
    color: rgba(255,255,255,.65);
    font-size: .88rem;
    font-weight: 600;
    cursor: pointer;
    transition: all .25s;
    white-space: nowrap;
    font-family: inherit;
}
.res-ed-btn:hover {
    background: rgba(52,211,153,.15);
    border-color: rgba(52,211,153,.4);
    color: #fff;
}
.res-ed-btn.active {
    background: linear-gradient(135deg, #059669, #10b981);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 4px 16px rgba(5,150,105,.4);
}
.res-ed-btn__num {
    background: rgba(255,255,255,.15);
    border-radius: 100px;
    padding: .15rem .5rem;
    font-size: .7rem;
    font-weight: 800;
}
.res-ed-btn.active .res-ed-btn__num { background: rgba(255,255,255,.25); }
.res-ed-btn__name { }
.res-ed-btn__badge {
    background: #fef3c7;
    color: #92400e;
    font-size: .65rem;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: .15rem .55rem;
    border-radius: 100px;
}

/* ── Panels ── */
.edition-panel { display: none; }
.edition-panel.active { display: block; }
.inner-panel { display: none; }
.inner-panel.active { display: block; }

/* ── Inner tabs ── */
.res-inner-tabs-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2.5rem 2rem 0;
}
.res-inner-tabs {
    display: inline-flex;
    background: #f1f5f9;
    border-radius: 14px;
    padding: 5px;
    gap: 4px;
}
.res-inner-btn {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .6rem 1.4rem;
    font-size: .88rem;
    font-weight: 600;
    color: #64748b;
    background: none;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background .18s, color .18s, box-shadow .18s;
    white-space: nowrap;
    font-family: inherit;
}
.res-inner-btn:hover { color: #0f172a; }
.res-inner-btn.active {
    background: #fff;
    color: #059669;
    box-shadow: 0 2px 8px rgba(0,0,0,.1);
}
.res-inner-btn em {
    font-style: normal;
    background: #d1fae5;
    color: #065f46;
    font-size: .68rem;
    font-weight: 800;
    padding: .12rem .5rem;
    border-radius: 100px;
}

/* ── Section container ── */
.res-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 2rem 5rem;
}

/* ── Photo hero ── */
.res-photo-hero {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    height: 420px;
    margin-bottom: 1rem;
    box-shadow: 0 16px 50px rgba(0,0,0,.15);
}
.res-photo-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .7s;
}
.res-photo-hero:hover img { transform: scale(1.03); }
.res-photo-hero__caption {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: linear-gradient(to top, rgba(0,0,0,.8) 0%, transparent 100%);
    padding: 2.5rem 2rem 1.5rem;
    color: #fff;
}
.res-photo-hero__caption h3 {
    font-size: 1.2rem;
    font-weight: 800;
    margin: 0 0 .3rem;
}
.res-photo-hero__caption p {
    font-size: .88rem;
    color: rgba(255,255,255,.75);
    margin: 0;
}

/* ── Mosaïque ── */
.res-mosaic {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: .8rem;
}
.res-mosaic__item {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    aspect-ratio: 4/3;
    cursor: pointer;
}
.res-mosaic__item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s;
}
.res-mosaic__item:hover img { transform: scale(1.08); }
.res-mosaic__caption {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(5,150,105,.85) 0%, transparent 50%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 1.2rem;
    opacity: 0;
    transition: opacity .35s;
    color: #fff;
}
.res-mosaic__item:hover .res-mosaic__caption { opacity: 1; }
.res-mosaic__caption strong { font-size: .95rem; font-weight: 700; display: block; }
.res-mosaic__caption span  { font-size: .8rem; opacity: .85; margin-top: .2rem; display: block; }

/* ── Documents ── */
.res-docs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1rem;
}
.res-doc-card {
    display: flex;
    align-items: center;
    gap: 1.2rem;
    padding: 1.3rem 1.5rem;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    text-decoration: none;
    color: inherit;
    transition: border-color .2s, box-shadow .2s, transform .2s;
}
.res-doc-card:hover {
    border-color: #a7f3d0;
    box-shadow: 0 8px 28px rgba(0,0,0,.09);
    transform: translateY(-2px);
    color: inherit;
}
.res-doc-card__icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.res-doc-card__body { flex: 1; min-width: 0; }
.res-doc-card__body h4 {
    font-size: .95rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 .25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.res-doc-card__body p {
    font-size: .82rem;
    color: #64748b;
    margin: 0 0 .4rem;
    line-height: 1.4;
}
.res-doc-card__type {
    display: inline-block;
    background: #f1f5f9;
    color: #475569;
    font-size: .65rem;
    font-weight: 800;
    letter-spacing: .1em;
    padding: .15rem .55rem;
    border-radius: 100px;
}
.res-doc-card__arrow {
    color: #94a3b8;
    font-size: .9rem;
    flex-shrink: 0;
    transition: color .2s, transform .2s;
}
.res-doc-card:hover .res-doc-card__arrow { color: #059669; transform: translateY(2px); }

/* ── Empty state simple ── */
.res-empty-simple {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 5rem 2rem;
    background: #f8fafc;
    border-radius: 20px;
    border: 2px dashed #e2e8f0;
    min-height: 280px;
}
.res-empty-simple__icon {
    width: 72px;
    height: 72px;
    background: #e2e8f0;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #94a3b8;
    margin-bottom: 1.5rem;
}
.res-empty-simple h3 {
    font-size: 1.2rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 .7rem;
}
.res-empty-simple p {
    color: #64748b;
    font-size: .95rem;
    line-height: 1.7;
    margin: 0 0 1.8rem;
    max-width: 400px;
}
.res-btn {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    padding: .8rem 1.8rem;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    border-radius: 12px;
    font-weight: 700;
    font-size: .9rem;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(5,150,105,.3);
    transition: transform .2s, box-shadow .2s;
}
.res-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(5,150,105,.45);
    color: #fff;
}

/* ═══ RESPONSIVE ═══ */
@media (max-width: 860px) {
    .res-photo-hero { height: 280px; }
    .res-mosaic { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
    .res-empty-simple { padding: 3rem 1.5rem; }
}
@media (max-width: 560px) {
    .res-mosaic { grid-template-columns: 1fr 1fr; }
    .res-docs-grid { grid-template-columns: 1fr; }
    .res-switcher { gap: .5rem; }
}
</style>

@endsection

@section('scripts')
<script>
(function () {
    // ── Edition switcher
    document.querySelectorAll('.res-ed-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.res-ed-btn').forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            document.querySelectorAll('.edition-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            const panel = document.getElementById('panel-' + this.dataset.editionTab);
            if (panel) panel.classList.add('active');
        });
    });

    // ── Inner tabs
    document.querySelectorAll('.res-inner-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const nav = this.closest('.res-inner-tabs');
            nav.querySelectorAll('.res-inner-btn').forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            const edPanel = this.closest('.edition-panel');
            edPanel.querySelectorAll('.inner-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            const target = document.getElementById(this.dataset.innerPanel);
            if (target) target.classList.add('active');
        });
    });
})();
</script>
@endsection
