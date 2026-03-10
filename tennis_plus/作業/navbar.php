    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top px-3">
      <a class="navbar-brand" href="./index.php">サークルサイト</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="#">アルバム</a></li>
          <li class="nav-item"><a class="nav-link" href="#">掲示板</a></li>
          <li class="nav-item"><a class="nav-link" href="./login.php">ログアウト</a></li>
        </ul>
      </div>
      <?php if (isset($_SESSION['id'])): $role = get_roles_list(); ?>
        <p class="text-light">
          <?php echo $_SESSION['name']; ?> [<?php echo $_SESSION['role']; ?>]
        </p>
      <?php endif; ?>
    </nav>