<?php
    require_once 'header.php';
    include_once 'users/read.php';
?>
<header id="masthead" class="container-fluid">
    <div class="row header-row justify-content-sm-between">
        <div class="col">
            <h1>Users</h1>
        </div>
        <div class="col-md-2 col-4 btn-header">
            <div class="row justify-content-center justify-content-sm-end">
                <div class="row">
                    <div class="col">
                        <a href="user_add.php"><button type="button" class="btn btn-outline-warning"><b>Add User</b></button></a>                                   </div>
                </div>
            </div>
        </div>
    </div>



            <div class="row">
                <div class="col offset-md-10">
                <a href="/index.php"><button type="button" class="btn reset btn-outline-warning"><b>Reset Filter</b></button></a>
                </div>
            </div>


</header>

<div class="content">
    <table class="table table-hover">
        <thead>
        <tr class="table-warning">
            <th scope="col" desc="DESC" icon="0" name="id"><span>#</span></th>
            <th scope="col" desc="DESC" icon="0" name="first_name"><span>First Name</span></th>
            <th scope="col" desc="DESC" icon="0" name="last_name"><span>Last Name</span></th>
            <th scope="col" desc="DESC" icon="0" name="email"><span>Email</span></th>
            <th scope="col" desc="DESC" icon="0" name="create_date"><span>Create Date</span></th>
            <th scope="col" desc="DESC" icon="0" name="update_date"><span>Update Date</span></th>
            <th scope="col">Action</th>
        </tr>
        <tr class="table-secondary">
            <form id="search" method="post" action="">
                <th scope="col" name="search_id">
                    <input type="text" class="form-control" pattern="[1-9]*" name="id" placeholder="Search by id">
                </th>
                <th scope="col" name="search_first_name">
                    <input type="text" class="form-control" pattern="[a-zA-Zа-яА-ЯёЁ ]*" name="first_name" placeholder="Search by first name">
                </th>
                <th scope="col" name="search_last_name">
                    <input type="text" class="form-control" pattern="[a-zA-Zа-яА-ЯёЁ ]*" name="last_name" placeholder="Search by last name">
                </th>
                <th scope="col" name="search_email">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Search by email">
                </th>
                <th scope="col" name="search_create_date">
                    <input type="text" class="form-control" pattern="[0-9-: ]*" name="create_date" placeholder="Search by create date">
                </th>
                <th scope="col" name="search_update_date">
                    <input type="text" class="form-control" pattern="[0-9-: ]*" name="update_date" placeholder="Search by update date">
                </th>
                <th scope="col">
                    <button type="submit" class="btn btn-warning user-add"  form="search">Search</button>
                </th>
            </form>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users_arr as $user_arr):?>
            <tr class="tb-body">
                <th class="id" scope="row"><?= $user_arr['user_id'];?></th>
                <td class="first_name"><?= $user_arr['user_first_name']; ?></td>
                <td class="last_name"><?= $user_arr['user_last_name']; ?></td>
                <td class="email"><?= $user_arr['user_email']; ?></td>
                <td class="create_date"><?= $user_arr['create_date']; ?></td>
                <td class="update_date"><?= $user_arr['update_date']; ?></td>
                <td class="user_id"><a class="edit" href="user_edit.php?id=<?= $user_arr['user_id'];?>">Edit</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'?>
