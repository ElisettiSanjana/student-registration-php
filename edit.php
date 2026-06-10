<?php
// edit.php
require_once "config/db.php";
require_once "models/Student.php";

$database = new Database();
$db       = $database->connect();
$student  = new Student($db);

$success = "";

// Fetch existing data
if (isset($_GET["id"])) {
    $student->id = $_GET["id"];
    $student->readOne();
}

// Handle update submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student->id      = $_POST["id"];
    $student->name    = $_POST["name"];
    $student->email   = $_POST["email"];
    $student->phone   = $_POST["phone"];
    $student->course  = $_POST["course"];
    $student->message = $_POST["message"];

    if ($student->update()) {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-warning mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold text-dark">✏️ Edit Student Record</span>
        <a href="index.php" class="btn btn-dark btn-sm">← Back</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h5 class="mb-3 text-warning">Update Details</h5>
                <form method="POST" action="edit.php">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($student->id) ?>">

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control"
                            value="<?= htmlspecialchars($student->name) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?= htmlspecialchars($student->email) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="<?= htmlspecialchars($student->phone) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select name="course" class="form-select" required>
                            <?php
                            $courses = ["B.Tech CSE", "B.Tech IT", "BCA", "MCA", "B.Sc CS"];
                            foreach ($courses as $c):
                            ?>
                            <option <?= $student->course === $c ? "selected" : "" ?>>
                                <?= $c ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="3"><?= htmlspecialchars($student->message) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold">Update Record</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
