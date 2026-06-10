<?php
// models/Student.php
// OOP Model class for Student CRUD operations

class Student {
    private $conn;
    private $table = "students";

    public $id;
    public $name;
    public $email;
    public $phone;
    public $course;
    public $message;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE - Insert new student
    public function create() {
        $query = "INSERT INTO " . $this->table . "
                  (name, email, phone, course, message)
                  VALUES (:name, :email, :phone, :course, :message)";

        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->name    = htmlspecialchars(strip_tags($this->name));
        $this->email   = htmlspecialchars(strip_tags($this->email));
        $this->phone   = htmlspecialchars(strip_tags($this->phone));
        $this->course  = htmlspecialchars(strip_tags($this->course));
        $this->message = htmlspecialchars(strip_tags($this->message));

        $stmt->bindParam(":name",    $this->name);
        $stmt->bindParam(":email",   $this->email);
        $stmt->bindParam(":phone",   $this->phone);
        $stmt->bindParam(":course",  $this->course);
        $stmt->bindParam(":message", $this->message);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // READ - Get all students
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ - Get single student by ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->name    = $row["name"];
            $this->email   = $row["email"];
            $this->phone   = $row["phone"];
            $this->course  = $row["course"];
            $this->message = $row["message"];
        }
    }

    // UPDATE - Update student record
    public function update() {
        $query = "UPDATE " . $this->table . "
                  SET name=:name, email=:email, phone=:phone,
                      course=:course, message=:message
                  WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->name    = htmlspecialchars(strip_tags($this->name));
        $this->email   = htmlspecialchars(strip_tags($this->email));
        $this->phone   = htmlspecialchars(strip_tags($this->phone));
        $this->course  = htmlspecialchars(strip_tags($this->course));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->id      = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name",    $this->name);
        $stmt->bindParam(":email",   $this->email);
        $stmt->bindParam(":phone",   $this->phone);
        $stmt->bindParam(":course",  $this->course);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":id",      $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE - Delete student record
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt  = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
