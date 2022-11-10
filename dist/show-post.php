<?php
session_start();
require_once('Models/Post.php');
$post = Post::find($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Rudolfo's Test Blog</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
  <!-- Navigation-->
  <?php if (isset($_SESSION['user_id'])) : ?>
    <?php include('fragments/nav.php'); ?>
  <?php else : ?>
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.html">TotalTickets LTD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto py-4 py-lg-0">
            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="registration.php">Register</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <?php endif; ?>
  <!-- Page Header-->
  <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <div class="post-heading">
            <h1><?php echo $post->title; ?></h1>
            <span class="meta">
              Posted by
              <a href="#!"><?php echo $post->creator()->name ?></a>
              on <?php echo date("Y/m/d H:i:s", $post->created_at);  ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Post Content-->
  <article class="mb-4">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <?php if (isset($_SESSION['user_id']) && $post->creator_id === $_SESSION['user_id']) : ?>
            <div class="d-flex justify-content-end">
              <a href="edit-post.php?id=<?php echo $post->id; ?>" class="btn btn-primary p-2 me-2">
                <i class="fa-solid fa-pencil fa-fw"></i>
                Edit
              </a>
              <div class="dropstart">
                <button class="btn btn-danger p-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-trash fa-fw"></i>
                  Delete
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <h6 class="dropdown-header">Are you sure?</h6>
                  </li>
                  <li>
                    <a href="delete-post-request.php?id=<?php echo $post->id; ?>" class="link-danger p-2 ms-3">
                      Yes, Im sure!
                    </a>
                  </li>
                </ul>
              </div>

            </div>
          <?php endif; ?>
          <p class="text-justify"><?php echo $post->body  ?></p>
          <?php if (isset($_SESSION['user_id'])) : ?>
            <div class="card mb-4">
              <div class="card-body border-top pt-2">
                <?php foreach ($post->comments() as $comment) : ?>
                  <div class="pt-2">
                    <div class="fw-bold p-0"><?php echo $comment->creator()->name ?></div>
                    <div class="ms-2"><?php echo $comment->body ?></div>
                    <div class="ms-2 text-muted" style="font-size: 12px;"><?php echo date("Y/m/d H:i:s", $comment->created_at) ?></div>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="card-body">
                <form action="store-comment-request.php" method="post">
                  <input type="hidden" name="post_id" value="<?php echo $post->id ?>">
                  <div class="form-floating">
                    <textarea required class="form-control" name="body" id="comment" placeholder="Enter your comment here..." style="height: 6rem" data-sb-validations="required"></textarea>
                    <label for="comment">Comment</label>
                    <div class="invalid-feedback" data-sb-feedback="comment:required">A comment is required.</div>
                  </div>
                  <div class="d-flex justify-content-end mt-2">
                    <button class="btn btn-primary btn-sm">Comment</button>
                  </div>
                </form>
              </div>
            </div>
          <?php endif; ?>
          <p>
            Placeholder text by
            <a href="http://spaceipsum.com/">Space Ipsum</a>
            &middot; Images by
            <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
          </p>
        </div>
      </div>
    </div>
  </article>
  <!-- Footer-->
  <footer class="border-top">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#!">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2022</div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>