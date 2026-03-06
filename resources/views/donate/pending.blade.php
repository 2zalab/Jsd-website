@extends('layouts.app')

@section('styles')
<style>
.pending-wrap {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
}
.pending-card {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.1);
    padding: 3rem 2.5rem;
    max-width: 480px;
    width: 100%;
    text-align: center;
}
.pending-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2.5rem;
    animation: pulse-green 2s infinite;
}
@keyframes pulse-green {
    0%, 100% { box-shadow: 0 0 0 0 rgba(5,150,105,.4); }
    50%       { box-shadow: 0 0 0 16px rgba(5,150,105,0); }
}
.pending-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: .75rem;
}
.pending-sub {
    font-size: .95rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 2rem;
}
.pending-info-box {
    background: #f0fdf4;
    border: 1px solid #a7f3d0;
    border-radius: 14px;
    padding: 1.25rem;
    margin-bottom: 2rem;
    text-align: left;
}
.pending-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: .9rem;
    padding: .3rem 0;
}
.pending-info-row:not(:last-child) {
    border-bottom: 1px solid #d1fae5;
    margin-bottom: .3rem;
}
.pending-info-label { color: #64748b; }
.pending-info-value { font-weight: 700; color: #0f172a; }
.pending-amount { color: #059669 !important; font-size: 1.05rem; }

/* ── Steps ── */
.steps {
    display: flex;
    flex-direction: column;
    gap: .75rem;
    margin-bottom: 2rem;
    text-align: left;
}
.step {
    display: flex;
    align-items: center;
    gap: .85rem;
    font-size: .9rem;
    color: #475569;
}
.step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #059669;
    color: #fff;
    font-size: .75rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.step.done .step-num { background: #10b981; }
.step.done { color: #059669; font-weight: 600; }

/* ── Status indicator ── */
.status-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .6rem;
    background: #fef3c7;
    border: 1px solid #fde68a;
    border-radius: 10px;
    padding: .75rem 1rem;
    margin-bottom: 1.5rem;
    font-size: .88rem;
    color: #92400e;
    font-weight: 600;
}
.status-bar.success-bar {
    background: #f0fdf4;
    border-color: #a7f3d0;
    color: #065f46;
}
.status-bar.error-bar {
    background: #fef2f2;
    border-color: #fecaca;
    color: #b91c1c;
}
.spinner {
    width: 18px;
    height: 18px;
    border: 3px solid rgba(146,64,14,.2);
    border-top-color: #92400e;
    border-radius: 50%;
    animation: spin .8s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

.cancel-link {
    display: inline-block;
    font-size: .82rem;
    color: #94a3b8;
    text-decoration: none;
    margin-top: .5rem;
}
.cancel-link:hover { color: #64748b; }
</style>
@endsection

@section('content')
<div class="pending-wrap">
    <div class="pending-card">

        <div class="pending-icon">📱</div>

        <h1 class="pending-title">Confirmez sur votre téléphone</h1>
        <p class="pending-sub">
            Une demande de paiement a été envoyée au numéro <strong>+{{ $donation->phone }}</strong>.
            Veuillez composer votre code PIN Mobile Money pour valider le don.
        </p>

        {{-- Détails --}}
        <div class="pending-info-box">
            <div class="pending-info-row">
                <span class="pending-info-label">Montant</span>
                <span class="pending-info-value pending-amount">{{ $donation->formatted_amount }}</span>
            </div>
            <div class="pending-info-row">
                <span class="pending-info-label">Téléphone</span>
                <span class="pending-info-value">+{{ $donation->phone }}</span>
            </div>
            <div class="pending-info-row">
                <span class="pending-info-label">Référence</span>
                <span class="pending-info-value" style="font-size:.8rem;">{{ $donation->external_reference }}</span>
            </div>
        </div>

        {{-- Étapes --}}
        <div class="steps">
            <div class="step done">
                <div class="step-num"><i class="fas fa-check" style="font-size:.7rem;"></i></div>
                <span>Demande de paiement initiée</span>
            </div>
            <div class="step" id="step2">
                <div class="step-num">2</div>
                <span>Confirmez le paiement sur votre téléphone</span>
            </div>
            <div class="step" id="step3">
                <div class="step-num">3</div>
                <span>Validation et envoi du reçu par email</span>
            </div>
        </div>

        {{-- Status dynamique --}}
        <div class="status-bar" id="statusBar">
            <div class="spinner" id="spinner"></div>
            <span id="statusText">En attente de confirmation…</span>
        </div>

        <a href="{{ route('donate.cancel') }}" class="cancel-link">
            <i class="fas fa-arrow-left"></i> Retour / Annuler
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    const checkUrl   = '{{ route('donate.check') }}';
    const statusBar  = document.getElementById('statusBar');
    const statusText = document.getElementById('statusText');
    const spinner    = document.getElementById('spinner');
    const step2      = document.getElementById('step2');
    const step3      = document.getElementById('step3');
    let attempts     = 0;
    const maxAttempts = 40;

    function checkStatus() {
        if (attempts >= maxAttempts) {
            statusBar.className = 'status-bar error-bar';
            spinner.style.display = 'none';
            statusText.textContent = 'Délai dépassé. Vérifiez votre téléphone ou réessayez.';
            return;
        }

        fetch(checkUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'successful') {
                statusBar.className = 'status-bar success-bar';
                spinner.style.display = 'none';
                statusText.textContent = '✅ Paiement validé ! Redirection en cours…';
                step2.classList.add('done');
                step3.classList.add('done');
                setTimeout(() => { window.location.href = data.redirect; }, 1500);

            } else if (data.status === 'failed') {
                statusBar.className = 'status-bar error-bar';
                spinner.style.display = 'none';
                statusText.textContent = 'Paiement refusé. Veuillez réessayer.';
                setTimeout(() => { window.location.href = data.redirect; }, 2000);

            } else {
                // Encore pending — réessayer avec backoff
                attempts++;
                const delay = attempts < 6 ? 5000 : (attempts < 15 ? 8000 : 12000);
                setTimeout(checkStatus, delay);
            }
        })
        .catch(() => {
            attempts++;
            setTimeout(checkStatus, 8000);
        });
    }

    // Première vérification après 5 secondes
    setTimeout(checkStatus, 5000);
})();
</script>
@endsection
