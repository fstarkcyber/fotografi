<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<script>
    $(document).ready(function() {

        const bulan = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        Get();

        function Get() {
            $.ajax({
                type: "GET",
                url: base_url + 'Dashboard/count',
                dataType: "JSON",
                success: function(response) {
                    transactionValueChart(response.transactionValue);
                    totalOrderChart(response.totalOrder);

                    $('#total-customer').html(response.total_customer);
                    $('#total-fotografer').html(response.total_fotografer);
                    $('#total-transaksi').html(response.total_transaksi);
                    $('#total-booking').html(response.total_booking);

                    if (response.images_gallery.length > 0) {
                        var images = '';
                        $.each(response.images_gallery, function(i, v) {
                            images += '<div class="col-lg-3 col-md-4 col-xs-6 thumb">' +
                                '    <a href="' + base_url + 'assets/img/galeri/' + v.image_name + '" class="fancybox" rel="ligthbox">' +
                                '        <img src="' + base_url + 'assets/img/galeri/' + v.image_name + '" class="zoom img-fluid " alt="">' +
                                '    </a>' +
                                '</div>';
                        });

                        // $(style).appendTo('head');
                        $('#display-gallery').html(images);

                        $(".fancybox").fancybox({
                            openEffect: "none",
                            closeEffect: "none"
                        });

                        $(".zoom").hover(function() {
                            $(this).addClass('transition');
                        }, function() {
                            $(this).removeClass('transition');
                        });
                    }

                    console.log(response);
                }
            });
        }

        function transactionValueChart(data) {
            var transactionValueChart = new Chart('trx-value', {
                type: 'line',
                options: {
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: Charts.colors.gray[200],
                                zeroLineColor: Charts.colors.gray[200]
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(t, d) {
                                var xLabel = d.datasets[t.datasetIndex].label;
                                var yLabel = t.yLabel >= 1000 ?
                                    t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") :
                                    t.yLabel;
                                return xLabel + ': ' + yLabel;
                            }
                        }
                    }
                },
                data: {
                    labels: bulan,
                    datasets: [{
                        label: 'Value',
                        data: data
                    }]
                }
            });
        }

        function totalOrderChart(data) {
            var ordersChart = new Chart('total-order', {
                type: 'bar',
                data: {
                    labels: bulan,
                    datasets: [{
                        label: 'Transaction',
                        data: data
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 1,
                                stepValue: 0.5,
                                // suggestedMax: 100
                            }
                        }]
                    },
                }
            });
        }
    });
</script>