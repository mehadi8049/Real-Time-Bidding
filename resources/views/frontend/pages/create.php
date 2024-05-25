
<a href="/users" class="btn btn-info float-right">Users</a>

<h2>Add New User</h2>
<form method="post" action="/user/store">
    <div class="form-group">
        <label class="label-control">Name:</label>
        <input type="text" name="name" value="<?= $_SESSION['old']['name']??"";?>" class="form-control" required>
        <p class="text-danger"><?= isset($_SESSION["errors"]['name'])?$_SESSION["errors"]['name']:"" ?></p>
    </div>
    <div class="form-group">
        <label class="label-control">Email:</label>
        <input type="text" name="email" value="<?= $_SESSION['old']['email']??"";?>" class="form-control" required>
        <p class="text-danger"><?= isset($_SESSION["errors"]['email'])?$_SESSION["errors"]['email']:"" ?></p>
    </div>
    <div class="form-group">
        <label class="label-control">Address:</label>
        <textarea name="address" rows="6" class="form-control"><?= $_SESSION['old']['address']??"";?></textarea>
        <p class="text-danger"><?= isset($_SESSION["errors"]['address'])?$_SESSION["errors"]['address']:"" ?></p>
    </div>
    <div class="form-group">
        <label class="label-control">URL:</label>
        <input type="text" name="url" value="<?= $_SESSION['old']['url']??"";?>" class="form-control">
        <p class="text-danger"><?= isset($_SESSION["errors"]['url'])?$_SESSION["errors"]['url']:"" ?></p>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>