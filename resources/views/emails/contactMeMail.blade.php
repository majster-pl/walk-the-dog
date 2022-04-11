<!DOCTYPE html>
<html>
<head>
    <title>WalkTheDog.info</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <h3 style="color: red">{{ isset($details['editorRequest']) ? 'This is Editor Request email!' : ''}}</h3>
    <p>{{ $details['body'] }}</p>
   
    <small>from: {{ $details['email']}}</small>
    <p>Thank you</p>
</body>
</html>