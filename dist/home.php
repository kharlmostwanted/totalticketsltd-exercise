<?php session_start();
require_once('Models/User.php');
require_once('Models/Post.php');
$user = User::find($_SESSION['user_id']);
$posts = Post::all();
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
    <?php require('fragments/nav.php') ?>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/about-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Home Page</h1>
                        <span class="subheading">I am <?php echo $user->name ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php foreach ($posts as $post) : ?>
                        <!-- Post preview-->
                        <div class="post-preview">
                            <a href="show-post.php?id=<?php echo $post->id; ?>">
                                <h2 class="post-title"><?php echo $post->title ?></h2>
                                <h3 class="post-subtitle"><?php echo substr($post->body, 0, 24) ?></h3>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <a href="#!"><?php echo $post->creator()->name ?></a>
                                on <?php echo date("M d, Y H:i:s", $post->created_at) ?>
                            </p>
                        </div>
                        <div class="card">
                            <div class="card-body border-top pt-2">
                                <?php foreach ($post->comments() as $comment) : ?>
                                    <div>
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
                                        <textarea class="form-control" name="body" id="comment" placeholder="Enter your comment here..." style="height: 6rem" data-sb-validations="required"></textarea>
                                        <label for="comment">Comment</label>
                                        <div class="invalid-feedback" data-sb-feedback="comment:required">A comment is required.</div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button class="btn btn-primary btn-sm">Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
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