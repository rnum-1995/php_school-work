<?php
// XSS対策用エスケープ関数
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// CSRFトークン生成
function generate_csrf_token()
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf_token'];
}

// CSRFトークン検証
function validate_csrf_token($token)
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
