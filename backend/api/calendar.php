<?php
$dataFile = '../../database/data.json';

function readData($file) {
    if (!file_exists($file)) {
        $initialData = ['tasks' => [], 'calendar' => []];
        file_put_contents($file, json_encode($initialData, JSON_PRETTY_PRINT));
        return $initialData;
    }
    return json_decode(file_get_contents($file), true);
}

function writeData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$data = readData($dataFile);

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

switch ($method) {
    case 'GET':
        echo json_encode($data['calendar'] ?? []);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['title'], $input['start'])) {
            $newEvent = [
                'id' => uniqid(),
                'title' => $input['title'],
                'start' => $input['start']
            ];
            $data['calendar'][] = $newEvent;
            writeData($dataFile, $data);
            http_response_code(201); 
            echo json_encode(['message' => 'Event added', 'event' => $newEvent]);
        } else {
            http_response_code(400); 
            echo json_encode(['message' => 'Missing title or start date']);
        }
        break;

    default:
        http_response_code(405); 
        echo json_encode(['message' => 'Method not supported']);
        break;
}
?>