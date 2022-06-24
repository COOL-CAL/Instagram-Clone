<!DOCTYPE html>
<html lang="en">
<?php include_once "application/views/template/head.php"; ?>
<body>
    <div>
        <h1>Sign Up</h1>

        <form action="signup" method="post">
            <div><input type="email" name="email" placeholder="Email" autofocus required></div>
            <div><input type="password" name="pw" placeholder="Password" required></div>
            <div><input type="text" name="nm" placeholder="Name" required></div>
            <div>
                <input type="submit" value="Sign Up">
            </div>
        </form>
        <div>
            <a href="signup">회원가입</a>
        </div>
    </div>
</body>
</html>