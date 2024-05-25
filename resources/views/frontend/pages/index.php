
    
        <a href="/user/create" class="btn btn-info float-right">Add New Users</a>
        
        <h2>Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->id; ?></td>
                    <td><?= $user->name; ?></td>
                    <td><?= $user->email; ?></td>
                    <td><?= $user->address; ?></td>
                    <td><?= $user->url; ?></td>
                    <td width="150px">
                        <a href="/user/<?= $user->id; ?>/edit" class="btn btn-dark btn-sm float-left">Edit</a>
                        <form method="post" action="/user/<?= $user->id; ?>/delete">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm float-right">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    
