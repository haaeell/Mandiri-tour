<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $email->subject }}</title>
</head>
<body>
    <header>
        <h1>{{ $email->subject }}</h1>
        <hr>
    </header>

    <p>{!! nl2br(e($email->content)) !!}</p>
    

    <footer>
        <hr>
        <p>Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau masalah.</p>
        <p>Email: mandiritour@gmail.com | Telepon: 123-456-7890</p>
    </footer>
</body>
</html>
