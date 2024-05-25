
<a href="/users" class="btn btn-info float-right">Users</a>

<h2>Edit User</h2>
<form method="post" action="/user/<?= $user->id;?>/update">
    <div class="form-group">
        <label class="label-control">Name:</label>
        <input type="text" name="name" value="<?= $user->name; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label class="label-control">Email:</label>
        <input type="text" name="email" value="<?= $user->email;?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label class="label-control">Address:</label>
        <textarea name="address" rows="6" class="form-control"><?= $user->address;?></textarea>
    </div>
    <div class="form-group">
        <label class="label-control">URL:</label>
        <input type="text" name="url" value="<?= $user->url;?>" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>