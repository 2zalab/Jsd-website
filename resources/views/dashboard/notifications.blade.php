@extends('dashboard._layout')
@php $pageTitle = 'Notifications'; $activeNav = 'notifications'; @endphp

@push('styles')
<style>
.page-hero{margin-bottom:1.5rem}
.page-hero h1{font-size:1.5rem;font-weight:800;color:#0f172a;margin-bottom:.25rem}
.page-hero p{color:#94a3b8;font-size:.875rem}

.ds-card{background:#fff;border-radius:16px;border:1px solid #e8ecf0;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.04)}
.ds-card-head{
    padding:1.1rem 1.5rem;border-bottom:1px solid #f1f5f9;
    display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.75rem
}
.ds-card-title{font-size:.95rem;font-weight:700;color:#0f172a}

.notif-row{
    display:flex;align-items:flex-start;gap:1rem;
    padding:1rem 1.5rem;border-bottom:1px solid #f8fafc;
    transition:background .15s;position:relative;
}
.notif-row:last-child{border-bottom:none}
.notif-row.unread{background:#f8faff}
.notif-icon{
    width:40px;height:40px;border-radius:50%;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;font-size:.95rem;
}
.notif-body{flex:1;min-width:0}
.notif-title-text{font-size:.9rem;font-weight:600;color:#0f172a;margin-bottom:.2rem}
.notif-msg{font-size:.83rem;color:#64748b;line-height:1.55}
.notif-meta{display:flex;align-items:center;gap:.75rem;margin-top:.375rem;flex-wrap:wrap}
.notif-time{font-size:.73rem;color:#94a3b8}
.notif-type-badge{font-size:.68rem;font-weight:700;padding:.15rem .5rem;border-radius:999px}

.unread-dot{width:8px;height:8px;border-radius:50%;background:#6366f1;flex-shrink:0;margin-top:.6rem}

.notif-actions{display:flex;gap:.375rem;flex-shrink:0;opacity:0;transition:opacity .15s}
.notif-row:hover .notif-actions{opacity:1}
.notif-action-btn{
    width:28px;height:28px;border-radius:8px;border:1px solid #e2e8f0;
    background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;
    font-size:.7rem;color:#94a3b8;transition:all .15s;
}
.notif-action-btn:hover{background:#fef2f2;border-color:#fca5a5;color:#ef4444}
.notif-action-btn.read-btn:hover{background:#f0fdf4;border-color:#86efac;color:#10b981}

.empty-box{text-align:center;padding:4rem 2rem}
.empty-box i{font-size:3rem;color:#cbd5e1;margin-bottom:1rem;display:block}
.empty-box p{color:#94a3b8;margin-bottom:1.25rem}

.mark-all-btn{
    display:inline-flex;align-items:center;gap:.4rem;
    background:none;border:1px solid #e2e8f0;border-radius:8px;
    padding:.45rem .875rem;font-size:.8rem;font-weight:600;color:#64748b;
    cursor:pointer;font-family:inherit;transition:all .15s;
}
.mark-all-btn:hover{background:#f0fdf4;border-color:#86efac;color:#059669}

.toast-wrap{position:fixed;bottom:1.5rem;right:1.5rem;z-index:999;display:flex;flex-direction:column;gap:.5rem}
.toast{
    background:#0f172a;color:#fff;padding:.75rem 1.25rem;border-radius:10px;
    font-size:.82rem;font-weight:500;display:flex;align-items:center;gap:.625rem;
    box-shadow:0 8px 24px rgba(0,0,0,.2);
    transform:translateX(110%);transition:transform .3s ease;pointer-events:all;
}
.toast.show{transform:translateX(0)}

@media(max-width:640px){
    .notif-row{padding:.875rem 1rem}
    .notif-actions{opacity:1}
}
</style>
@endpush

@section('content')

<div class="page-hero">
    <h1><i class="fas fa-bell" style="color:#6366f1;margin-right:.5rem"></i> Notifications</h1>
    <p>Tous vos messages et alertes importants</p>
</div>

<div class="ds-card">
    <div class="ds-card-head">
        <div class="ds-card-title">
            {{ $notifications->total() }} notification(s)
            @if($unread > 0)
            <span style="background:#eff6ff;color:#3b82f6;font-size:.7rem;font-weight:700;padding:.15rem .5rem;border-radius:999px;margin-left:.4rem">
                {{ $unread }} non lue(s)
            </span>
            @endif
        </div>
        @if($unread > 0)
        <button class="mark-all-btn" id="mark-all-btn" onclick="markAllRead()">
            <i class="fas fa-check-double"></i> Tout marquer comme lu
        </button>
        @endif
    </div>

    @if($notifications->isEmpty())
        <div class="empty-box">
            <i class="fas fa-bell-slash"></i>
            <p>Aucune notification pour le moment.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary" style="font-size:.875rem">
                <i class="fas fa-arrow-left"></i> Retour au tableau de bord
            </a>
        </div>
    @else
        @foreach($notifications as $notif)
        @php
            $colors = [
                'success' => ['#f0fdf4','#10b981','bg-green-50','text-green-700'],
                'error'   => ['#fef2f2','#ef4444','bg-red-50','text-red-700'],
                'warning' => ['#fffbeb','#f59e0b','bg-yellow-50','text-yellow-700'],
                'info'    => ['#eff6ff','#3b82f6','bg-blue-50','text-blue-700'],
            ];
            [$nbg, $nfg] = $colors[$notif->type] ?? ['#f8fafc','#64748b'];
            $typeLabels = ['success'=>'Succès','error'=>'Erreur','warning'=>'Avertissement','info'=>'Information'];
            $typeLabel  = $typeLabels[$notif->type] ?? 'Info';
        @endphp
        <div class="notif-row {{ $notif->isRead() ? '' : 'unread' }}" id="notif-{{ $notif->id }}">
            <div class="notif-icon" style="background:{{ $nbg }};color:{{ $nfg }}">
                <i class="fas {{ $notif->icon ?? 'fa-info-circle' }}"></i>
            </div>
            <div class="notif-body">
                <div class="notif-title-text">{{ $notif->title }}</div>
                <div class="notif-msg">{{ $notif->message }}</div>
                <div class="notif-meta">
                    <span class="notif-time"><i class="fas fa-clock" style="font-size:.65rem"></i> {{ $notif->created_at->diffForHumans() }} — {{ $notif->created_at->format('d/m/Y à H:i') }}</span>
                    <span class="notif-type-badge" style="background:{{ $nbg }};color:{{ $nfg }}">{{ $typeLabel }}</span>
                </div>
            </div>
            <div style="display:flex;flex-direction:column;align-items:center;gap:.375rem">
                <div class="notif-actions">
                    @if(!$notif->isRead())
                    <button class="notif-action-btn read-btn" title="Marquer comme lu" onclick="markRead({{ $notif->id }}, this)">
                        <i class="fas fa-check"></i>
                    </button>
                    @endif
                    <button class="notif-action-btn" title="Supprimer" onclick="deleteNotif({{ $notif->id }}, this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                @if(!$notif->isRead())<div class="unread-dot"></div>@endif
            </div>
        </div>
        @endforeach

        @if($notifications->hasPages())
        <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9">
            {{ $notifications->links() }}
        </div>
        @endif
    @endif
</div>

<div class="toast-wrap" id="toast-wrap"></div>

@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function showToast(msg, ok = true) {
    const wrap = document.getElementById('toast-wrap');
    const t = document.createElement('div');
    t.className = 'toast';
    t.style.borderLeft = `3px solid ${ok ? '#22c55e' : '#ef4444'}`;
    t.innerHTML = `<i class="fas ${ok ? 'fa-check-circle' : 'fa-exclamation-circle'}" style="color:${ok ? '#22c55e' : '#ef4444'}"></i>${msg}`;
    wrap.appendChild(t);
    setTimeout(() => t.classList.add('show'), 10);
    setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3000);
}

function markRead(id, btn) {
    fetch(`/mon-espace/notifications/${id}/read`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json ? r.json() : r).then(() => {
        const row = document.getElementById('notif-' + id);
        row.classList.remove('unread');
        // Remove the read button + unread dot
        btn.closest('.notif-actions')?.querySelector('.read-btn')?.remove();
        row.querySelector('.unread-dot')?.remove();
        showToast('Notification marquée comme lue');
    }).catch(() => showToast('Erreur', false));
}

function deleteNotif(id, btn) {
    fetch(`/mon-espace/notifications/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
    }).then(r => r.json()).then(data => {
        if (data.success) {
            const row = document.getElementById('notif-' + id);
            row.style.transition = 'opacity .2s, max-height .3s';
            row.style.opacity = '0';
            setTimeout(() => { row.style.maxHeight = '0'; row.style.padding = '0'; row.style.overflow = 'hidden'; }, 200);
            setTimeout(() => row.remove(), 500);
            showToast('Notification supprimée');
        }
    }).catch(() => showToast('Erreur', false));
}

function markAllRead() {
    fetch('{{ route('dashboard.notifications.read-all') }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
    }).then(() => {
        document.querySelectorAll('.notif-row.unread').forEach(r => r.classList.remove('unread'));
        document.querySelectorAll('.unread-dot').forEach(d => d.remove());
        document.querySelectorAll('.read-btn').forEach(b => b.remove());
        document.getElementById('mark-all-btn')?.remove();
        showToast('Toutes les notifications marquées comme lues');
    }).catch(() => showToast('Erreur', false));
}
</script>
@endpush
