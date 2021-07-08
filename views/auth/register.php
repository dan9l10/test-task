<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Bootstrap_logo.svg/2560px-Bootstrap_logo.svg.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Home
    </a>
</nav>
<?php if ($msg):?>
    <div class="alert">
        <?php foreach ($msg as $message):?>
            <p>
                <?php echo $message?>
            </p>
        <?php endforeach;?>
    </div>
<?php endif; ?>
<div class="container">
    <div class="card-body">
        <form method="post" action="/register/attempt">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm password</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>
