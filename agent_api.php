<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');

// Get query parameters
$agent_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$role = isset($_GET['role']) ? trim($_GET['role']) : '';
$action = isset($_GET['action']) ? trim($_GET['action']) : 'list';

$agentsArr = [];

try {
    if ($action === 'get' && $agent_id > 0) {
        // Get specific agent by ID
        $stmt = $conn->prepare("SELECT id, name, email, role FROM user_table WHERE id = ?");
        $stmt->bind_param('i', $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $agent = $result->fetch_assoc();
            echo json_encode($agent, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['error' => 'Agent not found']);
        }
        $stmt->close();
        
    } else {
        // List agents with optional role filter
        $sql = "SELECT id, name, email, role FROM user_table";
        $params = [];
        $types = "";
        
        if ($role !== '') {
            $sql .= " WHERE role = ?";
            $params[] = $role;
            $types .= "s";
        }
        
        $sql .= " ORDER BY id ASC";
        
        if (!empty($params)) {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
        } else {
            $stmt = $conn->prepare($sql);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $agentsArr[] = $row;
        }
        $stmt->close();
        
        echo json_encode($agentsArr, JSON_UNESCAPED_UNICODE);
    }
    
} catch (Exception $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>