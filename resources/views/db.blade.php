<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php
        try {
            $pdo = DB::connection()->getPdo();
            if($pdo) {
                echo "Success: Connected to the database!";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        ?>
    </div>
</body>
</html>
