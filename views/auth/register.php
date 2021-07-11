
<?php include VIEWS.'/layouts/header.php'?>
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
