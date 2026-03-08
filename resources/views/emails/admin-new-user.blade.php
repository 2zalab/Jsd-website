<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nouveau compte créé</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:32px 16px;">
  <tr><td align="center">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:580px;">

      {{-- Header --}}
      <tr><td style="background:#0f172a;border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
        <p style="margin:0 0 6px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.45);">Administration — JSD</p>
        <h1 style="margin:0;font-size:22px;font-weight:800;color:#fff;letter-spacing:-.02em;">Nouveau compte créé</h1>
        <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,.65);">Confirmation de création d'utilisateur</p>
      </td></tr>

      {{-- Body --}}
      <tr><td style="background:#fff;padding:36px 40px;">

        {{-- Icon --}}
        <div style="text-align:center;margin-bottom:28px;">
          <div style="display:inline-block;background:#f0fdf4;border:2px solid #bbf7d0;border-radius:50%;width:60px;height:60px;line-height:60px;text-align:center;font-size:26px;">👤</div>
        </div>

        <p style="margin:0 0 16px;font-size:16px;color:#0f172a;line-height:1.6;">
          Bonjour <strong>{{ $adminName }}</strong>,
        </p>
        <p style="margin:0 0 24px;font-size:15px;color:#475569;line-height:1.7;">
          Vous venez de créer un compte sur la plateforme <strong style="color:#0f172a;">Journées Sahel Digital</strong>. Voici un récapitulatif des informations du nouveau compte :
        </p>

        {{-- User info box --}}
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-left:4px solid #22c55e;border-radius:10px;margin-bottom:24px;">
          <tr><td style="padding:20px 24px;">
            <p style="margin:0 0 14px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#16a34a;">Compte créé</p>
            <table cellpadding="0" cellspacing="0">
              <tr>
                <td style="font-size:13px;color:#94a3b8;padding-right:16px;padding-bottom:10px;white-space:nowrap;vertical-align:top;">Nom complet</td>
                <td style="font-size:14px;color:#0f172a;font-weight:600;padding-bottom:10px;">{{ $newUserName }}</td>
              </tr>
              <tr>
                <td style="font-size:13px;color:#94a3b8;padding-right:16px;padding-bottom:10px;white-space:nowrap;vertical-align:top;">Adresse email</td>
                <td style="font-size:14px;color:#0f172a;font-weight:600;padding-bottom:10px;">{{ $newUserEmail }}</td>
              </tr>
              <tr>
                <td style="font-size:13px;color:#94a3b8;padding-right:16px;padding-bottom:10px;white-space:nowrap;vertical-align:top;">Rôle</td>
                <td style="padding-bottom:10px;">
                  <span style="display:inline-block;background:{{ $newUserRole === 'admin' ? '#fef3c7' : '#eff6ff' }};color:{{ $newUserRole === 'admin' ? '#92400e' : '#1d4ed8' }};font-size:11px;font-weight:700;padding:3px 10px;border-radius:999px;text-transform:uppercase;letter-spacing:.05em;">
                    {{ $newUserRole === 'admin' ? 'Administrateur' : 'Utilisateur' }}
                  </span>
                </td>
              </tr>
              <tr>
                <td style="font-size:13px;color:#94a3b8;padding-right:16px;white-space:nowrap;vertical-align:top;">Mot de passe</td>
                <td style="font-size:14px;color:#0f172a;font-weight:600;font-family:monospace;background:#fff;border:1px solid #e2e8f0;border-radius:6px;padding:4px 10px;display:inline-block;">{{ $newUserPassword }}</td>
              </tr>
            </table>
          </td></tr>
        </table>

        <p style="margin:0 0 8px;font-size:13px;color:#64748b;line-height:1.7;background:#fefce8;border:1px solid #fde047;border-radius:8px;padding:12px 16px;">
          📋 Conservez ces informations. Les identifiants ont également été envoyés directement à <strong>{{ $newUserEmail }}</strong>.
        </p>

      </td></tr>

      {{-- Footer --}}
      <tr><td style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
        <p style="margin:0 0 4px;font-size:12px;color:#94a3b8;">Journées Sahel Digital — Administration — {{ date('Y') }}</p>
        <p style="margin:0;font-size:11px;color:#cbd5e1;">Cet email est une confirmation automatique réservée aux administrateurs.</p>
      </td></tr>

    </table>
  </td></tr>
</table>

</body>
</html>
