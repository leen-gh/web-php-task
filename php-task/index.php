
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="JS/fetchData.js"></script>
  <script src="JS/openModel.js"></script>

</head>
<body>
    <h1>TASK</h1>
      <div class="search-bar">
        <input type="text" id="search-input" pattern=".*\S.*" required>
        <button id="search-btn" class="search-btn"></button>
       
      </div>   
      <div class="div-a">
        <button id="openModel-btn" class="btn-22">Open Model</button>
      </div>

    <div id="data-container" class="tbl-header"></div>

    <div id="myModel" class="model">
      <div class="model-content">
        <button id="selectImage-btn" class="btn-22" >Select Image</button>
        <div id="selectedImageContainer"></div>
        <button id="exit-btn" class="btn-22">Exit</button>
      </div>
    </div>


    <script>
        fetchData();
        //intervalId = setInterval(fetchData, 2000);
        //auto-refrech every 60 min
        intervalId = setInterval(fetchData, 3600000);

        $('#search-btn').click(function() {
            var searchQuery = $('#search-input').val();
            fetchData(searchQuery);
            clearInterval(intervalId); 
        });
        $('#openModel-btn').click(function() {
          openModel();
        });

       

    </script>

    

</body>
</html>


