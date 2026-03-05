@extends('layouts.app')

@section('styles')
<style>
/* ── Page header ── */
.page-header {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: #fff;
    padding: var(--space-16) var(--space-6);
    text-align: center;
}
.page-header h1 { font-size: var(--font-size-4xl); font-weight: 800; margin-bottom: var(--space-3); }
.page-header p  { font-size: var(--font-size-lg); opacity: .85; max-width: 600px; margin: 0 auto; }

/* ── Edition tabs (outer) ── */
.edition-tabs-wrapper {
    background: #fff;
    border-bottom: 2px solid var(--color-border);
    position: sticky;
    top: 64px;
    z-index: 10;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.edition-tabs-nav {
    display: flex;
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--space-6);
    overflow-x: auto;
    scrollbar-width: none;
}
.edition-tabs-nav::-webkit-scrollbar { display: none; }
.edition-tab-btn {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .9rem 1.5rem;
    font-size: .875rem;
    font-weight: 600;
    color: var(--color-text-muted);
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    cursor: pointer;
    white-space: nowrap;
    transition: color .2s, border-color .2s;
    position: relative;
    top: 2px;
}
.edition-tab-btn:hover { color: var(--color-primary); }
.edition-tab-btn.active {
    color: var(--color-primary);
    border-bottom-color: var(--color-primary);
}
.edition-tab-btn .ed-num {
    font-size: .65rem;
    font-weight: 700;
    padding: .15rem .55rem;
    border-radius: 999px;
    background: #eff6ff;
    color: var(--color-primary);
    transition: background .2s, color .2s;
}
.edition-tab-btn.active .ed-num {
    background: var(--color-primary);
    color: #fff;
}

/* ── Edition panel ── */
.edition-panel { display: none; }
.edition-panel.active { display: block; }

/* ── Inner tabs (Photos / Documents) ── */
.inner-tabs-wrapper {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 2rem var(--space-6) 0;
}
.inner-tabs-nav {
    display: inline-flex;
    background: var(--color-bg-section, #f8fafc);
    border-radius: 10px;
    padding: 4px;
    gap: 4px;
    margin-bottom: 1.75rem;
}
.inner-tab-btn {
    display: flex;
    align-items: center;
    gap: .45rem;
    padding: .5rem 1.25rem;
    font-size: .825rem;
    font-weight: 600;
    color: var(--color-text-muted);
    background: none;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    transition: background .18s, color .18s;
    white-space: nowrap;
}
.inner-tab-btn:hover { color: var(--color-primary); }
.inner-tab-btn.active {
    background: #fff;
    color: var(--color-primary);
    box-shadow: 0 1px 4px rgba(0,0,0,.1);
}
.inner-tab-btn .cnt {
    background: #e0e7ff;
    color: var(--color-primary);
    font-size: .65rem;
    font-weight: 700;
    padding: .1rem .45rem;
    border-radius: 999px;
}
.inner-panel { display: none; }
.inner-panel.active { display: block; }

/* ── Section inner ── */
.ressources-section {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--space-6) var(--space-12);
}

/* ── Photo grid ── */
.photo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: var(--space-6);
}
.photo-card {
    background: var(--color-bg-card);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: box-shadow var(--transition), transform var(--transition);
}
.photo-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
.photo-card img { width: 100%; height: 220px; object-fit: cover; display: block; }
.photo-card-body { padding: var(--space-4); }
.photo-card-body h3 { font-size: var(--font-size-base); font-weight: 700; color: var(--color-text); margin-bottom: var(--space-1); }
.photo-card-body p  { font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0; }

