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

<body>
    <!-- container -->
    <div class="container mt-5 rounded">
        <!-- card -->
        <div class="card low-opacity">
            <!-- card-header -->
            <div class="card-header sticky-top d-flex justify-content-between">
                <!-- Logo -->
                <a class="navbar-brand" href="index.php">
                    <img src="assets/images/weather.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                    Weather
                </a>
                <!-- Search -->
                <form class="form-inline" action="index.php" method="post">
                    <input name="city" class="form-control mr-sm-2" type="search" placeholder="Enter city for search" aria-label="Search">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <!-- /.card-header -->
            <!-- card-body -->
            <div class="card-body">
                <!-- Navigation row -->
                <div class="row justify-content-around">
                    <nav class="nav nav-pills m-3">
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
                <?= $content; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script for datepicker -->
    <script>
        $(document).ready(function() {
            $("#past-day-btn, #future-day-btn").click(function(event) {
                event.preventDefault();
                var isFuture = $(this).attr('id') === 'future-day-btn';
                if (isFuture) {
                    $("#date_header").text("Please choose some date. Date must be between 14 days and 300 days from today in the future");
                    $("#datepicker").datepicker("option", "minDate", "+15d");
                    $("#datepicker").datepicker("option", "maxDate", "+300d");
                } else {
                    $("#date_header").text("Please choose some date. Date must be between 365 days ago and today's date");
                    $("#datepicker").datepicker("option", "minDate", "-365d");
                    $("#datepicker").datepicker("option", "maxDate", new Date());
                }
                $("#datepicker").toggle();
                $("#date_header").toggle();
            });

            $("#datepicker").datepicker({
                onSelect: function(dateText) {
                    var city = "<?= $city; ?>";
                    window.location.href = "index.php?city=" + city + "&date=" + dateText;
                },
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>

</html>
