<?php
// index.php
require_once "config/db.php";
require_once "models/Student.php";

$database = new Database();
$db       = $database->connect();
$student  = new Student($db);

$success = "";
$error   = "";

// Handle form submit (CREATE)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {

    if ($_POST["action"] === "create") {
        $student->name    = $_POST["name"];
        $student->email   = $_POST["email"];
        $student->phone   = $_POST["phone"];
        $student->course  = $_POST["course"];
        $student->message = $_POST["message"];

        if ($student->create()) {
            $success = "Student registered successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }

    if ($_POST["action"] === "delete") {
        $student->id = $_POST["id"];
        if ($student->delete()) {
            $success = "Record deleted successfully!";
        }
    }
}

// Read all students
$result = $student->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; }
        thead { background-color: #0d6efd; color: white; }
        .brand { color: #0d6efd; font-weight: 700; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary mb-4">
    <div class="container">
        <span class="navbar-brand brand">🎓 Student Registration System</span>
        <span class="text-white small">PHP + MySQL CRUD</span>
    </div>
</nav>

<div class="container">

    <!-- Alerts -->
    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show"><?= $success ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show"><?= $error ?></div>
    <?php endif; ?>

    <div class="row">

        <!-- Registration Form -->
        <div class="col-md-4 mb-4">
            <div class="card shadow p-4">
                <h5 class="mb-3 text-primary">Register Student</h5>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="create">

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select name="course" class="form-select" required>
                            <option value="">-- Select Course --</option>
                            <option>B.Tech CSE</option>
                            <option>B.Tech IT</option>
                            <option>BCA</option>
                            <option>MCA</option>
                            <option>B.Sc CS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message (Optional)</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Any message..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>

        <!-- Students Table -->
        <div class="col-md-8 mb-4">
            <div class="card shadow p-4">
                <h5 class="mb-3 text-primary">Registered Students</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)):
                            ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($row["name"]) ?></td>
                                <td><?= htmlspecialchars($row["email"]) ?></td>
                                <td><?= htmlspecialchars($row["phone"]) ?></td>
                                <td><?= htmlspecialchars($row["course"]) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <form method="POST" style="display:inline">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this record?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
