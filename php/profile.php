<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<form class="upload-form">
    <div class="bg">
        <label class="custom-file-upload">
            <div class="circle">
                <input type="file" id="backgroundImageInput" accept="image/*" onchange="setBackgroundImage(event)" />
            </div>
            <p>profile</p>
        </label>
        <div>
            <p>Bio:</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis nam culpa et id ipsam, dolorum veniam error maiores sint ut repudiandae eveniet soluta doloremque porro nisi. Earum hic at eos!</p>
        </div>
    </div>
</form>

<script>
    function setBackgroundImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const circle = document.querySelector('.circle'); // Target the circle div
            circle.style.backgroundImage = `url(${e.target.result})`; // Set the background of the circle
            circle.style.backgroundSize = 'cover'; // Ensure the image covers the circle
            circle.style.backgroundPosition = 'center'; // Center the image inside the circle
        };
        reader.readAsDataURL(file);
    } else {
        console.error('No file selected.');
    }
}

</script>

    
</body>
</html>