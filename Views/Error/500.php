<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Internal Server Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ff0000;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        pre {
            font-family: 'Courier New', monospace;
            font-size: 16px;
            white-space: pre-wrap;
            background-color: #f8f8f8;
            padding: 10px;
            border: 1px solid #ddd;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error 500 - Internal Server Error</h1>
        <p>Sorry, something went wrong on our end. We are working to fix the issue.</p>
        <p>Please try again later.</p>
        
        <h2>Error Details:</h2>
        <pre><?php echo $exception->getMessage(); ?></pre>
        
        <h2>Stack Trace:</h2>
        <pre><?php echo nl2br(htmlspecialchars($exception->getTraceAsString())); ?></pre>
    </div>
</body>
</html>
