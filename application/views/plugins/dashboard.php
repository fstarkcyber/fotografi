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