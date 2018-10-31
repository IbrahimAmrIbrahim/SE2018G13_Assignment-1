<?php
include_once("./controllers/common.php");
include_once('./components/head.php');
include_once('./models/grade.php');
$id = safeGet('id');
Database::connect('school', 'root', '');
$grades = new Grade($id, "std");
?>


<body>    
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="./Home.php"> <i class="fas fa-user-graduate"></i> SIS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./Home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./students.php">Students<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./courses.php">Courses</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Begin page content -->
    <main role="main" class="container">

        <h2 class="mt-4"><?= ($id) ? "Edit" : "Add" ?> Grade</h2>

        <form action="controllers/savegrade.php" method="post">
            <input type="hidden" name="id" value="<?= $grades->get('id') ?>">


            <div class="card">
                <div class="card-body">
                    <div class="form-group row gutters">
                        
                        <label  for="" class="col-sm-2 col-form-label">Student Name</label>
                        <div class="col-sm-10" style="margin-bottom: 10px">
                            <input class="form-control" type="text"  value="<?= $grades->get('std_name') ?>" disabled>
                        </div>

                        <label  for="" class="col-sm-2 col-form-label">Course Name</label>
                        <div class="col-sm-10" style="margin-bottom: 10px">
                            <input class="form-control" type="text"  value="<?= $grades->get('crs_name') ?>" disabled>
                        </div>

                        <label  for="" class="col-sm-2 col-form-label">Max Grade</label>
                        <div class="col-sm-10" style="margin-bottom: 10px">
                            <input class="form-control" type="text"  value="<?= $grades->get('max_degree') ?>" disabled>
                        </div>


                        <label  for="" class="col-sm-2 col-form-label">Degree</label>
                        <div class="col-sm-10" style="margin-bottom: 10px">
                            <input class="form-control" type="text" name="degree" value="<?= $grades->get('degree') ?>" required>
                        </div>
                        <label for="" class="col-sm-2 col-form-label">Examine at</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="examine_at" value="<?= $grades->get('examine_at') ?>" required>
                        </div>  
                    </div>
                    <div class="form-group">
                        <button class="button float-right" type="submit"><?= ($id) ? "Save" : "Add" ?></button>
                    </div>
                </div>
            </div>
        </form>

        <?php include_once('./components/tail.php') ?> 