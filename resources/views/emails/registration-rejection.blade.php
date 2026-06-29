<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Penolakan Pendaftaran — Satya Naratama</title>
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
                            <p style="color:#C1E8FF;margin-top:8px;">❌ Pemberitahuan Penolakan</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:32px;">
                            <p style="font-size:16px;color:#021024;">
                                Halo <strong>{{ $registration->full_name }}</strong>,<br><br>
                                Kami informasikan bahwa pendaftaran Anda di <strong>Satya Naratama</strong> telah ditolak.
                            </p>

                            @if($registration->rejection_reason)
                                <div style="background:#fef2f2;border-radius:12px;padding:20px;margin:20px 0;border-left:4px solid #ef4444;">
                                    <p style="margin:0;font-size:14px;color:#991b1b;">
                                        <strong>Alasan Penolakan:</strong><br>
                                        {{ $registration->rejection_reason }}
                                    </p>
                                </div>
                            @endif

                            <p style="font-size:14px;color:#555;margin:20px 0;">
                                Jika Anda memiliki pertanyaan atau ingin melakukan klarifikasi, silakan hubungi admin kami.
                            </p>

                            <p style="text-align:center;margin:32px 0;">
                                <a href="https://wa.me/6282154734819?text=Halo%20Admin%2C%20saya%20{{ $registration->full_name }}%20ingin%20klarifikasi%20penolakan%20pendaftaran"
                                   style="background:#25D366;color:white;padding:14px 32px;border-radius:10px;
                                          text-decoration:none;font-size:16px;font-weight:600;display:inline-block;">
                                    💬 Hubungi Admin
                                </a>
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
