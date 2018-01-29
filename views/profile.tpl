<h1><u><?=$firstName?> <?=$lastName?></u> Profile </h1><br>

<div>
  <h2>Full info:</h2><br>
  <a href="/profile/change?id=<?=$id?>"><b><h2>Change profile</h2><b></a>
  <h3>Firstname - <?=$firstName?></h3><br>
  <h3>Lastname - <?=$lastName?></h3><br>
  <h3>Login - <?=$login?></h3><br>
  <h3>Mail - <?=$mail?></h3><br>
</div>
<h2><a href='/auth/logout'>logout</a> <a href='/usersList'>Users list</a></h2>
