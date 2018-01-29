<br><h1>Users list</h1><h2><a href='/profile'>Go to my profile</a></h2>
<form action='/usersList/index' method='POST'>

  <table>
    <tr>
        <td><input type="submit" name="" value="SEARCH"></td>
        <td>
          <select name="columnSearch">
            <option value="none">none</option>
            <option value="login">login</option>
            <option value="firstName">firstName</option>
            <option value="lastName">lastName</option>
            <option value="mail">mail</option>
          </select>
        </td>
        <td><input type="text" name="enter" placeholder="chars..." value=""></td>
    </tr>
  </table>
  <br>Sorting:
  <select name="columnSort">
    <option value="none">none</option>
    <option value="login">login</option>
    <option value="firstName">firstName</option>
    <option value="lastName">lastName</option>
    <option value="mail">mail</option>
  </select>
  <input type="radio" checked name="sort" value="DESC">Up <input type="radio" name="sort" value="ASC">Down


</form>

<?=$table?>
