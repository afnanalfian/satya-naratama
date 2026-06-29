<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Selamat Datang — Satya Naratama</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family:Inter,Arial;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 0;">
                <table width="600" style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 8px 25px rgba(0,0,0,0.08)">
                    <tr>
                        <td style="background:#052659;padding:32px;text-align:center;">
                            <h1 style="color:white;font-size:28px;margin:0;font-weight:700;">
                                Satya Naratama
                            </h1>
                            <p style="color:#C1E8FF;margin-top:8px;">🎉 Selamat Bergabung!</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:32px;">
                            <p style="font-size:16px;color:#021024;">
                                Halo <strong>{{ $user->name }}</strong>,<br><br>
                                Selamat! Pendaftaran Anda di <strong>Satya Naratama</strong> telah diterima dan diverifikasi ✅
                            </p>

                            <div style="background:#f5f7fa;border-radius:12px;padding:20px;margin:20px 0;">
                                <p style="margin:0 0 8px 0;font-size:14px;color:#555;">
                                    <strong>📧 Email:</strong> {{ $user->email }}
                                </p>
                                <p style="margin:0;font-size:14px;color:#555;">
                                    <strong>🔑 Password:</strong> (Password yang Anda daftarkan)
                                </p>
                            </div>

                            <p style="text-align:center;margin:32px 0;">
                                <a href="{{ route('login') }}"
                                   style="background:#1E4E6D;color:white;padding:14px 32px;border-radius:10px;
                                          text-decoration:none;font-size:16px;font-weight:600;display:inline-block;">
                                    Login Sekarang
                                </a>
                            </p>

                            <p style="font-size:14px;color:#555;margin-top:20px;">
                                Jika Anda memiliki pertanyaan, silakan hubungi admin kami.
                            </p>

                            <p style="font-size:14px;color:#999;margin-top:40px;text-align:center;border-top:1px solid #eee;padding-top:20px;">
                                © {{ date('Y') }} Satya Naratama
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>