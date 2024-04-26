<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Notification Email</title>
</head>
<body>
    <h1>Hello {{ $mailData['employer']->name }}</h1>
    <p>Job Title: {{ $mailData['job']->title }}</p>
    <h3>Candidate Details</h3>
    <p>Candidate name: {{ $mailData['user']->name }}</p>
    <p>Candidate email: {{ $mailData['user']->email }}</p>
    @if($mailData['user']->mobile)
        <p>Candidate mobile: {{ $mailData['user']->mobile }}</p>
    @endif
</body>
</html>
