<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
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
<body>
    <header>
      <nav class="h-24 px-60 flex justify-between items-center">
        <div class="flex items-center">
          <img class="h-16 w-16" src="../ICON/logo.png" alt="">
          <h1 class="text-3xl font-bold ml-3">TarcDining</h1>
        </div>  
        <div class="flex items-center">
          <div class="flex items-center hover:text-redSecondary">
            <i class="fa-solid fa-house fa-rotate-by mr-2"></i>
            <a href="studentHome.php" class="text-xl font-semibold uppercase">Home</a>
          </div>
          <div class="flex items-center ml-5 hover:text-redSecondary">
            <i class="fa-solid fa-list mr-2"></i>
            <a href="menu.php" class="text-xl font-semibold uppercase">Items</a>
          </div>
          <?php
           if(isset($_COOKIE['role'])) {
            $role = $_COOKIE['role'];
            if($role == 'student') {
                echo 
                "<div class='flex items-center ml-5 hover:text-redSecondary'>
                  <i class='fa-solid fa-shopping-cart mr-2'></i>
                  <a href='Cart.php' class='text-xl font-semibold uppercase'>Cart</a>
                </div>";
           
            } else {
              header("Location: login.php");
            }
        }
           ?>
        </div>
        <div>
          <?php
            if(isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
                echo 
                "<div class='flex items-center'>
                  <i class='fa-solid fa-user mr-2 text-2xl'></i>
                  <h1 class='text-xl font-semibold uppercase'>$username</h1>
                 </div>";
            } else {
                echo "No username cookie set";
            }
            ?>
        </div>
      </nav>
    </header>
    <main>
        <section class="px-[15rem]">
            <h1 class="text-center text-7xl font-extrabold my-10">
                Explore all the products
            </h1>
            <div class="grid grid-cols-3 gap-6">         
              <?php
                require_once('DBconnect.php');
                $useremail = $_COOKIE['email'];
                $query = "SELECT * FROM curMenu where status='published'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $productName = $row['name'];
                    $productPrice = $row['token'];
                    $productImage = $row['img'];
                    $productcategory = $row['type'];
                    $productid = $row['f_id'];
                    // k
                ?>
                <div class='w-full h-60 rounded-lg relative' style='background-image: linear-gradient(to top,rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2)),url(<?php echo $productImage?>); background-size: cover; background-repeat: no-repeat;'>
                  <div class='absolute top-4 right-6'>
                    
                  </div>
                  <div class='flex flex-col justify-start absolute bottom-4 left-6'>
                    <h1 class='text-3xl font-bold text-white'><?php echo $productName?></h1>
                    <div class='flex flex-row items-center'>
                      <p class='text-white mr-4 flex items-center gap-2'><img class='w-4 h-4' src='../ICON/categories.png'><?php echo $productcategory ?></p>
                      <p class='text-white flex items-center gap-2'><i class='fa-solid fa-dollar-sign'></i><?php echo $productPrice ?></p>
                    </div>
                  </div>
                </div> 
                <?php    
                  }
                } else {
                  echo "Oops.....No products found.";
                }
                ?>
                <div class="hidden">
                  <form action="handleCart.php" method="post" id="addForm">
                    <input type="text" name="productname">
                    <input type="number" name="productprice">
                    <input type="text" name="useremail">
                    <input type="text" name="productid">
                  </form>
                </div>
                <script>
                  function handleForm(productName, productPrice, useremail, productid, ) {
                    document.getElementById('addForm').elements['productname'].value = productName;
                    document.getElementById('addForm').elements['productprice'].value = productPrice;
                    document.getElementById('addForm').elements['useremail'].value = useremail;
                    document.getElementById('addForm').elements['productid'].value = productid;
                    document.getElementById('addForm').submit();
                  }
                </script>
            </div>
        </section>
    </main>
</body>
</html>