<?php include_once('layouts/header.php');?>

<div class="container mt-5">
    <div class="row">
        <div class="col">

            <?php if (isset($successMessages) && is_array($successMessages) && !empty($successMessages)) : ?>
                <div class="alert alert-success">
                    <ul>
                        <?php foreach ($successMessages as $successMessage) : ?>
                            <li><?= $successMessage ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post">

                <div class="mb-3">
                    <h2>Данные пользователя <?= $_SESSION['user_name'] ?></h2>
                </div>

                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

                <div class="form-group">
                    <label for="name">Имя</label>
                    <input value="<?= $_SESSION['user_name'] ?>" type="text" class="form-control" id="name" aria-describedby="name" name="name">
                </div>

                <div class="form-group">
                    <label for="phone">Номер телефона</label>
                    <input value="<?= $_SESSION['user_phone'] ?>" type="text" class="form-control" id="phone" aria-describedby="phone" name="phone">
                </div>

                <div class="form-group">
                    <label for="email">Адрес электронной почты</label>
                    <input value="<?= $_SESSION['user_email'] ?>" type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Пароль</label>
                    <input value="<?= $_SESSION['user_password'] ?>" type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>

        </div>
    </div>
</div>

<?php include_once('layouts/footer.php');?>
