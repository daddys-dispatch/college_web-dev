<html>
	<head>
		<title>Student Record Sorter</title>
		<style>
			body {
				font-family: sans-serif;
				padding: 50px;
			}
			h1 {
				text-align: center;
			}
			table {
				width: 50%;
				border-collapse: collapse;
				margin: 0 auto;
			}
			th,
			td {
				padding: 10px;
				border: 1px solid black;
				text-align: left;
			}
			th {
				background: lightgray;
			}
		</style>
	</head>
	<body>
		<h1>Student Records</h1>
		<?php
			$dsn = 'mysql:host=localhost;dbname=student_records;charset=utf8';
			$user = 'your_username';
			$pass = 'your_password';

			try {
				$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE =>
				PDO::ERRMODE_EXCEPTION]); $students = $pdo->query('SELECT * FROM
				students')->fetchAll(PDO::FETCH_ASSOC); function
				selectionSort(&$arr) { for ($i = 0, $n = count($arr); $i < $n - 1;
				$i++) { $min = $i; for ($j = $i + 1; $j < $n; $j++) if
				($arr[$j]['gpa'] < $arr[$min]['gpa']) $min = $j; if ($min != $i)
				[$arr[$i], $arr[$min]] = [$arr[$min], $arr[$i]]; } }
				selectionSort($students); ?>
				<table>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>GPA</th>
					</tr>
					<?php foreach ($students as $s): ?>
					<tr>
						<td><?= htmlspecialchars($s['id']) ?></td>
						<td><?= htmlspecialchars($s['name']) ?></td>
						<td><?= htmlspecialchars($s['gpa']) ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			<?php 
			} catch (PDOException $e) { 
				echo 'Connection failed: ' . $e->getMessage()
			} ?>
	</body>
</html>