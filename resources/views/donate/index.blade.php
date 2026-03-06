@extends('layouts.app')

@section('styles')
<style>
/* ── Page donation ── */
.donate-hero {
    background: linear-gradient(135deg, #064e3b 0%, #059669 60%, #10b981 100%);
    padding: 4rem 1rem 6rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.donate-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.donate-hero h1 {
    font-size: 2.5rem;
    font-weight: 900;
    color: #fff;
    margin-bottom: .75rem;
    line-height: 1.2;
    position: relative;
}
.donate-hero p {
    font-size: 1.1rem;
    color: rgba(255,255,255,.82);
    max-width: 520px;
    margin: 0 auto;
    position: relative;
}
.donate-badge {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: rgba(255,255,255,.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.25);
    color: #fff;
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .4rem 1rem;
    border-radius: 9999px;
    margin-bottom: 1.25rem;
    position: relative;
}

/* ── Card container ── */
.donate-card-wrap {
    max-width: 900px;
    margin: -3rem auto 4rem;
    padding: 0 1rem;
    position: relative;
    z-index: 1;
}
.donate-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,.12);
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1fr;
}
@media (max-width: 720px) {
    .donate-card { grid-template-columns: 1fr; }
    .donate-hero h1 { font-size: 1.75rem; }
}

/* ── Image panel ── */
.donate-img-panel {
    position: relative;
    min-height: 340px;
}
.donate-img-panel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.donate-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(6,78,59,.85) 0%, transparent 55%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 1.5rem;
}
.donate-img-overlay h2 {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: .4rem;
}
.donate-img-overlay p {
    color: rgba(255,255,255,.8);
    font-size: .85rem;
    line-height: 1.5;
}
@media (max-width: 720px) {
    .donate-img-panel { min-height: 220px; }
}

/* ── Form panel ── */
.donate-form-panel {
    padding: 2.5rem 2rem;
}
.donate-form-title {
    font-size: 1.3rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: .5rem;
}
.donate-form-sub {
    font-size: .9rem;
    color: #64748b;
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

/* ── Montants rapides ── */
.amount-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: .5rem;
    margin-bottom: 1rem;
}
.amount-btn {
    border: 2px solid #e2e8f0;
    background: #f8fafc;
    color: #334155;
    font-size: .85rem;
    font-weight: 700;
    padding: .55rem .5rem;
    border-radius: 10px;
    cursor: pointer;
    transition: all .18s;
    text-align: center;
}
.amount-btn:hover, .amount-btn.active {
    border-color: #059669;
    background: #f0fdf4;
    color: #059669;
}

/* ── Champs formulaire ── */
.form-group { margin-bottom: 1rem; }
.form-label {
    display: block;
    font-size: .8rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: .35rem;
    letter-spacing: .02em;
    text-transform: uppercase;
}
.form-input {
    width: 100%;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: .65rem .9rem;
    font-size: .95rem;
    color: #0f172a;
    background: #fff;
    transition: border-color .18s, box-shadow .18s;
    box-sizing: border-box;
}
.form-input:focus {
    outline: none;
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5,150,105,.12);
}
.form-input.error { border-color: #ef4444; }

/* ── Champ téléphone avec flag ── */
.phone-wrap {
    display: flex;
    align-items: center;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    transition: border-color .18s, box-shadow .18s;
    background: #fff;
}
.phone-wrap:focus-within {
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5,150,105,.12);
}
.phone-prefix {
    padding: .65rem .75rem;
    background: #f1f5f9;
    border-right: 2px solid #e2e8f0;
    font-size: .85rem;
    font-weight: 700;
    color: #475569;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: .4rem;
}
.phone-prefix .flag { font-size: 1.1rem; }
.phone-input {
    flex: 1;
    border: none;
    padding: .65rem .9rem;
    font-size: .95rem;
    color: #0f172a;
    background: transparent;
}
.phone-input:focus { outline: none; }

/* ── Champ montant custom ── */
.amount-custom-wrap {
    display: flex;
    align-items: center;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    transition: border-color .18s, box-shadow .18s;
}
.amount-custom-wrap:focus-within {
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5,150,105,.12);
}
.amount-custom-wrap input {
    flex: 1;
    border: none;
    padding: .65rem .9rem;
    font-size: 1rem;
    font-weight: 700;
    color: #059669;
    background: transparent;
}
.amount-custom-wrap input:focus { outline: none; }
.amount-currency {
    padding: .65rem .9rem;
    background: #f0fdf4;
    border-left: 2px solid #e2e8f0;
    font-size: .8rem;
    font-weight: 800;
    color: #059669;
    letter-spacing: .06em;
}

/* ── Bouton submit ── */
.donate-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .6rem;
    width: 100%;
    background: linear-gradient(135deg, #059669, #047857);
    color: #fff;
    font-size: 1rem;
    font-weight: 800;
    padding: .9rem 1.5rem;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all .2s;
    box-shadow: 0 4px 14px rgba(5,150,105,.35);
    margin-top: .5rem;
}
.donate-btn:hover {
    background: linear-gradient(135deg, #047857, #065f46);
    box-shadow: 0 6px 20px rgba(5,150,105,.45);
    transform: translateY(-1px);
}
.donate-btn:active { transform: translateY(0); }

/* ── Sécurité badge ── */
.secure-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .4rem;
    margin-top: .75rem;
    font-size: .78rem;
    color: #94a3b8;
}

