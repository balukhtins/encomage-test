<?php
require_once 'header.php';
require 'users/read_one.php';
?>

<header id="masthead" class="container-fluid">
    <div class="row header-row justify-content-sm-between">
        <div class="alert" role="alert">

        </div>
        <div class="col">
            <h1>User Edit</h1>
        </div>

        <div class="col-md-2 col-4 btn-header">
            <div class="row justify-content-center justify-content-sm-end">
                <div class="row">
                    <div class="col">
                        <a href="index.php"><button type="button" class="btn btn-secondary">Back</button></a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning"  form="user-edit">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col">
            <form id="user-edit" method="post" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="name" pattern="[a-zA-Zа-яА-ЯёЁ ]{3,}" name="name" required value="<?= $user_item['user_first_name']?>">
                </div>
                <div class="mb-3">
                    <label for="last-name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last-name" pattern="[a-zA-Zа-яА-ЯёЁ ]{3,}" name="last-name" required value="<?= $user_item['user_last_name']?>">
                </div>
                <input type="hidden"  name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            </form>
        </div>
    </div>
</div>
<?php require_once 'footer.php'?>
