
<div class="col-lg-4">

<div class="sidebar">

  <h3 class="sidebar-title">Search</h3>
  <div class="sidebar-item search-form">
    <form action="search.php" method ="post">
        <input type="text" name="search"class="form-control">
        <button name = "submit"type="submit"><i class="bi bi-search"></i></button>
    </form>  
  </div><!-- End sidebar search formn-->

  <h3 class="sidebar-title">Categories</h3>
  <div class="sidebar-item categories">
    <ul>
        <?php
          $query = "SELECT * FROM category_header";
          $query_category_result = mysqli_query($connection, $query);
          if (!$query_category_result) {
              die("Query Failed " . mysqli_error($connection));
          }

          while ($row=mysqli_fetch_assoc($query_category_result)) {
              $cat_id    = $row['cat_id'];
              $cat_title = $row['cat_title'];

              echo "<li><a href='#'>$cat_title</a></li>";
          }
        ?>       
        </ul>
  </div><!-- End sidebar categories-->

  <h3 class="sidebar-title">Recent Posts</h3>
  <div class="sidebar-item recent-posts">
    <div class="post-item clearfix">
      <?php
        $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT 1";
        $query_result = mysqli_query($connection, $query);
        if (!$query_result) {
          die("Query Failed" . mysqli_error($connection));
        }

        if (mysqli_num_rows($query_result)>0) {
          while ($row = mysqli_fetch_assoc($query_result)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = substr($row['post_content'], 0, 50);

              $date = new DateTime($post_date);
              $formatted_date = $date->format('M j, Y');

        ?>

        <img src="assets/img/blog/blog-recent-1.jpg" alt="">
        <h4><a href=""><?php echo $post_title?></a></h4>
        <time datetime="2020-01-01"><?php echo $formatted_date ?></time>

        <?php
        }
      }
      ?>

    </div>
  </div><!-- End sidebar recent posts-->

  <h3 class="sidebar-title">Tags</h3>
  <div class="sidebar-item tags">
    <ul>
      <li><a href="#">App</a></li>
      <li><a href="#">IT</a></li>
      <li><a href="#">Business</a></li>
      <li><a href="#">Mac</a></li>
     
    </ul>
  </div><!-- End sidebar tags-->

</div><!-- End sidebar -->

</div><!-- End blog sidebar -->

</div>

</div>
</section><!-- End Blog Section -->

</main><!-- End #main -->