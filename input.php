<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Проверка забытых лидов</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }

        button {
            background-color: #2fc6f6;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1ba7d6;
        }

        #result {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<h2>Проверка забытых лидов</h2>

<button onclick="runScript()">Запустить проверку</button>

<div id="result"></div>

<script>
function runScript() {
    const resultBlock = document.getElementById('result');

    resultBlock.innerHTML = "⏳ Выполняется...";

    fetch('handler.php')
        .then(response => response.text())
        .then(data => {
            resultBlock.innerHTML = "✅ " + data;
        })
        .catch(error => {
            resultBlock.innerHTML = "❌ Ошибка: " + error;
        });
}
</script>

</body>
</html>
