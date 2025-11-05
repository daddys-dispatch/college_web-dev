<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record Sorter</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .box {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>Student Records</h1>
        <?php
        $host = 'localhost';
        $db = 'student_records';
        $user = 'your_username';
        $pass = 'your_password';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $students = $pdo->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);

            // Selection Sort (Descending by GPA)
            for ($i = 0, $n = count($students); $i < $n - 1; $i++) {
                $max = $i;
                for ($j = $i + 1; $j < $n; $j++)
                    if ($students[$j]['gpa'] > $students[$max]['gpa'])
                        $max = $j;
                if ($max != $i)
                    [$students[$i], $students[$max]] = [$students[$max], $students[$i]];
            }

            echo "<table><tr><th>ID</th><th>Name</th><th>GPA</th></tr>";
            foreach ($students as $s)
                echo "<tr><td>" . htmlspecialchars($s['id']) . "</td><td>" . htmlspecialchars($s['name']) . "</td><td>" . htmlspecialchars($s['gpa']) . "</td></tr>";
            echo "</table>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </div>
</body>

</html>