<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Contact Email</title>
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif; font-size:16px">
    </body>
    <h1>You have recived a contact email.</h1>
    <p>Name: {{ $mailData['name'] }}</p>
    <p>Email: {{ $mailData['email'] }}</p>
    <p>Subject: {{ $mailData['subject'] }}</p>
    <p>Message:</p>
    <p> {{ $mailData['message'] }}</p>
</html>