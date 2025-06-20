<?php
// Get previous input values if available
$old = $_SESSION['old'] ?? $chapter;
$errors = $_SESSION['errors'] ?? [];

// Clear the session data so it's not reused accidentally
unset($_SESSION['old'], $_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit New Comic - ImComic Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .header {
            background-color: #4a5568;
            color: white;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .form-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #2d3748;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px dashed #cbd5e0;
            border-radius: 6px;
            background-color: #f7fafc;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input:hover {
            border-color: #4299e1;
            background-color: #ebf8ff;
        }

        .cover-preview {
            margin-top: 1rem;
            text-align: center;
        }

        .cover-preview img {
            max-width: 200px;
            max-height: 300px;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: block;
            margin: 0 auto;
        }

        .cover-preview-placeholder {
            width: 150px;
            height: 200px;
            background: #e2e8f0;
            border: 2px dashed #cbd5e0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            font-size: 0.9rem;
            margin: 0 auto;
        }

        .submit-btn {
            background-color: #48bb78;
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: auto;
            display: inline-block;
        }

        .submit-btn:hover {
            background-color: #38a169;
        }

        .submit-btn:disabled {
            background-color: #a0aec0;
            cursor: not-allowed;
        }

        .back-btn {
            background-color: #4a5568;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #2d3748;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .container {
                margin: 1rem auto;
            }
            
            .form-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ImComic Admin</h1>
    </div>
    <div class="container">
        <a href="/chapters?comic_id=<?=$chapter['comic_id']?> " class="back-btn">← Back to Chapters Library</a>
        
        <div class="form-card">
            <h2 class="form-title">Update chapter</h2>

            <form method="POST" enctype="multipart/form-data" id="comicForm" action="/chapters/update">
                <?php if (!empty($errors)): ?>
                    <div style="color:red;">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <input type="text" name="id" id="id" value="<?= htmlspecialchars($old['id'] ?? '') ?>" hidden>
                <input type="text" name="comic_id" id="comic_id" value="<?= htmlspecialchars($old['comic_id'] ?? '') ?>" hidden>

                <div class="form-group">
                    <label for="cover" class="form-label">Cover Image *</label>
                    <input type="file" 
                           id="cover" 
                           name="cover" 
                           class="file-input" 
                           accept="image/*" 
                           onchange="previewCover(this)">
                    <div class="cover-preview" id="coverPreview">
                        <div class="cover-preview-placeholder">
                            No image selected
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                               class="form-input" 
                               required 
                               placeholder="Enter comic title">
                    </div>

                    
                </div>

                <button type="submit" class="submit-btn">
                    Submit Chapter Edit
                </button>
            </form>
        </div>
    </div>

    <script>
        function previewCover(input) {
            const preview = document.getElementById('coverPreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Cover preview">`;
                };
                
                reader.readAsDataURL(input.files[0]);
            } else {
                // If no file selected, check if there's an existing image to show
                const existingImage = preview.querySelector('img');
                if (!existingImage) {
                    preview.innerHTML = '<div class="cover-preview-placeholder">No image selected</div>';
                }
            }
        }

        // Function to set initial preview image (for editing existing comics)
        function setInitialPreview(imageUrl) {
            const preview = document.getElementById('coverPreview');
            if (imageUrl) {
                preview.innerHTML = `<img src="${imageUrl}" alt="Current cover">`;
            }
        }

        // Form validation
        document.getElementById('comicForm').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const cover = document.getElementById('cover').files[0];

            if (!title) {
                e.preventDefault();
                alert('Please fill in all required fields and select a cover image.');
                return false;
            }

            // Check file size (5MB limit)
            if (cover && cover.size > 5 * 1024 * 1024) {
                e.preventDefault();
                alert('Cover image must be smaller than 5MB.');
                return false;
            }

            // Check file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (cover && !allowedTypes.includes(cover.type)) {
                e.preventDefault();
                alert('Please select a valid image file (JPEG, PNG, GIF, or WebP).');
                return false;
            }
        });

        // Set initial preview if editing existing comic
        <?php if (isset($old['cover']) && !empty($old['cover'])): ?>
            setInitialPreview('<?php echo htmlspecialchars($old['cover']); ?>');
        <?php endif; ?>
    </script>
</body>
</html>