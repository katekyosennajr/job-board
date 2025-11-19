<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lamaran Berhasil Dikirim</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9fafb; }
        .header { background-color: #4F46E5; color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { background-color: white; padding: 30px; border-radius: 0 0 8px 8px; }
        .success-badge { display: inline-block; background-color: #10B981; color: white; padding: 8px 16px; border-radius: 4px; margin-bottom: 20px; }
        .job-details { background-color: #f3f4f6; padding: 15px; border-left: 4px solid #4F46E5; margin: 20px 0; }
        .job-title { font-size: 18px; font-weight: bold; color: #4F46E5; }
        .job-meta { color: #666; margin-top: 8px; }
        .footer { text-align: center; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #999; font-size: 12px; margin-top: 20px; }
        .cta-button { display: inline-block; background-color: #4F46E5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Selamat! 🎉</h1>
            <p>Lamaran Anda Berhasil Dikirim</p>
        </div>
        
        <div class="content">
            <div class="success-badge">✓ BERHASIL DIKIRIM</div>
            
            <p>Halo <strong>{{ $candidateName }}</strong>,</p>
            
            <p>Kami ingin memberitahu bahwa lamaran Anda telah berhasil dikirim ke perusahaan. Tim HR akan segera meninjau profile dan CV Anda.</p>
            
            <div class="job-details">
                <div class="job-title">{{ $jobTitle }}</div>
                <div class="job-meta">
                    📍 {{ $jobLocation }}<br>
                    🏢 {{ $companyName }}
                </div>
            </div>
            
            <h3>Apa Selanjutnya?</h3>
            <ul>
                <li>Tim HR akan meninjau aplikasi Anda dalam 3-5 hari kerja</li>
                <li>Anda akan menerima notifikasi email jika dipanggil untuk interview</li>
                <li>Pantau status lamaran Anda di dashboard aplikasi</li>
            </ul>
            
            <p><strong>Tips:</strong> Pastikan email Anda aktif agar tidak melewatkan update dari perusahaan.</p>
            
            <div style="text-align: center;">
                <a href="{{ config('app.url') }}/my-applications" class="cta-button">Lihat Status Lamaran</a>
            </div>
            
            <div class="footer">
                <p>&copy; JobBoard Indonesia. Semua hak dilindungi.</p>
                <p>Email ini dikirim karena Anda mendaftarkan akun di JobBoard.</p>
            </div>
        </div>
    </div>
</body>
</html>
