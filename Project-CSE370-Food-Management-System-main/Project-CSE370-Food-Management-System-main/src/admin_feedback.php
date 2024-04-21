<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                <a href='addProducts.php' class="text-lg font-semibold uppercase">Add </a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admin_create_account.php' class="text-lg font-semibold uppercase">Create Account</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admins.php' class="text-lg font-semibold uppercase">Users</a>
              </div>

            </div>
          </div>
          <?php
            require_once('DBconnect.php');

            // Fetch student feedback and ratings
            $query = "SELECT * FROM feedback";
            $result = mysqli_query($conn, $query);

            // Display student feedback and ratings in a table
            echo "<div class='col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12'>";
            echo "<h2 class='text-2xl font-semibold mb-4'>Student Feedback and Ratings:</h2>";
            echo "<table class='w-full'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='py-2 px-4 bg-gray-200 border-b-2 border-gray-300'>Email</th>";
            echo "<th class='py-2 px-4 bg-gray-200 border-b-2 border-gray-300'>Feedback</th>";
            echo "<th class='py-2 px-4 bg-gray-200 border-b-2 border-gray-300'>Meal Rating</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td class='py-2 px-4 border-b border-gray-300'>" . $row['email'] . "</td>";
              echo "<td class='py-2 px-4 border-b border-gray-300'>" . $row['text'] . "</td>";
              echo "<td class='py-2 px-4 border-b border-gray-300'>" . $row['mealRating'] . "</td>";
              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            // Close database connection
            mysqli_close($conn);
          ?>
        </div>
      </section>
    </main>
</body>
</html>
