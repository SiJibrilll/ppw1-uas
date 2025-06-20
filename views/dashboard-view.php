<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comic Admin Panel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #343a40;
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .header h1 {
            text-align: center;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .content-wrapper {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .search-section {
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .search-container {
            flex: 1;
            max-width: 600px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 0.9rem;
            background: white;
            transition: border-color 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #495057;
            box-shadow: 0 0 0 2px rgba(73, 80, 87, 0.1);
        }

        .search-btn {
            padding: 10px 20px;
            background-color: #495057;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .search-btn:hover {
            background-color: #343a40;
        }

        .clear-btn {
            padding: 10px 15px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .clear-btn:hover {
            background-color: #5a6268;
        }

        .new-comic-btn {
            padding: 12px 24px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.2s ease;
            white-space: nowrap;
            height: fit-content;
        }

        .new-comic-btn:hover {
            background-color: #218838;
            color: white;
            text-decoration: none;
        }

        .new-comic-btn::before {
            content: '+';
            font-size: 1.1rem;
            font-weight: bold;
        }

        .search-results-info {
            margin-top: 10px;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .table-header {
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
            background: #f8f9fa;
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #495057;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        tr {
            border-bottom: 1px solid #dee2e6;
        }

        th, td {
            text-align: left;
            padding: 15px;
            /* border-bottom: 1px solid #dee2e6; */
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            font-size: 0.9rem;
        }

        .title-cell {
            font-weight: 500;
            color: #212529;
        }

        .description-cell {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #6c757d;
        }

        .chapter-count {
            text-align: center;
            font-weight: 500;
        }

        .cover-image {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }

        .cover-cell {
            width: 70px;
            text-align: center;
        }

        .actions {
            height: 100%;
            display: flex;
            align-items: center; /* Vertically centers items */
            gap: 8px;
            min-height: 7rem;
            height: auto !important;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background-color: #6c757d;
            color: white;
        }

        .btn-edit:hover {
            background-color: #5a6268;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            gap: 10px;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .pagination-info {
            margin-right: 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            background: white;
            color: #495057;
            cursor: pointer;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .pagination-btn:hover {
            background-color: #e9ecef;
        }

        .pagination-btn.active {
            background-color: #495057;
            color: white;
            border-color: #495057;
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .search-section {
                flex-direction: column;
                gap: 15px;
            }
            
            .search-form {
                flex-direction: column;
                gap: 10px;
            }
            
            .search-input {
                margin-bottom: 0;
            }
            
            .new-comic-btn {
                align-self: flex-start;
            }
            
            th, td {
                padding: 10px 8px;
                font-size: 0.8rem;
            }
            
            .description-cell {
                max-width: 150px;
            }
            
            .btn {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ImComic Admin</h1>
    </div>

    <div class="container">
        <div class="content-wrapper" style="margin-bottom: 2%;">
            <div class="table-header">
                <h2 class="table-title">Comics Library</h2>
            </div>
            
            <div class="search-section">
                <div class="search-container">
                    <form method="GET" action="" class="search-form">
                        <input 
                            type="text" 
                            name="search" 
                            class="search-input" 
                            placeholder="Search comics by title, author, or description..." 
                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                        >
                        <button type="submit" class="search-btn">Search</button>
                        <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
                        <a href="?" class="clear-btn">Clear</a>
                        <?php endif; ?>
                        
                        <!-- Preserve current page when searching -->
                        <?php if(isset($_GET['page']) && !isset($_GET['search'])): ?>
                        <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
                        <?php endif; ?>
                    </form>
                    
                    <!-- Search results info -->
                    <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
                    <div class="search-results-info">
                        Showing results for: "<strong><?= htmlspecialchars($_GET['search']) ?></strong>"
                    </div>
                    <?php endif; ?>
                </div>
                
                <a href="/comics/create" class="new-comic-btn">New Comic</a>
            </div>
            
            
            
            <div class="table-container">
                <table id="comicsTable">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Chapters</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data row - replace with PHP loop -->
                         
                         <?php foreach($comics as $comic): ?>
                        <tr>
                            <td onclick="location.href = '/comics?id=<?= htmlspecialchars($comic['id']) ?>';" class="cover-cell">
                                <img src="<?= htmlspecialchars($comic['cover']) ?: $GLOBALS['placeholder']?>" alt="<?= $comic['title']?> Cover" class="cover-image">
                            </td>
                            <td onclick="location.href = '/comics?id=<?= htmlspecialchars($comic['id']) ?>';" class="title-cell"><?= htmlspecialchars($comic['title']) ?></td>
                            <td onclick="location.href = '/comics?id=<?= htmlspecialchars($comic['id']) ?>';"><?= htmlspecialchars($comic['author']) ?></td>
                            <td onclick="location.href = '/comics?id=<?= htmlspecialchars($comic['id']) ?>';" class="description-cell" title="<?= htmlspecialchars($comic['description']) ?>"><?= htmlspecialchars($comic['description']) ?></td>
                            <td onclick="location.href = '/comics?id=<?= htmlspecialchars($comic['id']) ?>';" class="chapter-count"><?= htmlspecialchars($comic['chapter_count']) ?></td>
                            <td class="actions">
                                <a href="/comics/edit?id=<?= htmlspecialchars($comic['id']) ?>" class="btn btn-edit">Edit</a>
                                <form id="delete/<?= htmlspecialchars($comic['id']) ?>" action="/comics/delete" method="POST" >
                                    <input type="text" name="id" value="<?= htmlspecialchars($comic['id']) ?>" hidden>
                                    <div class="btn btn-delete" type="submit"  onclick="if(confirm('Are you sure you want to delete this comic?')) {document.getElementById('delete/<?= htmlspecialchars($comic['id']) ?>').submit()}">Delete</div>
                                </form>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <div class="pagination-info">
                    Showing <?= (($current_page - 1) * 10) + 1 ?>-<?= min($current_page * 10, $total_comics) ?> of <?= $total_comics ?> comics</div>
                <?php if($current_page > 1): ?>
                <a href="?page=<?= $current_page - 1 ?>&search=<?= urlencode($search) ?>" class="pagination-btn">Previous</a>
                <?php else: ?>
                <span class="pagination-btn disabled">Previous</span>
                <?php endif; ?>
                <?php for($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++): ?>
                <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" class="pagination-btn <?= $i == $current_page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
                <?php if($current_page < $total_pages): ?>
                <a href="?page=<?= $current_page + 1 ?>&search=<?= urlencode($search) ?>" class="pagination-btn">Next</a>
                <?php else: ?>
                <span class="pagination-btn disabled">Next</span>
                <?php endif; ?>
            </div>
        
             
        </div>
        <a href="/home" style="width: 100%; text-align:center; margin-right: 50%; margin-left: 50%;">Home</a>
    </div>
</body>
</html>