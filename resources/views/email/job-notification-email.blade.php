<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Notification Email</title>
</head>
<body>
    <h1>Hello {{ $mailData['employer']->name }}</h1>
    <p>Job title :  {{ $mailData['job']->title }}</p>
    <h3>Candidate Details</h3>
    <p>Candidate name :  {{ $mailData['user']->name }}</p>
    <p>Candidate email :  {{ $mailData['user']->email }}</p>
    <p>Candidate mobile :  {{ $mailData['user']->mobile }}</p>


</body>
</html>
