<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="">
            {{csrf_field()}}
            <div>
                <input type="name" name="name">
            </div>
            <div>
                <input type="email" name="email">
            </div>
            <div>
                <input type="password" name="password">
            </div>
            <button type="submit">
                register
            </button>
        </form>
    </div>
</body>
</html>