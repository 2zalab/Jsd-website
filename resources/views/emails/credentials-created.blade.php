<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vos identifiants de connexion</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:32px 16px;">
  <tr><td align="center">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;">

      {{-- Header --}}
      <tr><td style="background:linear-gradient(135deg,#1e1b4b,#4338ca);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
        <p style="margin:0 0 6px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.55);">Journées Sahel Digital</p>
        <h1 style="margin:0;font-size:22px;font-weight:800;color:#fff;letter-spacing:-.02em;">Bienvenue sur JSD !</h1>
        <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,.72);">Votre compte a été créé avec succès</p>
      </td></tr>

      {{-- Body --}}
      <tr><td style="background:#fff;padding:36px 40px;">

        {{-- Icon --}}
        <div style="text-align:center;margin-bottom:28px;">
          <div style="display:inline-block;background:#eff6ff;border:2px solid #bfdbfe;border-radius:50%;width:60px;height:60px;line-height:60px;text-align:center;font-size:26px;">🔑</div>
        </div>

        <p style="margin:0 0 16px;font-size:16px;color:#0f172a;line-height:1.6;">
          Bonjour <strong>{{ $name }}</strong>,
        </p>
        <p style="margin:0 0 24px;font-size:15px;color:#475569;line-height:1.7;">
          Un compte a été créé pour vous sur la plateforme <strong style="color:#0f172a;">Journées Sahel Digital</strong>. Voici vos identifiants de connexion :
        </p>

        {{-- Credentials box --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8faff;border:1px solid #e0e7ff;border-left:4px solid #6366f1;border-radius:10px;margin-bottom:28px;">
          <tr><td style="padding:20px 24px;">
            <p style="margin:0 0 12px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#6366f1;">Vos identifiants</p>
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td style="font-size:13px;color:#94a3b8;padding-right:12px;padding-bottom:8px;white-space:nowrap;">Adresse email</td>
                <td style="font-size:14px;color:#0f172a;font-weight:600;padding-bottom:8px;">{{ $email }}</td>
              </tr>
              <tr>
                <td style="font-size:13px;color:#94a3b8;padding-right:12px;white-space:nowrap;">Mot de passe</td>
                <td style="font-size:14px;color:#0f172a;font-weight:600;font-family:monospace;background:#fff;border:1px solid #e2e8f0;border-radius:6px;padding:4px 10px;">{{ $password }}</td>
              </tr>
            </table>
          </td></tr>
        </table>

        <p style="margin:0 0 8px;font-size:14px;color:#ef4444;font-weight:600;line-height:1.6;">
          ⚠️ Pour votre sécurité, changez votre mot de passe dès votre première connexion.
        </p>
        <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;">
          Vous pouvez vous connecter dès maintenant et accéder à votre espace personnel.
        </p>

        {{-- CTA --}}
        <div style="text-align:center;margin-bottom:8px;">
          <a href="{{ config('app.url') }}/login" style="display:inline-block;background:#4338ca;color:#fff;text-decoration:none;font-weight:700;font-size:14px;padding:13px 32px;border-radius:10px;">
            Se connecter →
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
