<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $notifTitle }}</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:32px 16px;">
  <tr><td align="center">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;">

      {{-- Header --}}
      <tr><td style="background:#1e1b4b;border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
        <p style="margin:0 0 6px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.55);">Journées Sahel Digital</p>
        <h1 style="margin:0;font-size:22px;font-weight:800;color:#fff;letter-spacing:-.02em;">{{ $notifTitle }}</h1>
      </td></tr>

      {{-- Accent bar --}}
      <tr><td style="background:{{ $accentColor }};height:4px;"></td></tr>

      {{-- Body --}}
      <tr><td style="background:#fff;padding:36px 40px;">

        <p style="margin:0 0 16px;font-size:16px;color:#0f172a;line-height:1.6;">
          Bonjour <strong>{{ $recipientName }}</strong>,
        </p>

        {{-- Message box --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8faff;border:1px solid #e0e7ff;border-left:4px solid {{ $accentColor }};border-radius:10px;margin-bottom:28px;">
          <tr><td style="padding:20px 24px;">
            <p style="margin:0;font-size:15px;color:#334155;line-height:1.75;">{{ $notifMessage }}</p>
          </td></tr>
        </table>

        <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;">
          Connectez-vous à votre espace personnel pour en savoir plus.
        </p>

        {{-- CTA --}}
        <div style="text-align:center;margin-bottom:8px;">
          <a href="{{ config('app.url') }}/dashboard" style="display:inline-block;background:{{ $accentColor }};color:#fff;text-decoration:none;font-weight:700;font-size:14px;padding:13px 32px;border-radius:10px;">
            Voir mon espace →
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
