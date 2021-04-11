<?php require_once 'header.php'?>

<header id="masthead" class="container-fluid">
    <div class="row header-row justify-content-sm-between">
        <div class="alert" role="alert">

        </div>
        <div class="col">
            <h1>Add User</h1>
        </div>

        <div class="col-md-2 col-4 btn-header">
            <div class="row justify-content-center justify-content-sm-end">
                <div class="row">
                    <div class="col">
                        <a href="/index.php"><button type="button" class="btn btn-secondary">Back</button></a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning user-add"  form="user-add">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="loaders loaders-none">
                <div class="loftloader-wrapper pl-wave">
                    <div class="loader">
                        <span></span>
                    </div>
                </div>
            </div>
            <form id="user-add" method="post" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="name" pattern="[a-zA-Zа-яА-ЯёЁ ]{3,}" name="name" required value="<?= $name?>">
                </div>
                <div class="mb-3">
                    <label for="last-name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last-name" pattern="[a-zA-Zа-яА-ЯёЁ ]{3,}" name="last-name" required value="<?= $last_name?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required value="<?= $email?>">
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once 'footer.php'?>
