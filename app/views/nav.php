<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php echo APP_URL; ?>">PHP MVC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">My Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">My Files</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
        <?php if (Controller::hasLogin()) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Welcome back, <?php echo $_SESSION['username']; ?><b class="cavet"></b>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo APP_URL; ?>/User/settings">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo APP_URL; ?>/User/logout">Sign out</a>
                </div>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo APP_URL; ?>/User/login">Sign in/up</a>
            </li>
        <?php } ?>
        </ul>
    </div>
</nav>
