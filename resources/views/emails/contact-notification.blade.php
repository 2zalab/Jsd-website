<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nouveau message de contact</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:32px 16px;">
  <tr><td align="center">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;">

      {{-- Header --}}
      <tr><td style="background:linear-gradient(135deg,#1e1b4b,#4338ca);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
        <p style="margin:0 0 6px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.55);">Journées Sahel Digital</p>
        <h1 style="margin:0;font-size:22px;font-weight:800;color:#fff;letter-spacing:-.02em;">Nouveau message de contact</h1>
        <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,.72);">Formulaire de contact — site JSD</p>
      </td></tr>

      {{-- Accent bar --}}
      <tr><td style="background:#6366f1;height:4px;"></td></tr>

      {{-- Body --}}
      <tr><td style="background:#fff;padding:36px 40px;">

        {{-- Sender info --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8faff;border:1px solid #e0e7ff;border-radius:10px;margin-bottom:24px;">
          <tr><td style="padding:16px 20px;">
            <p style="margin:0 0 8px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#6366f1;">Expéditeur</p>
            <p style="margin:0 0 4px;font-size:14px;color:#0f172a;"><strong>{{ $senderName }}</strong></p>
            <p style="margin:0;font-size:14px;color:#334155;"><a href="mailto:{{ $senderEmail }}" style="color:#6366f1;text-decoration:none;">{{ $senderEmail }}</a></p>
          </td></tr>
        </table>

        {{-- Message --}}
        <p style="margin:0 0 8px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#94a3b8;">Message</p>
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8faff;border:1px solid #e0e7ff;border-left:4px solid #6366f1;border-radius:10px;margin-bottom:28px;">
          <tr><td style="padding:20px 24px;">
            <p style="margin:0;font-size:15px;color:#334155;line-height:1.75;white-space:pre-line;">{{ $contactMessage }}</p>
          </td></tr>
        </table>

        <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;">
          Connectez-vous à l'administration pour gérer ce message.
        </p>

        {{-- CTA --}}
        <div style="text-align:center;margin-bottom:8px;">
          <a href="{{ config('app.url') }}/admin" style="display:inline-block;background:#4338ca;color:#fff;text-decoration:none;font-weight:700;font-size:14px;padding:13px 32px;border-radius:10px;">
            Voir l'administration →
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
