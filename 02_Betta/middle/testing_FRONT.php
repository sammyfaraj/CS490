<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
</head>
<body>

  <form action="index.php" method="post">

    <label for="username">Username:</label>
    <input type="text" placeholder="Enter username" name="username">

    <label for="password">Password:</label>
    <input type="password" placeholder="Enter password" name="password">

    <input type="radio" name="request_id" value="LOGIN"> Login<br>
    <input type="radio" name="request_id" value="T_CREATE_QUESTION"> Teacher - Create/Add Questions<br>
    <input type="radio" name="request_id" value="T_ADD_QUESTION"> Teacher - Add

    <button type="submit">Submit</button>
  </form>

</body>
</html>

