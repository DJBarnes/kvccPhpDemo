<html>
<head>
</head>
<body>
<div class="demo_add">
  <fieldset class = "add_record">
    <form name="demo" action="addToDatabase.php" method="post">
      <table>
        <tr>
          <td>
            <label>First Name:</label>
          </td>
          <td>
            <input type="text" name="first" id="first"></input>
          </td>
        </tr>
        <tr>
          <td>
            <label>Last Name:</label>
          </td>
          <td>
            <input type="text" name="last" id="last"></input>
          </td>
        </tr>
        <tr>
          <td>
            <label>County</label>
          </td>
          <td>
            <select>
              <option value="kalamazoo">Kalamazoo<option>
              <option value="kent">Kent<option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
              <label>Sex</label>
          </td>
          <td>
            <input type="radio" name="sex" value="yes">Yes Please!</input>
            <input type="radio" name="sex" value="no">Not so much!</input>
          </td>
        </tr>
        <tr>
          <td>
              <label>Are you crazy?</label>
          </td>
          <td>
              <input type="checkbox" name="crazy" value="crazy">
          </td>
        </tr>
      </table>
      <input type="submit" value="Submit">
    </form>
  </fieldset>
</div>
</body>