<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shogunned - Manga Reader</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            position: relative;
        }
        
        .background-hero {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 400px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"%3E%3Cg fill-opacity="0.1"%3E%3Cpolygon fill="%23fff" points="50 0 60 40 100 50 60 60 50 100 40 60 0 50 40 40"/%3E%3C/g%3E%3C/svg%3E');
            z-index: -2;
        }
        
        .background-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to top, rgba(248, 249, 250, 1) 0%, rgba(248, 249, 250, 0.8) 50%, rgba(248, 249, 250, 0) 100%);
            z-index: -1;
        }
        
        .manga-header {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .manga-cover {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .manga-title {
            font-size: 2rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 5px;
        }
        
        .manga-author {
            font-size: 1.1rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .chapter-list {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .chapter-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #f1f3f4;
            transition: background-color 0.2s ease;
            text-decoration: none;
            color: inherit;
        }
        
        .chapter-item:hover {
            background-color: #f8f9fa;
            color: inherit;
            text-decoration: none;
        }
        
        .chapter-item:last-child {
            border-bottom: none;
        }
        
        .chapter-thumbnail {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            margin-right: 15px;
            flex-shrink: 0;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .chapter-thumbnail-fallback {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            margin-right: 15px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .chapter-title {
            flex: 1;
            font-size: 1rem;
            font-weight: 500;
            color: #495057;
        }
        
        .chapter-number {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
        }
        
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }
        
        .page-link {
            color: #495057;
            border: none;
            background: white;
            margin: 0 2px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .page-link:hover {
            background: #f8f9fa;
            color: #495057;
        }
        
        .page-item.active .page-link {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }

        .hero-description {
            position: absolute;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            max-width: 600px;
            text-align: center;
            color: white;
            z-index: 1;
        }

        .hero-description h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .hero-description p {
            font-size: 1.1rem;
            font-weight: 400;
            line-height: 1.6;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            opacity: 0.95;
        }
    </style>
</head>
<body>
    <!-- Background Hero Section -->
    <div class="background-hero"></div>
    
    <div class="container py-4">
        <!-- Manga Header -->
        <div class="manga-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="<?= htmlspecialchars($comic['cover'] ?? $GLOBALS['placeholder']) ?>" 
                         alt="Shogunned Cover" class="manga-cover">
                </div>
                <div class="col">
                    <h1 class="manga-title"><?= htmlspecialchars($comic['title'])?></h1>
                    <p class="manga-author"><?= htmlspecialchars($comic['author'])?></p>
                    <p class="manga-description"><?= htmlspecialchars($comic['description'])?></p>
                </div>
            </div>
        </div>
   

        <!-- Chapter List -->
        <div class="chapter-list">
            <?php foreach ($chapters as $chapter): ?>
                <a href="read?id=<?= htmlspecialchars($chapter['id'])?>" class="chapter-item">
                    <img src="<?= htmlspecialchars($chapter['cover'] ?? $GLOBALS['placeholder']) ?>" 
                        alt="Chapter 11 Thumbnail" class="chapter-thumbnail">
                    <div class="chapter-title"><?= htmlspecialchars($chapter['title'])?></div>
                </a>
            <?php endforeach; ?>
            
            <?php if (empty($chapters)): ?>
                <div class="chapter-item">
                    <div class="">No Chapters Available</div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <!-- <div class="pagination-wrapper">
            <nav aria-label="Chapter pagination">
                <ul class="pagination">
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <span class="page-link">...</span>
                    </li>
                </ul>
            </nav>
        </div> -->
        <!-- modify pagination above to use our pagination -->
        <div class="pagination-wrapper">
            <nav aria-label="Chapter pagination">
                <ul class="pagination">
                    <?php if ($current_page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="/comics?id=<?=$comic['id']?>&page=<?= $current_page - 1 ?>">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                            <a class="page-link" href="/comics?id=<?=$comic['id']?>&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="/comics?id=<?=$comic['id']?>&page=<?= $current_page + 1 ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>