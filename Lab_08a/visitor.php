<html>
<head>
    <title>Visitor Counter</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin-top: 25vh;
        }

        div {
            font-size: 5em;
            margin-top: 25px;
        }
    </style>
    </head>
    <body>
        <h1>Visitor Counter</h1>
        <div>
            <?php
            $file = 'visitor_count.txt';
            $count = file_exists($file) ? (int)file_get_contents($file) : 0;
            file_put_contents($file, ++$count);
            echo "$count";
            ?>
        </div>
    </body>
</html>