@extends('layouts.app')

@section('styles')
<style>
.result-wrap {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #fef2f2, #fff5f5);
}
.result-card {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.1);
    padding: 3rem 2.5rem;
    max-width: 460px;
    width: 100%;
    text-align: center;
}
.failure-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #fecaca, #fca5a5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2.5rem;
    box-shadow: 0 8px 24px rgba(239,68,68,.2);
    animation: pop .5s cubic-bezier(.175,.885,.32,1.275);
}
@keyframes pop {
    from { transform: scale(0); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}
.result-title {
    font-size: 1.6rem;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: .6rem;
}
.result-sub {
    font-size: .95rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.75rem;
}
.failure-info {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 14px;
    padding: 1.25rem;
    margin-bottom: 1.75rem;
    text-align: left;
    font-size: .88rem;
    color: #7f1d1d;
}
.failure-info-row {
    display: flex;
    justify-content: space-between;
    padding: .3rem 0;
    border-bottom: 1px solid #fecaca;
}
.failure-info-row:last-child { border-bottom: none; }

/* ── Causes possibles ── */
.causes-list {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 1.25rem;
    margin-bottom: 2rem;
    text-align: left;
}
.causes-list h4 {
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: .75rem;
}
.causes-list ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: .45rem;
}
.causes-list li {
    display: flex;
    align-items: flex-start;
    gap: .5rem;
    font-size: .88rem;
    color: #475569;
    line-height: 1.5;
}
.causes-list li i { color: #f59e0b; margin-top: .15rem; flex-shrink: 0; }

.action-btns {
    display: flex;
    flex-direction: column;
    gap: .75rem;
}
.btn-retry {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    background: linear-gradient(135deg, #059669, #047857);
    color: #fff;
    font-size: .95rem;
    font-weight: 700;
    padding: .85rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    transition: all .18s;
    box-shadow: 0 4px 14px rgba(5,150,105,.3);
}
.btn-retry:hover {
    background: linear-gradient(135deg, #047857, #065f46);
    color: #fff;
}
.btn-home {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    background: #f1f5f9;
    color: #475569;
    font-size: .9rem;
    font-weight: 600;
    padding: .8rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    transition: background .18s;
}
.btn-home:hover { background: #e2e8f0; color: #334155; }
</style>
@endsection

@section('content')
<div class="result-wrap">
    <div class="result-card">

        <div class="failure-icon">❌</div>

        <h1 class="result-title">Paiement échoué</h1>
        <p class="result-sub">
            Votre don de <strong>{{ $donation->formatted_amount }}</strong> n'a pas pu être traité. Aucun montant n'a été débité.
        </p>

        {{-- Détail transaction --}}
        <div class="failure-info">
            <div class="failure-info-row">
                <span style="color:#9f1239;font-weight:600;">Référence</span>
                <span style="font-size:.8rem;">{{ $donation->external_reference }}</span>
            </div>
            <div class="failure-info-row">
                <span style="color:#9f1239;font-weight:600;">Montant</span>
                <span>{{ $donation->formatted_amount }}</span>
            </div>
            <div class="failure-info-row">
                <span style="color:#9f1239;font-weight:600;">Numéro</span>
                <span>+{{ $donation->phone }}</span>
            </div>
        </div>

        {{-- Causes possibles --}}
        <div class="causes-list">
            <h4><i class="fas fa-info-circle"></i> Causes possibles</h4>
            <ul>
                <li><i class="fas fa-exclamation-triangle"></i> Solde insuffisant sur votre compte Mobile Money</li>
                <li><i class="fas fa-exclamation-triangle"></i> Délai de confirmation dépassé (2 minutes)</li>
                <li><i class="fas fa-exclamation-triangle"></i> Code PIN incorrect ou annulation de votre part</li>
                <li><i class="fas fa-exclamation-triangle"></i> Numéro de téléphone non enregistré sur Mobile Money</li>
            </ul>
        </div>

        <div class="action-btns">
            <a href="{{ route('donate.index') }}" class="btn-retry">
                <i class="fas fa-redo"></i> Réessayer le paiement
            </a>
            <a href="{{ route('home') }}" class="btn-home">
                <i class="fas fa-home"></i> Retour à l'accueil
            </a>
        </div>

    </div>
</div>
@endsection
