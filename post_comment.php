<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/navigation.php";?>

    <!-- ======= Blog Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Blog</h2>

          <ol>
            <li><a href="index.php">Blog</a></li>
            <li><?php?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Blog Section -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            
          <?php
            if (isset($_GET['p_id'])) {
              $post_id_get = $_GET['p_id'];
          
              $query = "SELECT * FROM posts WHERE post_id = $post_id_get";
              $query_post_result = mysqli_query($connection, $query);
              if (!$query_post_result) {
                die("Query Failed" . mysqli_error($connection));
              }

              if (mysqli_num_rows($query_post_result)>0) {
                while ($row = mysqli_fetch_assoc($query_post_result)) {
                  $post_id = $row['post_id'];
                  $post_title = $row['post_title'];
                  $post_author = $row['post_author'];
                  $post_date = $row['post_date'];
                  $post_image = $row['post_image'];
                  $post_content = $row['post_content'];
                  $post_tags = $row['post_tags'];

                  $date = new DateTime($post_date);
                  $formatted_date = $date->format('M j, Y');

            ?>

              
            <article class="entry entry-single">

              <div class="entry-img">
                <img src="img/blog/blog-1.jpg" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href=""><?php echo $post_title ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href=""><?php echo $post_author ?></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time datetime="2020-01-01"><?php echo $formatted_date ?></time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="">1 Comments</a></li>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?php echo $post_content ?>
                </p>

               
                <img src="assets/img/blog/blog-inside-post.jpg" class="img-fluid" alt="">

                <h3>Ut repellat blanditiis est dolore sunt dolorum quae.</h3>
                <p>
                  Rerum ea est assumenda pariatur quasi et quam. Facilis nam porro amet nostrum. In assumenda quia quae a id praesentium. Quos deleniti libero sed occaecati aut porro autem. Consectetur sed excepturi sint non placeat quia repellat incidunt labore. Autem facilis hic dolorum dolores vel.
                  Consectetur quasi id et optio praesentium aut asperiores eaque aut. Explicabo omnis quibusdam esse. Ex libero illum iusto totam et ut aut blanditiis. Veritatis numquam ut illum ut a quam vitae.
                </p>

              </div>

              <div class="entry-footer">
                <h6>Post tags</h6>
                <i class="bi bi-tags"></i>
                <ul class="tags">
                  <li><a href="#"><?php echo $post_tags;?></a></li>
                </ul>
              </div>

            </article><!-- End blog entry -->
                        
            <?php
                }
              }
            }else{
                header("Location: index.php");
            }
            
        ?>

        <div class="blog-author d-flex align-items-center">
          <img src="assets/img/blog/blog-author.jpg" class="rounded-circle float-left" alt="">
          <div>
            <h4><?php echo $post_author?></h4>
            <div class="social-links">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="biu bi-instagram"></i></a>
            </div>
            <p>
              Itaque quidem optio quia voluptatibus dolorem dolor.
            </p>
          </div>
        </div><!-- End blog author bio -->

            <div class="blog-comments">

            <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id_get} AND comment_status = 'Approved' ORDER BY comment_id DESC";
                $comment_display_result= mysqli_query($connection, $query);

                if (!$comment_display_result) {
                    die("Query Failed" . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_assoc($comment_display_result)) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
              ?>
                <h4 class="comments-count"> <?php echo mysqli_num_rows($comment_display_result)?></h4>
                <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="img/blog/comments-1.jpg" alt=""></div>
                  <div>
                    <h5><a href=""><?php echo $comment_author?></a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan, 2020</time>
                    <p>
                    <?php echo $comment_content;?>
                    </p>
                  </div>
                </div>
              </div><!-- End comment -->



                <!-- Comment -->

                <?php }?>









              <?php
                if (isset($_POST['create_comment'])) {
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    if (empty($comment_author || $comment_email || $comment_content)) {
                        echo "<h3 class=''>Field can't be empty</h3>";
                    }else{
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query.= "VALUES (?, ?, ?, ?, 'Unapproved', NOW())";
                        $query_result = mysqli_prepare($connection, $query);
                        
                        mysqli_stmt_bind_param($query_result, "isss", $post_id_get, $comment_author, $comment_email, $comment_content);
                        if (!mysqli_stmt_execute($query_result)) {
                            die("Execute failed: " . mysqli_stmt_error($query_result));
                        }
                        mysqli_stmt_close($query_result);
                        mysqli_close($connection);
                        header("Location: post_comment.php?p_id=$post_id_get");
                    }
                }
                ?>



              <div class="reply-form">
                <h4>Leave a Reply</h4>
                <p>Your email address will not be published.</p>
                <form action="">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="comment_author" type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="comment_email" type="text" class="form-control" placeholder="Your Email">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment_content" rows="7" class="form-control" placeholder="Your Comment" style="resize: none;"></textarea>
                    </div>
                  </div>
                  <button type="submit" name="create_comment"class="btn btn-primary">Post Comment</button>

                </form>

              </div>
            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

<?php include "includes/sidebar.php"?>
<?php include "includes/footer.php"?>