//Datepicker script
$(document).ready(function() {
            $("#past-day-btn, #future-day-btn").click(function(event) {
                event.preventDefault();
                let isFuture = $(this).attr('id') === 'future-day-btn';
                //Define params for future day
                if (isFuture) {
                    $("#date_header").text("Please choose some date. Date must be between 14 days and 300 days from today in the future");
                    $("#datepicker").datepicker("option", "minDate", "+15d");
                    $("#datepicker").datepicker("option", "maxDate", "+300d");
                }
                //Define params for past day 
                else {
                    $("#date_header").text("Please choose some date. Date must be between 365 days ago and today's date");
                    $("#datepicker").datepicker("option", "minDate", "-365d");
                    $("#datepicker").datepicker("option", "maxDate", new Date());
                }
                $("#datepicker").toggle();
                $("#date_header").toggle();
            });

            //Update URL
            $("#datepicker").datepicker({
                onSelect: function(dateText) {
                    window.location.href = "index.php?city=" + city + "&date=" + dateText;
                },
                dateFormat: 'yy-mm-dd'
            });
            //Change background img depending on the time
            updateBackground();
        });

        //Update background img func
        function updateBackground() {
            //Get current time
            let now = new Date();
            let hour = now.getHours();
            //Default background
            let imageUrl = '/assets/images/day.jpg';

            //If night - change img
            if (hour >= 22 || hour <= 5) {
                imageUrl = '/assets/images/night.jpg';
            }

            $('#full-page').css('background', 'url(' + imageUrl + ')');
        }
