<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?
    if (isset($_POST['reg'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $user = ['name' => "$name", 'email' => "$email", 'phone' => "$phone"];
        $errors = validateForm($user);


    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data" name="reg">
        <h1>Регистрация</h1>
        <input type="text" name="name" placeholder="Имя" value="<?if(isset($_POST['reg'])) echo $name?>">
        <input type="text" name="email" placeholder="Почта" value="<?if(isset($_POST['reg'])) echo $email?>">
        <input type="text" name="phone" placeholder="Телефон" value="<?if(isset($_POST['reg'])) echo $phone?>">
        <input type="submit" value="Зарегистрироваться" name="reg">
        <p>
            <?
            if (isset($_POST['reg'])) {
                if (empty($errors)) {
                    echo "Форма успешно валидирована.";
                } else {
                    foreach ($errors as $error) {
                        echo $error . "<br>";
                    }
                }

            }
            ?>
        </p>
    </form>

    <?

    function validateForm($user)
    {
        $errors = [];

        if (empty($user['name'])) {
            $errors[] = "Поле 'Имя' не должно быть пустым.";
        } elseif (strlen($user['name']) < 3 || strlen($user['name']) > 50) {
            $errors[] = "Длина поля 'Имя' должна быть от 3 до 50 символов.";
        }

        if (empty($user['email'])) {
            $errors[] = "Поле 'Email' не должно быть пустым.";
        } elseif (strlen($user['email']) > 255) {
            $errors[] = "Длина поля 'Email' не должна превышать 255 символов.";
        } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Неверный формат email.";
        }

        if (empty($user['phone'])) {
            $errors[] = "Поле 'Номер телефона' не должно быть пустым.";
        } elseif (strlen($user['phone']) != 11) {
            $errors[] = "Номер телефона должен содержать 11 символов.";
        }

        return $errors;
    }

    ?>
</body>

</html>