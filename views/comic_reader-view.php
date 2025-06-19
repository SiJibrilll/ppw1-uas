<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comic Reader</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
        all: unset;
        cursor: pointer;
        display: inline;
        color: inherit;
        text-decoration: none;
        }

        a:hover {
        text-decoration: underline; /* Optional: visible hover effect */
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #1a1a1a;
            color: white;
            line-height: 1.6;
        }

        .header {
            background-color: #2d2d2d;
            padding: 1rem;
            text-align: center;
            border-bottom: 2px solid #444;
        }

        .comic-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .chapter-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .nav-link {
            background-color: #4a5568;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .nav-link:hover {
            background-color: #5a6578;
        }

        .nav-link.disabled {
            background-color: #333;
            color: #666;
            pointer-events: none;
        }

        .current-chapter {
            font-size: 1.1rem;
            color: #a0aec0;
            margin: 0 0.5rem;
        }

        .reader-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .comic-panel {
            width: 100%;
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
            background-color: #2d2d2d;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .comic-panel img {
            width: 100%;
            height: auto;
            display: block;
        }

        .panel-placeholder {
            height: 400px;
            background: linear-gradient(135deg, #4a5568, #2d3748);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            text-align: center;
            font-size: 1.1rem;
        }

        .bottom-nav {
            background-color: #2d2d2d;
            padding: 1.5rem;
            text-align: center;
            border-top: 2px solid #444;
            margin-top: 2rem;
        }

        .bottom-nav .chapter-nav {
            justify-content: center;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .header {
                padding: 1rem 0.5rem;
            }

            .comic-title {
                font-size: 1.3rem;
            }

            .chapter-nav {
                gap: 0.5rem;
            }

            .nav-link {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .current-chapter {
                font-size: 1rem;
                margin: 0.5rem 0;
                width: 100%;
            }

            .reader-container {
                padding: 1rem 0.5rem;
            }

            .comic-panel {
                margin-bottom: 0.5rem;
                border-radius: 4px;
            }

            .panel-placeholder {
                height: 300px;
                font-size: 1rem;
            }

            .bottom-nav {
                padding: 1rem 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .comic-title {
                font-size: 1.2rem;
            }

            .reader-container {
                padding: 1rem 0.25rem;
            }

            .nav-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.85rem;
            }

            .current-chapter {
                font-size: 0.9rem;
                margin: 0 0.25rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="/comics?id=<?=htmlspecialchars($comic['id'])?>)">
            <h1 class="manga-title"><?= htmlspecialchars($comic['title'])?></h1>
        </a>
        
        <nav class="chapter-nav">
            <a href="/read?comic=<?= htmlspecialchars($comic_id) ?>&chapter=<?= max(1, $current_page - 1) ?>" class="nav-link <?= $chapter['id'] <= 1 ? 'disabled' : '' ?>">← Previous</a>
            <div class="current-chapter">Chapter: <?= htmlspecialchars($chapter['title']) ?></div>
            <a href="/read?comic=<?= htmlspecialchars($comic_id) ?>&chapter=<?= $current_page + 1 ?>" class="nav-link">Next →</a>
        </nav>
    </header>

    <main class="reader-container">
        <?php if (!empty($pages)): ?>
            <?php foreach ($pages as $page): ?>
                <div class="comic-panel">
                    <img src="<?= htmlspecialchars($page['path']) ?>" alt="Comic Page">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="comic-panel panel-placeholder">
                <p>No pages available for this chapter.</p>
            </div>
        <?php endif; ?>
    </main>

    <footer class="bottom-nav">
        <nav class="chapter-nav">
            <a href="/read?comic=<?= htmlspecialchars($comic_id) ?>&chapter=<?= max(1, $current_page - 1) ?>" class="nav-link <?= $chapter['id'] <= 1 ? 'disabled' : '' ?>">← Previous</a>
            <div class="current-chapter">Chapter: <?= htmlspecialchars($chapter['title']) ?></div>
            <a href="/read?comic=<?= htmlspecialchars($comic_id) ?>&chapter=<?= $current_page + 1 ?>" class="nav-link">Next →</a>
        </nav>
    </footer>
</body>
</html>