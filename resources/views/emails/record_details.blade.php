<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Record Details</title>
</head>
<body>
    <h3>Record Details</h3>
    @foreach ($record as $key => $value)
        <strong>{{ $key }}:</strong> {{ $value }}<br>
    @endforeach
</body>
</html>
