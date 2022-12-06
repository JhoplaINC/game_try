    <?php include_once 'meta.php'; ?>
    <?php include_once 'styles.php'; ?>
    <title>Game Try</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $server_path; ?>">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php session_start(); ?>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $account_path; ?>profile">Profile</a>
                    </li>  
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $account_path; ?>login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $account_path; ?>register">Create Account</a>
                    </li>
                <?php } ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Link</a></li>
                    <li><a class="dropdown-item" href="#">Another link</a></li>
                    <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    