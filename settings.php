<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        body {
            display: flex;
            background-color: rgb(249, 244, 239);
        }
        .sidebar {
            width: 250px;
            background-color: rgb(255, 255, 255);
            box-shadow: 3px 3px 10px #f5dbcb;
            min-height: 95vh;
            padding: 10px;
            display: flex;
            flex-direction: column;
            border-radius: 20px;
            font-size: 20px;
        }
        .sidebar h1 {
            text-align: center;
            margin: 20px;
            font-size: 30px;
            font-weight: 900;
            background: linear-gradient(90deg, #fec961, #ff9800);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 50px;
        }
        .menu {
            list-style: none;
        }
        .menu li a {
            text-decoration: none;
            color: rgb(205, 94, 3);
            display: flex;
            width: 100%;
            padding: 20px;
        }
        .menu li:hover a, .menu li a.active  {
            background: #ffffff;
            border-radius:4px;
            border-left: 4px solid rgb(106, 70, 3);
            box-shadow: inset 4px 4px 6px rgba(0, 0, 0, 0.3), 
                        inset -8px -8px 10px rgba(255, 255, 255, 0.7);
            transform: scale(1.02); 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .menu li {
            padding: 10px;
            cursor: pointer;
            display: flex;
        }
        .menu li i {
            margin-right: 15px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .dashboard-header {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #f6c77f;
            color: #f99858;
        }
        .header-right {
            display: flex;
            align-items: center;
        }
        .lupon-btn {
            background-color: #ffffff;
            color: #db8505;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            border: 3px solid #db8505;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease-in-out;
        }
        .lupon-btn:hover {
            background-color: #db8505;
            color: #ffffff;
            transform: translateY(-3px);
        }
        .container {
                display: flex;
                justify-content: center;
                align-items: center; 
                height: 100vh;
            }

            .settings-container {
            margin-top: 20px;
        }
        .settings-section {
            margin-bottom: 30px;
        }
        .settings-section h2 {
            color: #db8505;
            margin-bottom: 10px;
        }
        .settings-option {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 20px;
            flex-wrap: wrap;
        }
        .settings-card {
            background: #fdf1e8;
            border: 2px solid #db8505;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            width: 300px;
            transition: all 0.3s ease;
        }
        .settings-card:hover {
            background: #ffe0b3;
            transform: translateY(-5px);
        }
        .settings-card i {
            font-size: 50px;
            color: #db8505;
        }
        .settings-card .text {
            color: #db8505;
            font-size: 30px;
            font-weight: bold;
        }
        .settings-card p {
            font-size: 14px;
            color: #db8505;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>LUPON</h1>
            <ul class="menu">
                <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="cases.php"><i class="fas fa-balance-scale"></i> Cases</a></li>
                <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>
                <li><a href="archive.php"><i class="fas fa-archive"></i> Archive</a></li>
                <li><a href="settings.php" class="active"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </div>
    </div>
    
    <div class="main-content">
        <div class="dashboard-header">
            <span>Settings</span>
            <div class="header-right">
                <button onclick="redirectToAuthorization(event)"class="lupon-btn">LOG OUT <i class="fas fa-sign-out-alt"></i></button>
            </div>

            
        </div>

        <div class="settings-container">
            <div class="settings-section">
                <h2>Data</h2>
                <div class="settings-option">
                <div class="settings-card" onclick="backupDatabase()">
                    <i class="fas fa-download"></i>
                    <div>
                        <div class="text">Backup Data</div>
                        <p>Click to download the backup</p>
                    </div>
                </div>


                        <form action="backup_restore.php" method="post" enctype="multipart/form-data">
                            <label class="settings-card">
                                <i class="fas fa-sync-alt"></i>
                                <div>
                                    <div class="text">Restore Data</div>
                                    <p>Upload and restore a backup</p>
                                </div>
                                <input type="file" name="backup_file" accept=".sql" style="display: none;" onchange="this.form.submit()">
                            </label>
                        </form>

                  </div>
             </div>
            <div class="settings-section">
                <h2>Account</h2>
                <div class="settings-option">
                    <div class="settings-card">
                        <i class="fas fa-users"></i>
                        <div>
                            <div class="text">Manage Account</div>
                            <p>Lupon / Official</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function backupDatabase() {
            window.location.href = "configs/backup_restore.php?backup=true";
        }

        function redirectToAuthorization(event) {
            event.preventDefault(); 
            window.location.href = "authorization.html"; 
        }

    </script>
</body>
</html>
