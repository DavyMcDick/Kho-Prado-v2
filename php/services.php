<?php
include '../config/connect.php';
include '../html/service.php';
date_default_timezone_set('Asia/Manila');

$currentUserId = $_SESSION['user_id'];
$today = date('Y-m-d');
$now = new DateTime();

// Fetch all confirmed appointments (including status)
$stmt = $conn->prepare("SELECT * FROM confirm WHERE Type = 'SJN' AND Status IN ('Confirmed', 'In Progress', 'Complete', 'Cancelled')");
$stmt->execute();
$result = $stmt->get_result();

// Procedure times (original durations without buffer)
$procedureTimes = [
    'Braces' => 30,
    'Xray' => 10, 
    'Consultation' => 15,
    'Teeth Extraction' => 30,
    'Root Canal Treatment' => 60,
    'Teeth Whitening' => 20,
    'Filling' => 45
];
$perToothProcedures = ['Braces', 'Teeth Extraction', 'Root Canal Treatment', 'Teeth Whitening', 'Filling'];

// Gather patients and identify current user's appointment
$patients = [];
$userScheduled = false;
$appointmentDate = null;

while ($row = $result->fetch_assoc()) {
    if ($row['user_id'] == $currentUserId) {
        $userScheduled = true;
        $appointmentDate = $row['Dates'];
    }

    $procedures = preg_split('/,\s*/', $row['Procedures']);

    $numTeeth = (int)$row['Teeth'];
    $estimatedMinutes = 0;

    foreach ($procedures as $procRaw) {
        $proc = trim($procRaw);
        $teethForThisProc = 1; // Default to 1 if not specified
        
        // Extract teeth count from procedure (e.g., "Extraction (2 teeth)")
        if (preg_match('/\((\d+)\s*teeth?\)/i', $procRaw, $matches)) {
            $teethForThisProc = (int)$matches[1];
        }
        
        // Remove parentheses for matching
        $procFormatted = preg_replace('/\s*\(.*?\)/', '', $proc);
        $procFormatted = ucwords(strtolower($procFormatted));
        
        $baseTime = $procedureTimes[$procFormatted] ?? 0;
        
        if (in_array($procFormatted, $perToothProcedures)) {
            $estimatedMinutes += $baseTime * $teethForThisProc;
        } else {
            $estimatedMinutes += $baseTime;
        }
    }

    $row['estimated_time'] = $estimatedMinutes;
    $patients[] = $row;
}
$stmt->close();         

// If not scheduled, show message
if (!$userScheduled) {
    echo "<div class='alert alert-info' style='max-width: 600px; margin: 50px auto; text-align: center;'>
            <i class='fas fa-calendar-times fa-3x mb-3' style='color: #6c757d;'></i>
            <h3>You have no confirmed appointments</h3>
            <p class='text-muted'>Please schedule an appointment to view your booking details</p>
          </div>";
    exit;
}

// Calculate reveal time (2 days before at 11:59 PM)
$showScheduleTime = new DateTime($appointmentDate . ' 23:59:00');
$showScheduleTime->modify('-2 days');

if ($now < $showScheduleTime) {
    $targetDate = $showScheduleTime->format('F j, Y');
    $apptDate = date('F j, Y', strtotime($appointmentDate));
    ?>

    <?php
exit;
}