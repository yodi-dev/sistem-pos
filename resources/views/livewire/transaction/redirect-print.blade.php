<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script>
        window.onload = function() {
            // Buka halaman print di tab baru
            const newWindow = window.open('{{ route('print.transaction') }}', '_blank');

            // Periksa apakah tab baru berhasil dibuka
            if (newWindow) {
                // Pastikan fokus tetap di tab utama
                newWindow.focus();

                // Tunda penutupan tab utama untuk memberi waktu cetak selesai
                setTimeout(() => {
                    window.location.href = "{{ url()->previous() }}";
                }, 1000);

            } else {
                alert('Pop-up diblokir oleh browser. Mohon izinkan pop-up untuk mencetak nota.');
                // Jika pop-up diblokir, kembalikan ke halaman sebelumnya
                window.location.href = "{{ url()->previous() }}";
            }
        };
    </script>
</head>

<body>
    <p>Redirecting to print...</p>
</body>

</html>
