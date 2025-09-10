<?php
header('Content-Type: application/json');
require '../db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    echo json_encode($pdo->query("SELECT * FROM tasks ORDER BY id DESC")->fetchAll());
    break;

  case 'POST':
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (?)");
    $stmt->execute([$data['title']]);
    echo json_encode(['status' => 'created']);
    break;

  case 'DELETE':
    $id = $_GET['id'];
    $pdo->prepare("DELETE FROM tasks WHERE id = ?")->execute([$id]);
    echo json_encode(['status' => 'deleted']);
    break;

  case 'PUT':
    $id = $_GET['id'];
    $data = json_decode(file_get_contents("php://input"), true);
    $pdo->prepare("UPDATE tasks SET done = ? WHERE id = ?")->execute([$data['done'], $id]);
    echo json_encode(['status' => 'updated']);
    break;
}
