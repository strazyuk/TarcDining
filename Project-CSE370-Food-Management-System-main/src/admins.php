<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
    <!-- design plugs -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              yellowPrimary: 'rgb(253 224 71)',
              redSecondary: 'rgb(220 38 38)',
              greenSecondary: 'rgb(34 197 94)',
            }
          }
        }
      }

      function deleteUser(email) {
        // Confirm before deleting
        if (confirm("Are you sure you want to delete this user?")) {
          // AJAX request to delete user
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "delete_user.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              // Reload the page after deletion
              window.location.reload();
            }
          };
          xhr.send("email=" + email);
        }
      }
    </script>
</head>
<body class="bg-yellowPrimary">
    <header>
      <nav class="h-24 px-40 flex justify-between items-center">
        <div class="flex items-center">
          <img class="h-16 w-16" src="../ICON/logo.png" alt="">
          <h1 class="text-3xl font-bold ml-3">TarcDining</h1>
        </div>  
        <?php
            if(isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
            } else {
                echo "No username cookie set";
            }
        ?> 
        <div>
          <h1 class="text-2xl font-semibold uppercase">Welcome to admin dashboard, <?php echo $username ?></h1>
        </div>
      </nav>
    </header>
    <main>
      <section class="pl-40 pt-4 h-screen">
        <div class="grid grid-cols-6">
          <div class="mt-16">
            <div class="flex flex-col items-start">
              <div class="flex items-center hover:text-redSecondary mb-6">
                <i class="fa-solid fa-chart-column mr-2 text-lg"></i>
                <a href="adminHome.php" class="text-lg font-semibold uppercase">statistics</a>
              </div>
              <div class="flex items-center hover:text-redSecondary mb-6">
                <i class="fa-regular fa-clipboard mr-2 text-lg"></i>
                <a href="publishedItems.php" class="text-lg font-semibold uppercase">Published Items</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='addItems.php' class="text-lg font-semibold uppercase">Add </a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admin_create_account.php' class="text-lg font-semibold uppercase">Create Account</a>
              </div>
            </div>
          </div>
          <?php
            require_once('DBconnect.php');

            // Retrieve admins data from the database
            $queryAdmin = "SELECT email, username FROM user WHERE role = 'admin'";
            $resultAdmin = mysqli_query($conn, $queryAdmin);

            // Retrieve non-admin users data from the database
            $queryUser = "SELECT email, username FROM user WHERE role <> 'admin'";
            $resultUser = mysqli_query($conn, $queryUser);

            echo "<div class='col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12 overflow-auto'>";

            if (mysqli_num_rows($resultAdmin) > 0) {
              echo "<table>";
              echo "<tr><th>Admin Email</th><th>&nbsp;</th><th>Admin name</th></tr>";
              while ($row = mysqli_fetch_assoc($resultAdmin)) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>&nbsp;</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "</tr>";
              }
            }

            // Display non-admin users with delete button
            if (mysqli_num_rows($resultUser) > 0) {
              echo "<table>";
              echo "<tr><th>User Email</th><th>&nbsp;</th><th>Username</th><th>&nbsp;</th></tr>";
              while ($row = mysqli_fetch_assoc($resultUser)) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>&nbsp;</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td><button onclick='deleteUser(\"" . $row['email'] . "\")'>Delete</button></td>";
                echo "</tr>";
              }
            }

            echo "</table>";
            echo "</div>";
          ?>
        </div>
      </section>
    </main>
</body>
</html>
