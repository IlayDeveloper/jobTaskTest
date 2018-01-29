<h1>Type new values for change Profile</h1><br>
<?=$errors?>
<div>
    <form action="/profile/save?id=<?=$id?>" method='POST'>
        <h3>Firstname - <?=$firstName?></h3> <input value="<?=$firstName?>" name='firstName'><br>
        <h3>Lastname - <?=$lastName?></h3> <input value="<?=$lastName?>"name='lastName'><br>
        <h3>Login - <?=$login?></h3> <input value="<?=$login?>"name='login'><br>
        <h3>Password - <?=$pass?></h3> <input value="" name='password'><br>
        <h3>Mail - <?=$mail?></h3> <input value="<?=$mail?>"name='mail'><br>
        <input type='submit' value='Save changes'> <a href="/profile/check?id=<?=$id?>">Cancel</a>
    </form>
</div>
<a href='/auth/logout'>logout</a> <a href='/usersList'>Users list</a>
