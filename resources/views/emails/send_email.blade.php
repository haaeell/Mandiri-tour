<!-- resources/views/emails/your_email_marketing_template.blade.php -->

<html>
<head>
    <title>{{ $email->subject }}</title>
</head>
<body>
    <h1>{{ $email->subject }}</h1>
    <p>{!! nl2br(e($email->content)) !!}</p>
</body>
</html>
