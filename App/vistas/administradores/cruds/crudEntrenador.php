<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach ($datos['usuAdmin'] as $admins) : ?>
        <p><?php echo $admins->dni ?></p>
        <p><?php echo $admins->nombre ?></p>
<?php endforeach ?>
</body>
</html>