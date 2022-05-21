<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('saveFile')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="cert"> <br> <br>
        <button type="submit">send</button>
    </form>
</body>
</html>