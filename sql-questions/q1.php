<?php
$host = 'localhost';
$user = 'root'; // Change if needed
$password = 'root'; // Default MAMP password
$database = 'pankaj'; // Change to your database name
$port = 8889;
$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Query UI</title>
    <link rel="stylesheet" href="/questions/index.css">

    <style>
       .container {
            display: flex;
            width: 100%;
        }
        .left-panel {
            width: 60%;
            padding: 20px;
            background: #f4f4f4;
        }
        .right-panel {
            width: 40%;
            padding: 20px;
            background: #fff;
            overflow: scroll;
            height: 22rem;
        }
        textarea {
            width: 100%;
            height: 200px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .sql-qst {
             line-height: 1;
        }
    </style>

</head>
<body>
<div class="dashboard">
    <aside class="search-wrap">
      <div class="search">
        <label for="search">

          <h3>question 1</h3>
        </label>
      </div>

      <div class="user-actions">
        <button>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path
              d="M13.094 2.085l-1.013-.082a1.082 1.082 0 0 0-.161 0l-1.063.087C6.948 2.652 4 6.053 4 10v3.838l-.948 2.846A1 1 0 0 0 4 18h4.5c0 1.93 1.57 3.5 3.5 3.5s3.5-1.57 3.5-3.5H20a1 1 0 0 0 .889-1.495L20 13.838V10c0-3.94-2.942-7.34-6.906-7.915zM12 19.5c-.841 0-1.5-.659-1.5-1.5h3c0 .841-.659 1.5-1.5 1.5zM5.388 16l.561-1.684A1.03 1.03 0 0 0 6 14v-4c0-2.959 2.211-5.509 5.08-5.923l.921-.074.868.068C15.794 4.497 18 7.046 18 10v4c0 .107.018.214.052.316l.56 1.684H5.388z" />
          </svg>
        </button>
        <button>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path
              d="M12 21c4.411 0 8-3.589 8-8 0-3.35-2.072-6.221-5-7.411v2.223A6 6 0 0 1 18 13c0 3.309-2.691 6-6 6s-6-2.691-6-6a5.999 5.999 0 0 1 3-5.188V5.589C6.072 6.779 4 9.65 4 13c0 4.411 3.589 8 8 8z" />
            <path d="M11 2h2v10h-2z" />
          </svg>
        </button>
      </div>
    </aside>
    <div include-html="/questions/partial-dashboard-component.html" id="partial-dashboard_file">
    </div>
    <div class="task" style= "margin:5px; padding:2px;">
      <h2 class="sql-qst">question -=Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</h2>
    <div class="container">
        <div class="left-panel">
            <h2>Enter SQL Query</h2>
            <form method="POST">
                <textarea name="query" id="queryBox" placeholder="Enter your SQL query here..."></textarea>
                <button type="submit">Run Query</button>
            </form>
        </div>
        <div class="right-panel">
            <h2>Query Results</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['query'])) {
                $query = $_POST['query'];
                echo "<p><strong>Query:</strong> $query</p>";
                $result = $conn->query($query);
                if ($result) {
                    if ($result->num_rows > 0) {
                        echo "<table><tr>";
                        while ($field = $result->fetch_field()) {
                            echo "<th>{$field->name}</th>";
                        }
                        echo "</tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            foreach ($row as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No results found.</p>";
                    }
                } else {
                    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
                }
            }
            ?>
        </div>
    </div>

    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="/questions/include-html.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="/questions/include-html.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // alert('fdfd');
    let queryBox = document.getElementById("queryBox");
    let pageKey = "savedQuery_" + window.location.pathname; // Unique key for each page

    // Load saved query for this specific page
    if (localStorage.getItem(pageKey)) {
        queryBox.value = localStorage.getItem(pageKey);
    }

    // Save query when the user types
    queryBox.addEventListener("input", function () {
        localStorage.setItem(pageKey, queryBox.value);
    });
});
</script>
