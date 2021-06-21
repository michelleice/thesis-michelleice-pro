(($) => {
    const MAX_LOOKBACK = 14;
    const api = Cels.Globals.api;
    const meta = Cels.Globals.meta;
    
    let request = (new Cels.Request()).auth().csrf();

    let generateDatasetsForType = (type) => {
        let datasets = [];
        switch (type) {
        case 'LDR':
            datasets.push({
                'label': 'Dark',
            });
            break;
        case 'AM2302':
            datasets.push({
                'label': 'Humidity',
            });
            datasets.push({
                'label': 'Temperature',
            });
            break;
        }
        return datasets.map(data => {
            let generatedColor = `rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
            // rgb(54, 162, 235)
            return { 
                'fill': false,
                'backgroundColor': generatedColor,
                'borderColor': generatedColor,
                'data': [],
                ...data,
            };
        });
    }

    let setupInterval = (canvas, interval = 5000) => {
        request.request('GET', api(`v1/sensors/${$(canvas).data('sensor-id')}`)).then(sensor => {
            let config = {
                'type': 'line',
                'data': {
                    'labels': [],
                    'datasets': generateDatasetsForType(sensor.type)
                },
                'options': {
                    'responsive': true,
                    'legend': {
                        'display': false,
                    },
                    'tooltips': {
                        'mode': 'index',
                        'intersect': false,
                    },
                    'hover': {
                        'mode': 'nearest',
                        'intersect': true
                    },
                    'scales': {
                        'xAxes': [{
                            'display': true,
                            'scaleLabel': {
                                'display': false,
                            },
                        }],
                        'yAxes': [{
                            'display': true,
                            'scaleLabel': {
                                'display': true,
                                'labelString': 'Readings',
                            },
                        }],
                    },
                },
            };
            let chart = new Chart(canvas.getContext('2d'), config);

            let last_timestamp = null;
            let _f = () => {
                request.request('GET', api(`v1/sensors/${$(canvas).data('sensor-id')}/values`), last_timestamp ? {
                    'last_timestamp': last_timestamp,
                } : {}).then(sensor_values => {
                    if (sensor_values.length < 1) {
                        return;
                    }
                    sensor_values.reverse();

                    last_timestamp = sensor_values[sensor_values.length - 1].recorded_at;

                    for (let sensor_value of sensor_values) {
                        config.data.labels.push((new Date(sensor_value.recorded_at)).toLocaleTimeString());
                    }
                    while (config.data.labels.length >= MAX_LOOKBACK) {
                        config.data.labels.shift();
                    }

                    config.data.datasets.forEach((dataset, i) => {
                        for (let sensor_value of sensor_values) {
                            let readings = JSON.parse(sensor_value.sensor_value);
                            if (readings instanceof Array) {
                                dataset.data.push(parseFloat(readings[i]));
                            }
                            else {
                                dataset.data.push(parseFloat(readings));
                            }
                        }
                        while (dataset.data.length >= MAX_LOOKBACK) {
                            dataset.data.shift();
                        }
                    });
                    chart.update();
                    setTimeout(_f, interval);
                });
            };
            setTimeout(_f, interval);
        });
    }

    const $sensor_reading_canvases = $('canvas.sensor-reading');
    for (let sensor_reading_canvas of $sensor_reading_canvases) {
        setupInterval(sensor_reading_canvas);
    }
})(jQuery);