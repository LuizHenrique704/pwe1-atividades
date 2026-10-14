<?php
$usuario = $_COOKIE['usuario_logado'] ?? "não";
echo "Usuário logado: " . htmlspecialchars($usuario);
