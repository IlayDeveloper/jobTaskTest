<form action='signup' method='POST'>
    <input name='firstName' placeholder="firstName"><br>
    <input name='lastName' placeholder="lastName"><br>
    <input name='login' placeholder="login"><br>
    <input name='password' placeholder="password"><br>
    <input name='mail' placeholder="mail"><br>
    <input type="checkbox" name="role" value="1">Admin<br><br>
    <input type='submit' value='signup'>  <a href="/auth">login</a>
</form>
<?=$errors?>
