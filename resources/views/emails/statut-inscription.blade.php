<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mise à jour de votre inscription</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:32px 16px;">
  <tr><td align="center">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;">

      {{-- Header --}}
      <tr><td style="background:linear-gradient(135deg,#1e1b4b,#4338ca);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
        <p style="margin:0 0 6px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.55);">Journées Sahel Digital</p>
        <h1 style="margin:0;font-size:22px;font-weight:800;color:#fff;letter-spacing:-.02em;">Mise à jour de votre inscription</h1>
        <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,.72);">{{ $typeLabel }}</p>
      </td></tr>

      {{-- Body --}}
      <tr><td style="background:#fff;padding:36px 40px;">

        {{-- Status badge --}}
        <div style="text-align:center;margin-bottom:28px;">
          <span style="display:inline-block;background:{{ $statusColor }}1a;border:1.5px solid {{ $statusColor }}4d;color:{{ $statusColor }};font-weight:700;font-size:14px;padding:8px 22px;border-radius:999px;">
            {{ $statusLabel }}
          </span>
        </div>

        <p style="margin:0 0 16px;font-size:16px;color:#0f172a;line-height:1.6;">
          Bonjour <strong>{{ $nom }}</strong>,
        </p>
        <p style="margin:0 0 24px;font-size:15px;color:#475569;line-height:1.7;">
          {!! $statusMessage !!}
        </p>

        {{-- Status detail box --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8faff;border:1px solid #e2e8f0;border-left:4px solid {{ $statusColor }};border-radius:10px;margin-bottom:28px;">
          <tr><td style="padding:16px 20px;">
            <p style="margin:0 0 4px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:{{ $statusColor }};">Statut</p>
            <p style="margin:0;font-size:14px;color:#334155;font-weight:600;">{{ $statusLabel }} — {{ $typeLabel }}</p>
          </td></tr>
        </table>

        @if($status === 'approved')
        <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;">
          Félicitations et bienvenue parmi les participants ! Consultez votre tableau de bord pour les informations pratiques concernant l'événement.
        </p>
        @elseif($status === 'rejected')
        <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;">
          Nous vous remercions de l'intérêt que vous portez aux Journées Sahel Digital et nous espérons vous retrouver lors de prochaines éditions.
        </p>
        @else
        <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;">
          Consultez votre tableau de bord pour plus de détails.
        </p>
        @endif

        {{-- CTA --}}
        <div style="text-align:center;margin-bottom:8px;">
          <a href="{{ config('app.url') }}/dashboard" style="display:inline-block;background:{{ $statusColor }};color:#fff;text-decoration:none;font-weight:700;font-size:14px;padding:13px 32px;border-radius:10px;">
            Mon tableau de bord →
          </a>
        </div>

      </td></tr>

      {{-- Footer --}}
      <tr><td style="background:#f8faff;border:1px solid #e2e8f0;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
        <p style="margin:0 0 6px;font-size:12px;color:#94a3b8;">Journées Sahel Digital — {{ date('Y') }}</p>
        <p style="margin:0;font-size:12px;color:#cbd5e1;">Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
      </td></tr>

    </table>
  </td></tr>
</table>

</body>
</html>
