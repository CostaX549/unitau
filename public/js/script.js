
    var image = document.getElementById('image');

    var cropper = new Cropper(image, {
      aspectRatio: 16 / 9, // You can customize the aspect ratio
      viewMode: 1, // Set to 1 to restrict the crop box to fit within the canvas
      guides: true, // Show grid guides
      autoCropArea: 0.8, // Automatically crop 80% of the image
      responsive: true, // Enable responsive mode
    });


  