/* ── Opérateurs ── */
.operators-row {
    display: flex;
    align-items: center;
    gap: .75rem;
    margin-top: .75rem;
    flex-wrap: wrap;
}
.operator-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .35rem .7rem;
    border-radius: 8px;
    font-size: .75rem;
    font-weight: 700;
}
.op-mtn { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
.op-orange { background: #fff7ed; color: #9a3412; border: 1px solid #fed7aa; }

/* ── Alerte erreur ── */
.form-error-box {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-left: 4px solid #ef4444;
    border-radius: 10px;
    padding: .85rem 1rem;
    margin-bottom: 1rem;
    font-size: .88rem;
    color: #b91c1c;
}
.form-error-box ul { margin: .35rem 0 0 1rem; padding: 0; }
.form-error-box li { margin-bottom: .2rem; }
</style>
@endsection

@section('content')

{{-- ── Hero ── --}}
<div class="donate-hero">
    <div class="donate-badge">
        <i class="fas fa-heart"></i> Faire un don
    </div>
    <h1>Soutenez les Journées<br>Sahel Digital</h1>
    <p>Chaque don contribue à promouvoir l'innovation et l'entrepreneuriat numérique dans la région du Sahel.</p>
</div>

{{-- ── Card ── --}}
<div class="donate-card-wrap">
    <div class="donate-card">

        {{-- Image --}}
        <div class="donate-img-panel">
            <img src="{{ asset('images/donate-desktop.png') }}" alt="Faire un don aux JSD" class="hidden md:block" style="height:100%;min-height:300px;">
            <img src="{{ asset('images/donate-image-mobile.png') }}" alt="Faire un don" class="block md:hidden" style="width:100%;height:220px;object-fit:cover;">
            <div class="donate-img-overlay">
                <h2>Ensemble, façonnons le futur numérique</h2>
                <p>Votre soutien finance les ateliers, conférences et concours qui forment les talents de demain.</p>
            </div>
        </div>

        {{-- Formulaire --}}
        <div class="donate-form-panel">
            <h2 class="donate-form-title">Votre don</h2>
            <p class="donate-form-sub">Paiement sécurisé via Mobile Money (MTN ou Orange)</p>

            {{-- Erreurs --}}
            @if ($errors->any())
            <div class="form-error-box">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('error'))
            <div class="form-error-box">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('donate.initiate') }}" method="POST" id="donationForm">
                @csrf

                {{-- Montants rapides --}}
                <div class="form-group">
                    <label class="form-label">Choisissez un montant</label>
                    <div class="amount-grid">
                        @foreach ([1000, 2000, 5000, 10000, 20000, 50000] as $preset)
                        <button type="button" class="amount-btn" data-amount="{{ $preset }}">
                            {{ number_format($preset, 0, ',', ' ') }} F
                        </button>
                        @endforeach
                    </div>
                </div>

                {{-- Montant personnalisé --}}
                <div class="form-group">
                    <label class="form-label" for="amount">Ou entrez votre montant</label>
                    <div class="amount-custom-wrap">
                        <input type="number" id="amount" name="amount" min="100" max="1000000"
                               value="{{ old('amount', 5000) }}" required placeholder="5000">
                        <span class="amount-currency">FCFA</span>
                    </div>
                </div>

                {{-- Téléphone --}}
                <div class="form-group">
                    <label class="form-label" for="phone">Numéro Mobile Money</label>
                    <div class="phone-wrap">
                        <div class="phone-prefix">
                            <span class="flag">🇨🇲</span>
                            <span>+237</span>
                        </div>
                        <input type="tel" id="phone" name="phone" class="phone-input"
                               placeholder="6XXXXXXXX" value="{{ old('phone') }}"
                               required maxlength="9" pattern="[6][5-9][0-9]{7}">
                    </div>
                    <p style="font-size:.75rem;color:#94a3b8;margin:.3rem 0 0;">Format: 6XXXXXXXX (9 chiffres, sans l'indicatif)</p>
                </div>

                {{-- Nom --}}
                <div class="form-group">
                    <label class="form-label" for="name">Nom complet</label>
                    <input type="text" id="name" name="name" class="form-input"
                           placeholder="Votre nom" value="{{ old('name') }}" required>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Email (pour le reçu)</label>
                    <input type="email" id="email" name="email" class="form-input"
                           placeholder="votre@email.com" value="{{ old('email') }}" required>
                </div>

                {{-- Bouton --}}
                <button type="submit" class="donate-btn" id="submitBtn">
                    <i class="fas fa-heart"></i>
                    <span>Faire un don maintenant</span>
                </button>

                <div class="secure-info">
                    <i class="fas fa-lock"></i>
                    Paiement sécurisé via CamPay
                </div>

                <div class="operators-row" style="justify-content:center;">
                    <span class="operator-badge op-mtn">
                        <i class="fas fa-mobile-alt"></i> MTN Mobile Money
                    </span>
                    <span class="operator-badge op-orange">
                        <i class="fas fa-mobile-alt"></i> Orange Money
                    </span>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
(function () {
    // ── Montants rapides ──
    const amountInput = document.getElementById('amount');
    const amountBtns  = document.querySelectorAll('.amount-btn');

    function setActive(val) {
        amountBtns.forEach(btn => {
            btn.classList.toggle('active', parseInt(btn.dataset.amount) === parseInt(val));
        });
    }

    amountBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            amountInput.value = this.dataset.amount;
            setActive(this.dataset.amount);
        });
    });

    amountInput.addEventListener('input', function () {
        setActive(this.value);
    });

    // Activer le montant par défaut
    setActive(amountInput.value);

    // ── Validation téléphone en temps réel ──
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 9);
    });

    // ── Spinner au submit ──
    const form      = document.getElementById('donationForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Traitement en cours…</span>';
    });
})();
</script>
@endsection
