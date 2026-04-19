<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Educational Resources - FoodFusion</title>
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
    $login_redirect = "Components/Login.php?redirect=Educational Resources.php";

    // Fetch Guides
    $guides_query = "SELECT * FROM educational_resources WHERE section = 'guide'";
    $guides_result = mysqli_query($con, $guides_query);

    // Fetch Infographics
    $infographics_query = "SELECT * FROM educational_resources WHERE section = 'infographic'";
    $infographics_result = mysqli_query($con, $infographics_query);

    // Fetch Videos
    $videos_query = "SELECT * FROM educational_resources WHERE section = 'video'";
    $videos_result = mysqli_query($con, $videos_query);
    ?>

    <div class="container">
        <section class="edu-hero">
            <h1>Educational Resources</h1>
            <p>Explore our collection of downloadable resources, infographics, and videos on renewable energy topics. Learn how sustainable energy can transform our world.</p>
        </section>

        <!-- Downloadable Resources -->
        <section class="content-block">
            <h2>Downloadable Resources</h2>
            <p class="section-intro">Access comprehensive guides, reports, and documents about renewable energy technologies and sustainability.</p>
            
            <div class="resources-grid">
                <?php while($row = mysqli_fetch_assoc($guides_result)): ?>
                <div class="resource-card <?php echo htmlspecialchars($row['card_class']); ?>">
                    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <?php if($is_logged_in): ?>
                        <a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="download-btn" download>Download PDF</a>
                    <?php else: ?>
                        <a href="<?php echo $login_redirect; ?>" class="download-btn">Login to Download</a>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <hr>

        <!-- Infographics -->
        <section class="content-block">
            <h2>Infographics</h2>
            <p class="section-intro">Visual data and statistics about renewable energy presented in easy-to-understand graphics.</p>
            
            <div class="infographics-grid">
                <?php while($row = mysqli_fetch_assoc($infographics_result)): ?>
                <div class="infographic-card">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    <div class="infographic-info">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    </div>
                    <div class="infographic-overlay">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <?php if($is_logged_in): ?>
                            <a href="<?php echo htmlspecialchars($row['image_path']); ?>" class="download-btn" download>
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

        <!-- Videos -->
        <section class="content-block">
            <h2>Educational Videos</h2>
            <p class="section-intro">Watch expert talks, tutorials, and documentaries about renewable energy technologies.</p>
            
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
                        <p><?php echo htmlspecialchars($row['video_duration']); ?></p>
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
            
            // Show play button again when video ends or is paused manually via controls
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