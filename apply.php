<?php
require_once 'models/application.php';

$msg = "";
$job_id = $_GET['job_id'] ?? 0;

if ($_POST) {
    applyJob($_POST['job_id'], 1, $_POST['resume'], $_POST['cover']); // applicant_id = 1 (dummy)
    $msg = "Application submitted!";
}

require_once 'header.php';
?>

<h2>Apply to Job #<?= $job_id ?></h2>
<form method="post">
    <input type="hidden" name="job_id" value="<?= $job_id ?>">
    Resume Link: <input name="resume"><br>
    Cover Letter: <textarea name="cover"></textarea><br>
    <button type="submit">Apply</button>
</form>
<p><?= $msg ?></p>

<?php require_once 'footer.php'; ?>
