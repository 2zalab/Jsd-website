@extends('layouts.app')

@section('styles')
<style>
.result-wrap {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
}
.result-card {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,.1);
    padding: 3rem 2.5rem;
    max-width: 480px;
    width: 100%;
    text-align: center;
}
.success-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #059669, #10b981);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2.5rem;
    box-shadow: 0 8px 24px rgba(5,150,105,.35);
    animation: pop .5s cubic-bezier(.175,.885,.32,1.275);
}
@keyframes pop {
    from { transform: scale(0); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}
.result-title {
    font-size: 1.7rem;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: .6rem;
}
.result-sub {
    font-size: .95rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 2rem;
}
.receipt-box {
    background: #f0fdf4;
    border: 1px solid #a7f3d0;
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    text-align: left;
}
.receipt-header {
    display: flex;
    align-items: center;
    gap: .6rem;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: #059669;
    margin-bottom: 1rem;
    padding-bottom: .75rem;
    border-bottom: 1px solid #a7f3d0;
}
.receipt-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: .9rem;
    padding: .35rem 0;
}
.receipt-row:not(:last-child) { border-bottom: 1px solid #d1fae5; }
.receipt-label { color: #64748b; }
.receipt-value { font-weight: 700; color: #0f172a; }
.receipt-amount { color: #059669 !important; font-size: 1.15rem; }

.action-btns {
    display: flex;
    flex-direction: column;
    gap: .75rem;
}
.btn-primary-donate {
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
.btn-primary-donate:hover {
    background: linear-gradient(135deg, #047857, #065f46);
    box-shadow: 0 6px 20px rgba(5,150,105,.4);
    color: #fff;
}
.btn-secondary-donate {
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
.btn-secondary-donate:hover { background: #e2e8f0; color: #334155; }

.confetti-strip {
    display: flex;
    justify-content: center;
    gap: .5rem;
    font-size: 1.4rem;
    margin-bottom: 1rem;
    animation: fadeInDown .6s ease .3s both;
}
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-12px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>
@endsection

@section('content')
<div class="result-wrap">
    <div class="result-card">

        <div class="confetti-strip">🎉 💚 🌍 💚 🎉</div>

        <div class="success-icon">✅</div>

        <h1 class="result-title">Merci pour votre don !</h1>
        <p class="result-sub">
            Votre générosité est précieuse.
            @if($donation)
                Votre don de <strong style="color:#059669;">{{ $donation->formatted_amount }}</strong> a bien été reçu et contribuera au développement numérique du Sahel.
            @else
                Votre don a bien été reçu et contribuera au développement numérique du Sahel.
            @endif
        </p>

        {{-- Reçu --}}
        @if($donation)
        <div class="receipt-box">
            <div class="receipt-header">
                <i class="fas fa-receipt"></i>
                Reçu de paiement
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Nom</span>
                <span class="receipt-value">{{ $donation->name }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Montant</span>
                <span class="receipt-value receipt-amount">{{ $donation->formatted_amount }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Opérateur</span>
                <span class="receipt-value">{{ $donation->operator_label }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Référence</span>
                <span class="receipt-value" style="font-size:.8rem;">{{ $donation->external_reference }}</span>
            </div>
            <div class="receipt-row">
                <span class="receipt-label">Date</span>
                <span class="receipt-value">{{ ($donation->paid_at ?? $donation->updated_at)->format('d/m/Y à H:i') }}</span>
            </div>
        </div>

        @if($donation->email)
        <p style="font-size:.82rem;color:#94a3b8;margin-bottom:1.5rem;">
            <i class="fas fa-envelope"></i>
            Un reçu a été envoyé à <strong>{{ $donation->email }}</strong>
        </p>
        @endif
        @endif

        <div class="action-btns">
            <a href="{{ route('donate.index') }}" class="btn-primary-donate">
                <i class="fas fa-heart"></i> Faire un autre don
            </a>
            <a href="{{ route('home') }}" class="btn-secondary-donate">
                <i class="fas fa-home"></i> Retour à l'accueil
            </a>
        </div>

    </div>
</div>
@endsection
