<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 100px;
    }
    .tile {
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    .tile:hover {
      transform: translateY(-5px);
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }
    .tile a {
      text-decoration: none;
      color: #212529;
    }
  </style>
</head>
<body>

<div class="container text-center">
  <div class="row">
  
      
    <div class="col-md-6 mb-6 ">
        <a href="add_bri.php" class="link-underline link-underline-opacity-0">
            <div class="tile alert-primary alert">        
            <h3>Brief Pain Inventory</h3>
            <p>Record Brief Pain Inventory by Answering Questions</p>    
            </div>
        </a>
    </div>


    <div class="col-md-6 mb-6 ">
        <a href="admin/index.php" class="link-underline link-underline-opacity-0">
            <div class="tile alert-success alert">        
                <h3>Admin Area</h3>
                <p>Access administrative functions</p>        
            </div>
        </a>
    </div>

  </div>
</div>


</body>
</html>
