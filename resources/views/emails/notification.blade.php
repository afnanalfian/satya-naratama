<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial; background:#f9fafb; padding:30px">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:12px;padding:24px">
        <h2 style="color:#111827">{{ config('app.name') }}</h2>

        <p>Halo {{ $user->name }},</p>

        <p style="font-size:15px;color:#374151">
            {{ $bodyMessage }}
        </p>

        @if($url)
            <p style="margin-top:20px">
                <a href="{{ $url }}"
                   style="background:#2563eb;color:#fff;
                          padding:10px 16px;border-radius:8px;
                          text-decoration:none;font-weight:bold">
                    Lihat Detail
                </a>
            </p>
        @endif

        <hr style="margin:30px 0">

        <small style="color:#6b7280">
            Email ini dikirim otomatis, mohon tidak membalas.
        </small>
    </div>
</body>
</html>
