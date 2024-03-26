<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      rel="stylesheet"
      href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <link rel="shortcut icon" href="favicon.svg" type="image/x-icon" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Urbanist:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Silkscreen:wght@400;700&family=Urbanist:wght@300;400;600&display=swap"
      rel="stylesheet"
    />


    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="style.css" />
    <title>TooDoo</title>



  <?php 
    include_once "./connection.php";  
    include_once "./functions.php";  

    $data = gettodos($conn);

    $json_data = json_encode($data);
  ?>

  <script>
    let todos = <?php echo $json_data; ?>;

  </script>



  </head>
  <body>
    <div class="body-bg"></div>
    <div class="container">
      <header class="logo">
        <img class="logosvg" src="./favicon.svg" alt="logo" />
        <h1 class="heading">TOO DOO</h1>
      </div>


      <main>

        <div class="main">
          <div class="todo drag">
            <h2 class="card-heading">To Do</h2>
          </div>
          <div class="doing drag">
            <h2 class="card-heading">Process</h2>
          </div>
          <div class="completed drag">
            <h2 class="card-heading">Complited</h2>
          </div>
        </div>




        <div  class="todoadder">
          <input class="adder form-control h-100" type="text" placeholder="What do you need to do?">
          <div class="submitbtn h-100">
            <i class="fa-solid fa-plus plus"></i>
            <input type="button" value="ADD">
          </div>
        </div>
      </main>


    </div>





    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/bcbd140324.js" crossorigin="anonymous"></script> 

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="./script.js"></script>
  </body>
</html>
