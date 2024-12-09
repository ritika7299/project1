<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>

<body>
    <h1>Upload a PDF or Image</h1>

    <!-- Display success or error messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?php echo session()->getFlashdata('success'); ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <ul style="color: red;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Upload form -->
    <form action="<?php echo base_url('FileUpload/upload'); ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?> <!-- CSRF token to protect against CSRF attacks -->

        <!-- File input -->
        <label for="file">Select PDF or Image (JPG, PNG, PDF):</label>
        <input type="file" name="file" id="file" accept="image/*,application/pdf" required>
        <br><br>

        <!-- Submit button -->
        <button type="submit">Upload</button>
    </form>

    <hr>

    <!-- Instructions -->
    <h3>Instructions:</h3>
    <p>Please select a PDF or image (JPG/PNG) file from your computer and click "Upload" to upload it.</p>
</body>

</html>