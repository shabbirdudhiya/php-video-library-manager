<?php
include './session_manager.php';


checkUserRole($_SESSION["role"], "admin");

include '../includes/head.inc.php';

include '../includes/navbar.inc.php';
?>
<div class="container mt-5">
    <h2>Create Video</h2>
    <form action="submit_video.php" method="post">
        <div class="form-group">
            <label for="youtubeId">YouTube ID</label>
            <input type="text" class="form-control" id="youtubeId" name="youtubeId" required>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="isActive" name="isActive" checked>
            <label class="form-check-label" for="isActive">Active</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    <h2 class="mt-5">Videos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Video Link</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP code to fetch and display videos -->
            <?php
            include_once '../logic/get-all-videos.php';
            // Assuming you have a function to fetch videos by user's group
            $videos = fetchVideosByUserGroup($_SESSION['user_group']);
            foreach ($videos as $video) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($video['title']) . '</td>';
                echo '<td><a href="https://www.youtube.com/watch?v=' . htmlspecialchars($video['youtubeId']) . '" target="_blank" rel="noopener noreferrer">Open</a></td>';
                echo '<td>' . ($video['isActive'] ? 'Yes' : 'No') . '</td>';
                echo '<td>';
                echo '<button class="btn ' . ($video['isActive'] ? 'btn-warning' : 'btn-success') . '">' . ($video['isActive'] ? 'Deactivate' : 'Activate') . '</button> ';
                echo '<button class="btn btn-danger">Delete</button>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include '../includes/footer.inc.php';
