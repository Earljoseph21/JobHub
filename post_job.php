<?php
require_once 'models/job.php';

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new job
    $job = new Job();
    $result = $job->create($_POST['title'], $_POST['desc'], $_POST['company'], $_POST['location'], 1); // Assuming posted_by is 1 for demo

    if ($result) {
        $msg = "Job posted successfully!";
    } else {
        $msg = "Failed to post the job. Please try again.";
    }
}

require_once 'views/header.php';
?>

<div class="container">
    <h2>Post a Job</h2>
    <form method="post" class="job-form">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="desc">Description:</label>
            <textarea name="desc" id="desc" required></textarea>
        </div>
        <div class="form-group">
            <label for="company">Company:</label>
            <input type="text" name="company" id="company" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>
        </div>
        <button type="submit" class="btn">Post Job</button>
    </form>
    <p class="message"><?= htmlspecialchars($msg) ?></p>
</div>

<?php require_once 'views/footer.php'; ?>
