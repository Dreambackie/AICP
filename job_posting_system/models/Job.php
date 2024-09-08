<?php
require_once '../config/db.php';

class Job {
    private $id;
    private $title;
    private $salary;
    private $description;
    private $experience;
    private $incentive;
    private $recruiter_id;

    public function __construct($id, $title, $salary, $description, $experience, $incentive, $recruiter_id) {
        $this->id = $id;
        $this->title = $title;
        $this->salary = $salary;
        $this->description = $description;
        $this->experience = $experience;
        $this->incentive = $incentive;
        $this->recruiter_id = $recruiter_id;
    }

    public static function getAllJobs() {
        global $conn;
        $sql = "SELECT * FROM jobs";
        $result = $conn->query($sql);
        $jobs = [];
        while ($row = $result->fetch_assoc()) {
            $jobs[] = new Job($row['id'], $row['title'], $row['salary'], $row['description'], $row['experience'], $row['incentive'], $row['recruiter_id']);
        }
        return $jobs;
    }

    public static function getJobById($id) {
        global $conn;
        $sql = "SELECT * FROM jobs WHERE id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Job($row['id'], $row['title'], $row['salary'], $row['description'], $row['experience'], $row['incentive'], $row['recruiter_id']);
        } else {
            return null;
        }
    }

    public static function getJobsByRecruiter($recruiter_id) {
        global $conn;
        $sql = "SELECT * FROM jobs WHERE recruiter_id='$recruiter_id'";
        $result = $conn->query($sql);
        $jobs = [];
        while ($row = $result->fetch_assoc()) {
            $jobs[] = new Job($row['id'], $row['title'], $row['salary'], $row['description'], $row['experience'], $row['incentive'], $row['recruiter_id']);
        }
        return $jobs;
    }

    public static function addJob($title, $salary, $description, $experience, $incentive, $recruiter_id) {
        global $conn;
        $sql = "INSERT INTO jobs (title, salary, description, experience, incentive, recruiter_id) 
                VALUES ('$title', '$salary', '$description', '$experience', '$incentive', '$recruiter_id')";
        return $conn->query($sql);
    }
}
?>
