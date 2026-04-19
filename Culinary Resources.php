<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinary Resources - FoodFusion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <?php 
    session_start();
    include 'Components/navbar.php'; 
    include 'Components/db.php';
    
    // Simple login check for downloads
    $is_logged_in = isset($_SESSION['user_id']);
    $login_redirect = "Components/Login.php?redirect=Culinary Resources.php";

    // Fetch Recipe Cards
    $recipe_cards_query = "SELECT * FROM culinary_resources WHERE section = 'recipe_card'";
    $recipe_cards_result = mysqli_query($con, $recipe_cards_query);

    // Fetch Tutorials
    $tutorials_query = "SELECT * FROM culinary_resources WHERE section = 'tutorial'";
    $tutorials_result = mysqli_query($con, $tutorials_query);

    // Fetch Videos
    $videos_query = "SELECT * FROM culinary_resources WHERE section = 'video'";
    $videos_result = mysqli_query($con, $videos_query);
    ?>

    <div class="container">
        <section class="edu-hero">
            <h1>Culinary Resources</h1>
            <p>Providing downloadable recipe cards, cooking tutorials, and instructional videos on various cooking techniques and kitchen hacks.</p>
        </section>

        <!-- Downloadable Recipe Cards -->
        <section class="content-block">
            <h2>Downloadable Recipe Cards</h2>
            <p class="section-intro">Print-ready recipe cards for your kitchen. Perfect for quick reference while cooking.</p>
            
            <div class="resources-grid">
                <?php while($row = mysqli_fetch_assoc($recipe_cards_result)): ?>
                <div class="resource-card">
                    <div class="resource-icon">
                        <span class="icon"><i class="fa-solid fa-file-pdf"></i></span>
                    </div>
                    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <?php if($is_logged_in): ?>
                        <a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="download-btn">Download</a>
                    <?php else: ?>
                        <a href="<?php echo $login_redirect; ?>" class="download-btn">Login to Download</a>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <hr>

        <!-- Cooking Tutorials -->
        <section class="content-block">
            <h2>Cooking Tutorials</h2>
            <p class="section-intro">Step-by-step guides on essential cooking techniques.</p>
            
            <div class="infographics-grid">
                <?php while($row = mysqli_fetch_assoc($tutorials_result)): ?>
                <div class="infographic-card">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    <div class="infographic-info">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    </div>
                    <div class="infographic-overlay">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <?php if($is_logged_in): ?>
                            <a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="download-btn" download>
                                <i class="fas fa-download"></i> Download
                            </a>
                        <?php else: ?>
                            <a href="<?php echo $login_redirect; ?>" class="download-btn">
                                <i class="fas fa-lock"></i> Login to Download
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <hr>

        <!-- Instructional Videos -->
        <section class="content-block">
            <h2>Instructional Videos</h2>
            <p class="section-intro">Watch expert demonstrations of cooking techniques and kitchen hacks.</p>
            
            <div class="videos-grid">
                <?php 
                $v_count = 1;
                while($row = mysqli_fetch_assoc($videos_result)): 
                    $v_id = "video" . $v_count;
                ?>
                <div class="video-card">
                    <div class="video-thumbnail">
                        <video id="<?php echo $v_id; ?>" preload="metadata">
                            <source src="<?php echo htmlspecialchars($row['video_path']); ?>#t=0.5" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="play-btn" onclick="toggleVideo('<?php echo $v_id; ?>', this)">
                            <span>▶</span>
                        </div>
                    </div>
                    <div class="video-content">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                        <p><?php echo htmlspecialchars($row['video_sub_info']); ?> • <?php echo htmlspecialchars($row['description']); ?></p>
                        <?php if($is_logged_in): ?>
                            <a href="<?php echo htmlspecialchars($row['video_path']); ?>" class="download-btn" download>
                                <i class="fas fa-download"></i> Download Video
                            </a>
                        <?php else: ?>
                            <a href="<?php echo $login_redirect; ?>" class="download-btn">
                                <i class="fas fa-lock"></i> Login to Download
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
                $v_count++;
                endwhile; 
                ?>
            </div>
        </section>

    </div>

    <?php include 'Components/footer.php'; ?>
    

    <!-- javascript -->

    <script>
        function toggleVideo(videoId, btn) {
            const video = document.getElementById(videoId);
            if (video.paused) {
                video.play();
                video.controls = true;
                btn.style.display = 'none';
            } else {
                video.pause();
            }
            
            
            video.onpause = function() {
                btn.style.display = 'flex';
                video.controls = false;
            };
            
            video.onended = function() {
                btn.style.display = 'flex';
                video.controls = false;
            };
        }
    </script>

</body>
</html>