/* ── Documents grid ── */
.docs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: var(--space-4);
}
.doc-card {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-4) var(--space-5);
    background: var(--color-bg-card);
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-border);
    transition: box-shadow var(--transition), border-color var(--transition);
    text-decoration: none;
    color: inherit;
}
.doc-card:hover { box-shadow: var(--shadow-sm); border-color: var(--color-primary-light); color: inherit; }
.doc-icon {
    width: 48px; height: 48px; border-radius: var(--radius-lg);
    background: #eff6ff; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 1.5rem; color: var(--color-primary);
}
.doc-icon.pdf  { background: #fef2f2; color: #dc2626; }
.doc-icon.ppt  { background: #fff7ed; color: #ea580c; }
.doc-icon.zip  { background: #f0fdf4; color: #16a34a; }
.doc-meta h4   { font-size: var(--font-size-sm); font-weight: 700; color: var(--color-text); margin-bottom: 2px; }
.doc-meta span { font-size: .75rem; color: var(--color-text-muted); }

/* ── Coming soon ── */
.coming-soon {
    text-align: center;
    padding: var(--space-20) var(--space-6);
}
.coming-soon-icon { font-size: 3.5rem; color: var(--color-border); margin-bottom: var(--space-4); }
.coming-soon h3   { font-size: var(--font-size-xl); font-weight: 700; color: var(--color-text); margin-bottom: var(--space-2); }
.coming-soon p    { color: var(--color-text-muted); max-width: 420px; margin: 0 auto var(--space-6); }

@@media (max-width: 640px) {
    .photo-grid { grid-template-columns: 1fr; }
    .docs-grid  { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('content')

{{-- ── Page header ── --}}
<div class="page-header">
    <h1><i class="fas fa-photo-video"></i> Ressources</h1>
    <p>Photos et documents des éditions passées et à venir des Journées Sahel Digital</p>
</div>

{{-- ── Edition outer tabs ── --}}
<div class="edition-tabs-wrapper">
    <nav class="edition-tabs-nav" role="tablist" aria-label="Éditions JSD">
        @foreach($editions as $i => $ed)
        <button class="edition-tab-btn {{ $i === 0 ? 'active' : '' }}"
                data-edition-tab="ed{{ $ed->id }}"
                role="tab"
                aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
            <i class="fas fa-{{ $ed->est_courante ? 'calendar-check' : 'images' }}"></i>
            {{ $ed->nom }}
            <span class="ed-num">{{ $ed->numero }}{{ $ed->numero == 1 ? 'ère' : 'ème' }}</span>
        </button>
        @endforeach
    </nav>
</div>

{{-- ── Edition panels ── --}}
@foreach($editions as $i => $ed)
@php
    $data   = $ressourcesParEdition[$i];
    $photos = $data['photos'];
    $docs   = $data['docs'];
@endphp

<div id="panel-ed{{ $ed->id }}" class="edition-panel {{ $i === 0 ? 'active' : '' }}">

    {{-- Inner tab bar: Photos | Documents --}}
    <div class="inner-tabs-wrapper">
        <nav class="inner-tabs-nav" role="tablist">
            <button class="inner-tab-btn active"
                    data-inner-panel="photos{{ $ed->id }}"
                    role="tab" aria-selected="true">
                <i class="fas fa-images"></i> Photos
                @if($photos->isNotEmpty())
                <span class="cnt">{{ $photos->count() }}</span>
                @endif
            </button>
            <button class="inner-tab-btn"
                    data-inner-panel="docs{{ $ed->id }}"
                    role="tab" aria-selected="false">
                <i class="fas fa-file-alt"></i> Documents
                @if($docs->isNotEmpty())
                <span class="cnt">{{ $docs->count() }}</span>
                @endif
            </button>
        </nav>
    </div>

    {{-- Photos inner panel --}}
    <div id="photos{{ $ed->id }}" class="ressources-section inner-panel active">
        @if($photos->isNotEmpty())
        <div class="photo-grid">
            @foreach($photos as $photo)
            <div class="photo-card">
                @if($photo->fichier)
                    <img src="{{ asset('images/' . $photo->fichier) }}" alt="{{ $photo->titre }}" loading="lazy">
                @elseif($photo->lien)
                    <img src="{{ $photo->lien }}" alt="{{ $photo->titre }}" loading="lazy">
                @endif
                <div class="photo-card-body">
                    <h3>{{ $photo->titre }}</h3>
                    @if($photo->description)<p>{{ $photo->description }}</p>@endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="coming-soon">
            <div class="coming-soon-icon"><i class="fas fa-camera"></i></div>
            <h3>Aucune photo disponible</h3>
            <p>Les photos de {{ $ed->nom }} seront publiées ici
                @if($ed->date_fin && $ed->date_fin->isPast())
                    .
                @else
                    &nbsp;après l'événement. Restez connectés&nbsp;!
                @endif
            </p>
            @if($ed->est_courante)
            <a href="{{ route('concours.index') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> S'inscrire à {{ $ed->nom }}
            </a>
            @endif
        </div>
        @endif
    </div>

    {{-- Documents inner panel --}}
    <div id="docs{{ $ed->id }}" class="ressources-section inner-panel">
        @if($docs->isNotEmpty())
        <div class="docs-grid">
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
                $href = $doc->lien ?? ($doc->fichier ? asset('documents/' . $doc->fichier) : '#');
            @endphp
            <a href="{{ $href }}" class="doc-card" @if($doc->lien) target="_blank" rel="noopener" @endif>
                <div class="doc-icon {{ $iconClass }}"><i class="fas {{ $iconFa }}"></i></div>
                <div class="doc-meta">
                    <h4>{{ $doc->titre }}</h4>
                    @if($doc->description)<span>{{ $doc->description }}</span>@endif
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="coming-soon">
            <div class="coming-soon-icon"><i class="fas fa-file-alt"></i></div>
            <h3>Aucun document disponible</h3>
            <p>Les documents officiels de {{ $ed->nom }} seront publiés ici prochainement.</p>
        </div>
        @endif
    </div>

</div>{{-- /edition-panel --}}
@endforeach

@endsection

@section('scripts')
<script>
(function () {
    // ── Edition outer tabs ──────────────────────────────────────────────────
    document.querySelectorAll('.edition-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.edition-tab-btn').forEach(b => {
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

    // ── Inner tabs (Photos / Documents) — scoped per edition panel ─────────
    document.querySelectorAll('.inner-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            // Deactivate siblings in same nav
            const nav = this.closest('.inner-tabs-nav');
            nav.querySelectorAll('.inner-tab-btn').forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            // Hide inner panels in parent edition panel
            const edPanel = this.closest('.edition-panel');
            edPanel.querySelectorAll('.inner-panel').forEach(p => p.classList.remove('active'));

            // Activate selected
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            const target = document.getElementById(this.dataset.innerPanel);
            if (target) target.classList.add('active');
        });
    });
})();
</script>
@endsection
