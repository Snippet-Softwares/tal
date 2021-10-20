<style>
    .wrap {
        font-family: monotype corsiva;
        text-align: left;
    }

    .tank {
        margin: 0 25px;
        display: inline-block;
    }

    body {
        margin: 0;
    }
</style>
<div class="tank waterTankHere1"></div>
<script src="assets/js/jquery.js"></script>
<script src="waterTank.js"></script>
<script>
    $(document).ready(function () {
        $('.waterTankHere1').waterTank({
            width: 230,
            height: 300,
            color: '#8bd0ec',
            level: 0
        }).on('click', function (event) {
            $.ajax({
                type: 'POST',
                url: 'tank1.php',
                success: function (data) {
                    if (isNaN(data)) {
                        // do not update the tank animation
                    } else {
                        $('.waterTankHere1').waterTank({
                            level: data
                        });
                    }
                }
            });
        });
    });
    setInterval(function () {
        $('.waterTankHere1').trigger('click');
    }, 2000);
</script>
</body>
</html>