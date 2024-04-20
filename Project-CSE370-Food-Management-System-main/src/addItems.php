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
                <a href='addItems.php' class="text-lg font-semibold uppercase">Add </a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admin_create_account.php' class="text-lg font-semibold uppercase">Create Account</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admins.php' class="text-lg font-semibold uppercase">ALl User</a>
              </div>
            </div>
          </div>
          <?php
            require_once('DBconnect.php');
            $query = "SELECT COUNT(*) AS student_count FROM user WHERE role = 'student'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $student_count = $row['student_count'];
            // $query = "SELECT COUNT(*) AS seller_count FROM users WHERE role = 'seller'";
            // $result = mysqli_query($conn, $query);
            // $row = mysqli_fetch_assoc($result);
            // $seller_count = $row['seller_count'];
            // // change the code below after updating the disjoint table;
            $query = "SELECT SUM(revenue) AS total_salary FROM admin";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $total_salary = $row['total_salary'];
          ?>
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12">
            <div>
            <section class="px-[15rem]">
            <h1 class="text-center text-5xl font-extrabold my-10">
              <!--change the text -->
                Fill up the form before you add an Item
            </h1>
            <div class="my-24">
              <form action="handleAddItems.php" method="POST">
                <?php 
                  if(isset($_COOKIE['email'])) {
                      $email = $_COOKIE['email'];
                  } else {
                      echo header("Location: login.php");
                  }
                ?>
                <div class="grid grid-cols-2">
                  <div class="flex items-center mr-6">
                      <h1 class="text-2xl font-semibold mr-4 w-72">Your email:</h1>
                      <input type="text" name="sellerEmail" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" value="<?php echo $email; ?>" readonly>
                  </div>
                  <div>
                    <select class="select w-full my-4 border-2 border-gray-300 px-4 font-semibold text-xl py-2" name="productCategory" required>
                                                    <!--changed-->
                      <option disabled selected>Select Meal Category</option>
                      <option> main course</option>
                      <option>side dish</option>
                      <option>Dairy Delights</option>
                      <option>Beverages & Snacks</option>
                    </select>
                  </div>
                </div>
                <div class="grid grid-cols-2">
                  <div class="flex flex-row items-center mr-6 flex-1">
                                                                  <!--changed-->
                      <h1 class="text-2xl font-semibold mr-4 w-72">Item Name:</h1>
                      <input type="text" name="productName" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                  </div>
                  <div class="flex flex-row items-center flex-1">
                                                                 <!--changed-->
                      <h1 class="text-2xl font-semibold mr-4 w-72">Item Price:</h1>
                      <input type="number" step="0.01" name="productPrice" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                  </div>
                </div>
                </div>
                <div class="flex flex-row items-center">
                    <h1 class="text-2xl font-semibold w-80">Product Image URl:</h1>
                    <input type="text" name="productImage" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                </div>
                <input type="submit" value="submit" class="bg-yellow-300 py-3 w-full rounded-lg my-4">
              </form>
            </div>
        </section>
            </div>
          </div>
        </div>
      </section>
    </main>
</body>
</html>