<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password — Azwara Learning</title>

    <style>
        body {
            background-color: #F4F7FA;
            margin: 0;
            padding: 0;
            font-family: 'Inter', Arial, sans-serif;
        }

        .container {
            max-width: 520px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #E6EDF3;
        }

        .header {
            background: linear-gradient(135deg, #021024 0%, #052659 50%, #5483B3 100%);
            padding: 32px 24px;
            text-align: center;
            color: white;
        }

        .logo {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 32px 28px;
            color: #333;
        }

        .title {
            font-size: 22px;
            font-weight: 700;
            color: #052659;
            margin-bottom: 10px;
        }

        .text {
            line-height: 1.6;
            font-size: 15px;
            color: #555;
        }

        .btn {
            display: inline-block;
            margin: 24px 0;
            padding: 14px 24px;
            background-color: #5483B3;
            color: #fff !important;
            text-decoration: none;
            font-weight: 600;
            border-radius: 10px;
        }

        .footer {
            padding: 24px;
            font-size: 13px;
            text-align: center;
            color: #777;
        }

        .footer a {
            color: #5483B3;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- Header --}}
        <div class="header">
            <div class="logo">Azwara Learning</div>
        </div>

        {{-- Content --}}
        <div class="content">
            <h2 class="title">Permintaan Reset Password</h2>

            <p class="text">
                Kami menerima permintaan untuk mengatur ulang password akun Anda.
                Klik tombol di bawah ini untuk membuat password baru.
            </p>

            {{-- Reset Link --}}
            <a href="{{ $url }}" class="btn">Reset Password</a>

            <p class="text">
                Jika Anda tidak meminta reset password, abaikan email ini.
                Link ini hanya berlaku selama <strong>60 menit</strong>.
            </p>
        </div>

        {{-- Footer --}}
        <div class="footer">
            Email ini dikirim otomatis oleh sistem Azwara Learning.
            <br>
            Jika Anda mengalami masalah, hubungi:
            <a href="mailto:azwaralearning@gmail.com">azwaralearning@gmail.com</a>
        </div>

    </div>

</body>

</html>
