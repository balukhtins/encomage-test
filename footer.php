<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</script>

<?php
$uri = basename($_SERVER['REQUEST_URI']);
$arr_url = explode('.', $uri);
if ($arr_url[0] == 'user_edit'){
    echo '<script src="js/user-edit.js"></script>';
}

if ($arr_url[0] == 'user_add'){
    echo '<script src="js/user-add.js"></script>';
}

if ($arr_url[0] == 'index'){
    echo '<script src="js/user-select.js"></script>';
}
?>
</body>
</html>
