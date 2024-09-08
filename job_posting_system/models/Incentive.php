<?php
require_once '../config/db.php';

class Incentive {
    private $job_id;
    private $total_incentive;
    private $recruiter_posted;
    private $recruiter_candidate;
    private $admin_share;

    public function __construct($job_id, $total_incentive, $recruiter_posted, $recruiter_candidate, $admin_share) {
        $this->job_id = $job_id;
        $this->total_incentive = $total_incentive;
        $this->recruiter_posted = $recruiter_posted;
        $this->recruiter_candidate = $recruiter_candidate;
        $this->admin_share = $admin_share;
    }

    public static function getIncentiveByJobId($job_id) {
        global $conn;
        $sql = "SELECT * FROM incentives WHERE job_id='$job_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Incentive($row['job_id'], $row['total_incentive'], $row['recruiter_posted'], $row['recruiter_candidate'], $row['admin_share']);
        } else {
            return null;
        }
    }

    public static function addIncentive($job_id, $total_incentive, $recruiter_posted, $recruiter_candidate, $admin_share) {
        global $conn;
        $sql = "INSERT INTO incentives (job_id, total_incentive, recruiter_posted, recruiter_candidate, admin_share) 
                VALUES ('$job_id', '$total_incentive', '$recruiter_posted', '$recruiter_candidate', '$admin_share')";
        return $conn->query($sql);
    }
}
?>
