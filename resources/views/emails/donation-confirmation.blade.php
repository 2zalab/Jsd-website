<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirmation de don — Journées Sahel Digital</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:32px 16px;">
  <tr><td align="center">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;">

      {{-- Header --}}
      <tr><td style="background:linear-gradient(135deg,#064e3b,#059669);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
        <p style="margin:0 0 6px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.6);">Journées Sahel Digital</p>
        <h1 style="margin:0;font-size:22px;font-weight:800;color:#fff;letter-spacing:-.02em;">Merci pour votre don !</h1>
        <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,.75);">Votre générosité soutient l'innovation numérique</p>
      </td></tr>

      {{-- Body --}}
      <tr><td style="background:#fff;padding:36px 40px;">

        {{-- Icon --}}
        <div style="text-align:center;margin-bottom:28px;">
          <div style="display:inline-block;background:#f0fdf4;border:2px solid #a7f3d0;border-radius:50%;width:64px;height:64px;line-height:64px;text-align:center;font-size:30px;">💚</div>
        </div>

        <p style="margin:0 0 16px;font-size:16px;color:#0f172a;line-height:1.6;">
          Bonjour <strong>{{ $donation->name }}</strong>,
        </p>
        <p style="margin:0 0 24px;font-size:15px;color:#475569;line-height:1.7;">
          Votre don de <strong style="color:#059669;">{{ $donation->formatted_amount }}</strong> pour les <strong style="color:#0f172a;">Journées Sahel Digital</strong> a bien été reçu et validé. Merci infiniment pour votre soutien !
        </p>

        {{-- Détail du paiement --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0fdf4;border:1px solid #a7f3d0;border-left:4px solid #059669;border-radius:10px;margin-bottom:28px;">
          <tr><td style="padding:20px 24px;">
            <p style="margin:0 0 12px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#059669;">Récapitulatif du don</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="font-size:13px;color:#64748b;padding:4px 0;">Référence</td>
                <td style="font-size:13px;color:#0f172a;font-weight:600;text-align:right;">{{ $donation->external_reference }}</td>
              </tr>
              <tr>
                <td style="font-size:13px;color:#64748b;padding:4px 0;">Montant</td>
                <td style="font-size:13px;color:#059669;font-weight:700;text-align:right;">{{ $donation->formatted_amount }}</td>
              </tr>
              <tr>
                <td style="font-size:13px;color:#64748b;padding:4px 0;">Opérateur</td>
                <td style="font-size:13px;color:#0f172a;font-weight:600;text-align:right;">{{ strtoupper($donation->operator ?? 'Mobile Money') }}</td>
              </tr>
              <tr>
                <td style="font-size:13px;color:#64748b;padding:4px 0;">Date</td>
                <td style="font-size:13px;color:#0f172a;font-weight:600;text-align:right;">{{ $donation->created_at->format('d/m/Y à H:i') }}</td>
              </tr>
            </table>
          </td></tr>
        </table>

        <p style="margin:0 0 24px;font-size:14px;color:#64748b;line-height:1.6;">
          Votre contribution aide à promouvoir l'innovation et l'entrepreneuriat numérique dans la région du Sahel. Ensemble, nous construisons un avenir digital pour notre continent.
        </p>

        {{-- CTA --}}
        <div style="text-align:center;margin-bottom:8px;">
          <a href="{{ config('app.url') }}/donate" style="display:inline-block;background:#059669;color:#fff;text-decoration:none;font-weight:700;font-size:14px;padding:13px 32px;border-radius:10px;">
            Faire un autre don →
          </a>
        </div>

      </td></tr>

      {{-- Footer --}}
      <tr><td style="background:#f8faff;border:1px solid #e2e8f0;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
        <p style="margin:0 0 4px;font-size:12px;color:#94a3b8;">Journées Sahel Digital — {{ date('Y') }}</p>
        <p style="margin:0 0 4px;font-size:12px;color:#cbd5e1;">📧 info@saheldigital.net · 📞 +237 697 460 267</p>
        <p style="margin:0;font-size:11px;color:#cbd5e1;">Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
      </td></tr>

    </table>
  </td></tr>
</table>

</body>
</html>
