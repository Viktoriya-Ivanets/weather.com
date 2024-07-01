<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Output of title variable -->
    <title><?= $title; ?></title>

    <!-- Own and foreign styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
</head>

<body id="full-page">
    <!-- container -->
    <div class="container mt-5 rounded all-content">
        <!-- card -->
        <div class="card low-opacity">
            <!-- card-header -->
            <nav class="navbar navbar-expand-lg navbar-light card-header sticky-top d-flex">
                <!-- Logo -->
                <a class="navbar-brand" href="index.php">
                    <img src="assets/images/weather.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                    Weather
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <!-- Search -->
                    <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
                        <div class="input-group">
                            <input name="city" class="form-control mr-2" type="search" placeholder="Enter city for search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </nav>
            <!-- /.card-header -->
            <!-- card-body -->
            <div class="card-body">
                <!-- Navigation row -->
                <div class="row justify-content-around justify-content-sm-center">
                    <nav class="nav nav-pills m-3 d-flex flex-wrap justify-content-center">
                        <a class="nav-item nav-link btn btn-light border border-primary m-1" href="index.php?city=<?= $city; ?>&date=<?= $yesterday_date; ?>">Yesterday</a>
                        <a class="nav-item nav-link btn btn-light border border-primary m-1" href="index.php?city=<?= $city; ?>&forecast_days=5">5 days</a>
                        <a class="nav-item nav-link btn btn-light border border-primary m-1" href="index.php?city=<?= $city; ?>&forecast_days=7">7 days</a>
                        <a class="nav-item nav-link btn btn-light border border-primary m-1" href="index.php?city=<?= $city; ?>&forecast_days=10">10 days</a>
                        <a id="past-day-btn" class="nav-item nav-link btn btn-light border border-primary m-1" href="">Past day</a>
                        <a id="future-day-btn" class="nav-item nav-link btn btn-light border border-primary m-1" href="">Future day</a>
                    </nav>
                </div>
                <!-- datepicker row-->
                <div class="row justify-content-center">
                    <div id="datepicker-container" class="text-center">
                        <div class="mb-3" id="date_header"></div>
                        <div class="mb-3" id="datepicker"></div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <!-- Output of content -->
                <div class="content-container"><?= $content; ?></div>
            </div>
            <!-- /.card-body -->
            <!-- card-footer -->
            <div class="card-footer d-flex justify-content-center">
                <p class="mr-2">Powered by</p> <a href="https://www.weatherapi.com/" title="Free Weather API">WeatherAPI.com</a>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
    <!-- /.container -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let city = "<?= $city; ?>";
    </script>
    <script src="assets/scripts.js"></script>
</body>

</html>
