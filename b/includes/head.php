<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Xestión de usuarios';
}
?>
<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <style>
        :root {
            --ink: #111;
            --accent: #001adf;
            --border: #bfbfbf;
            --muted: #4b5563;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Times New Roman', Georgia, serif;
            background: #fff;
            color: var(--ink);
            padding: 1.5rem 0.5rem 2.5rem;
        }
        header {
            max-width: 880px;
            margin: 0 auto;
            border-bottom: 1px solid var(--border);
            padding-bottom: 0.4rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: baseline;
            gap: 1rem;
        }
        header h1 {
            font-size: 1.85rem;
            margin: 0;
        }
        nav a {
            text-decoration: none;
            color: var(--accent);
            font-weight: bold;
            margin-right: 0.75rem;
            padding: 0.15rem 0.4rem;
            border: 1px solid transparent;
        }
        nav a.btn-slim {
            border-color: var(--accent);
            border-radius: 4px;
            font-size: 0.95rem;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            max-width: 880px;
            margin: 0 auto;
        }
        h2 {
            font-size: 1.5rem;
            margin: 0 0 0.4rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.98rem;
        }
        th, td {
            padding: 0.45rem 0.35rem;
            border-bottom: 1px solid #dcdcdc;
            text-align: left;
        }
        th {
            font-size: 0.95rem;
            font-weight: bold;
        }
        .actions {
            display: flex;
            gap: 0.4rem;
        }
        .icon-link {
            color: var(--accent);
            text-decoration: none;
            font-size: 1.05rem;
        }
        .icon-link:hover {
            color: #0410a8;
        }
        .alert {
            border: 1px solid var(--border);
            padding: 0.75rem 1rem;
            background: #f8f8f8;
            margin: 1rem 0;
        }
        form {
            margin-top: 0.5rem;
        }
        form label {
            display: inline-block;
            font-weight: bold;
            min-width: 150px;
            margin: 0.3rem 0;
        }
        form input {
            width: 220px;
            padding: 0.35rem;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 0.95rem;
        }
        .form-row {
            margin-bottom: 0.4rem;
        }
        button,
        .btn-link,
        .btn-simple {
            font-family: 'Times New Roman', Georgia, serif;
            font-size: 0.95rem;
            padding: 0.35rem 0.85rem;
            border: 1px solid var(--border);
            background: #fafafa;
            color: var(--ink);
            cursor: pointer;
            margin-top: 0.6rem;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
        }
        .btn-simple:hover {
            background: #f0f0f0;
        }
        .btn-muted {
            border-color: transparent;
            color: var(--muted);
        }
    </style>
</head>
<body>
<header>
    <h1>Usuarios rexistrados</h1>
    <nav>
        <a href="/index.php">Inicio</a>
        <a class="btn-slim" href="/crear.php">Novo rexistro</a>
    </nav>
</header>
<main>
