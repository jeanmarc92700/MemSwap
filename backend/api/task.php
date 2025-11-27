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
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$data = readData($dataFile);
$tasks = $data['tasks'] ?? [];

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

switch ($method) {
    case 'GET':
        echo json_encode($tasks);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['title'])) {
            $newTask = [
                'id' => uniqid(),
                'title' => $input['title'],
                'done' => false
            ];
            $tasks[] = $newTask;
            $data['tasks'] = $tasks;
            writeData($dataFile, $data);
            http_response_code(201);
            echo json_encode(['message' => 'Task added', 'task' => $newTask]);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Missing title']);
        }
        break;

    case 'PUT':
        $id = $_GET['id'] ?? null;
        $input = json_decode(file_get_contents('php://input'), true);

        if ($id && isset($input['done'])) {
            foreach ($tasks as $key => $task) {
                if ($task['id'] === $id) {
                    $tasks[$key]['done'] = (bool)$input['done'];
                    $data['tasks'] = $tasks;
                    writeData($dataFile, $data);
                    echo json_encode(['message' => 'Task updated', 'task' => $tasks[$key]]);
                    exit;
                }
            }
        }
        http_response_code(404);
        echo json_encode(['message' => 'Task not found or invalid data']);
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $initialCount = count($tasks);
            $tasks = array_filter($tasks, fn($task) => $task['id'] !== $id);
            if (count($tasks) < $initialCount) {
                $data['tasks'] = array_values($tasks); 
                writeData($dataFile, $data);
                echo json_encode(['message' => 'Task deleted']);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Task not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Missing ID']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not supported']);
        break;
}
?>