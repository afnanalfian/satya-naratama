<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Verifikasi Email — Azwara Learning</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family:Inter,Arial;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 0;">
                <table width="600" style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 8px 25px rgba(0,0,0,0.08)">
                    <tr>
                        <td style="background:#052659;padding:32px;text-align:center;">
                            <h1 style="color:white;font-size:28px;margin:0;font-weight:700;">
                                Azwara Learning
                            </h1>
                            <p style="color:#C1E8FF;margin-top:8px;">Verifikasi Email Anda</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:32px;">
                            <p style="font-size:16px;color:#021024;">
                                Halo {{ $user->name }},<br><br>
                                Terima kasih telah mendaftar di <strong>Azwara Learning</strong> 🎉<br>
                                Untuk mengaktifkan akun Anda, silakan verifikasi dengan menekan tombol berikut:
                            </p>

                            <p style="text-align:center;margin:32px 0;">
                                <a href="{{ $verificationUrl }}"
                                   style="background:#5483B3;color:white;padding:14px 32px;border-radius:10px;
                                          text-decoration:none;font-size:16px;font-weight:600;display:inline-block;">
                                    Verifikasi Email
                                </a>
                            </p>

                            <p style="font-size:14px;color:#555;">
                                Jika tombol tidak berfungsi, salin & tempel link berikut di browser Anda:<br><br>
                                <span style="color:#052659;word-break:break-all;">
                                    {{ $verificationUrl }}
                                </span>
                            </p>

                            <p style="font-size:14px;color:#999;margin-top:40px;text-align:center;">
                                © {{ date('Y') }} Azwara Learning
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
