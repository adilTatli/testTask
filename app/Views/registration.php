<?php include_once('layouts/header.php');?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Register Form</h2>
            <div class="card my-5">

                <?php if (isset($errors) && is_array($errors) && !empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" class="card-body cardbody-color p-lg-5">

                    <div class="text-center">
                        <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                             width="200px" alt="profile">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="Username" aria-describedby="emailHelp"
                               placeholder="User Name" name="name">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="phone" aria-describedby="emailHelp"
                               placeholder="phone" name="phone">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp"
                               placeholder="email" name="email">
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="password" name="password">
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="repeatPassword" placeholder="repeatPassword" name="repeatPassword">
                    </div>

                    <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Register</button></div>

                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">Need to log in?
                        <a href="/login" class="text-dark fw-bold"> Login</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include_once('layouts/footer.php');?>