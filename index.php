<html>
<head>
</head>
<body>
<div class="demo_add">
  <h2>Add New Record</h2>
  <fieldset class = "add_record">
    <form name="demo" action="addToDatabase.php" method="post">
      <table>
        <tr>
          <td>
            <label>First Name:</label>
          </td>
          <td>
            <input type="text" name="first" id="first">
          </td>
        </tr>
        <tr>
          <td>
            <label>Last Name:</label>
          </td>
          <td>
            <input type="text" name="last" id="last">
          </td>
        </tr>
        <tr>
          <td>
            <label>County:</label>
          </td>
          <td>
            <select name="countyId">
              <option value="1">Kalamazoo<option>
              <option value="2">Kent<option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
              <label>Sex:</label>
          </td>
          <td>
            <input type="radio" name="sex" value="1">Yes Please!<br />
            <input type="radio" name="sex" value="0">Not so much!
          </td>
        </tr>
        <tr>
          <td>
              <label>Are you crazy?</label>
          </td>
          <td>
              <input type="checkbox" name="crazy" value="1">
          </td>
        </tr>
      </table>
      <input type="submit" value="Add New">
    </form>
  </fieldset>
  <h2>Search For A Person</h2>
  <fieldset>
    <form name="search" action="searchResults.php" method="post">
      <table>
        <tr>
          <td>
            <label>First Name:</label>
          </td>
          <td>
            <input type="text" name="firstSearch" id="firstSearch">
          </td>
        </tr>
        <tr>
          <td>
            <label>Last Name:</label>
          </td>
          <td>
            <input type="text" name="lastSearch" id="lastSearch">
          </td>
        </tr>
      </table>
      <input type="submit" value="Search">
    </form>
  </fieldset>
</div>
</body>