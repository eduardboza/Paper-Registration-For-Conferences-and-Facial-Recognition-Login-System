<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">SISOM</a>
            
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
              <!-- <li> <a href="AllConferences.php">Conferences</li>  -->

                 <?php

                // $query = "SELECT * FROM categories";
                // $select_all_categories_query = mysqli_query($connection, $query);

                // while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                //     $cat_title = $row['cat_title'];
                    // $conf = "AllConferences.php";
                    // echo "<li><a href=#>{$cat_title}</a></li>";
                    echo "<li><a href='AllConferences.php'>Conferences</a></li>";
                //}
                ?>
                
                

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION["userId"])) {
                    echo "<li><a href='http://localhost:5000'>API</a></li>";
                    echo "<li><a href='SubmittedPapers.php'>Submitted Papers</a></li>";
                    echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                } else {
                    echo "<li><a href='signup.php'>Sign up</a></li>";
                    echo "<li><a href='signin.php'>Log in</a></li>";
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>