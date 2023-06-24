function openModel() {
    document.getElementById("openModel-btn").addEventListener("click", function() {
        document.getElementById("myModel").style.display = "block";
    });
  
    document.getElementById("selectImage-btn").addEventListener("click", function() {
    var input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";
  
    input.onchange = function(event) {
      var selectedImage = document.createElement("img");
      selectedImage.src = URL.createObjectURL(event.target.files[0]);
      document.getElementById("selectedImageContainer").innerHTML = "";
      document.getElementById("selectedImageContainer").appendChild(selectedImage);
    };
  
    input.click();
    });
    document.getElementById("exit-btn").addEventListener("click", function() {
    document.getElementById("myModel").style.display = "none";
    });

}



