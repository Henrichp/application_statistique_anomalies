@extends('layout._layout')

@section('content')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <!--<script src="https://code.highcharts.com/stock/highstock.js"></script>-->
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script type="text/javascript">

    $(function () {
      var data = <?php echo $data; ?>;
      var categories = <?php echo $categories; ?>;
      var moyenne = <?php echo $moyenne; ?>;
      var sigma_sup = <?php echo $sigma_sup; ?>;
      var sigma_inf = <?php echo $sigma_inf; ?>;
      /*
       var dataObject = {
       rangeSelector: {
       selected: 1,
       inputEnabled: $('#container').width() > 480
       },

       title: {
       text: 'AAPL Stock Price'
       },

       series: [{
       name: 'AAPL',
       data: data,
       tooltip: {
       valueDecimals: 2
       }
       }],

       chart: {
       renderTo: 'container'
       }
       };

       var chart = new Highcharts.StockChart(dataObject);

       });*/

      /* global document */
// Load the fonts
      Highcharts.createElement('link', {
        href: 'https://fonts.googleapis.com/css?family=Unica+One',
        rel: 'stylesheet',
        type: 'text/css'
      }, null, document.getElementsByTagName('head')[0]);

      Highcharts.theme = {
        colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
          '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
        chart: {
          backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
              [0, '#2a2a2b'],
              [1, '#3e3e40']
            ]
          },
          style: {
            fontFamily: '\'Unica One\', sans-serif'
          },
          plotBorderColor: '#606063'
        },
        title: {
          style: {
            color: '#E0E0E3',
            textTransform: 'uppercase',
            fontSize: '20px'
          }
        },
        subtitle: {
          style: {
            color: '#E0E0E3',
            textTransform: 'uppercase'
          }
        },
        xAxis: {
          gridLineColor: '#707073',
          labels: {
            style: {
              color: '#E0E0E3'
            }
          },
          lineColor: '#707073',
          minorGridLineColor: '#505053',
          tickColor: '#707073',
          title: {
            style: {
              color: '#A0A0A3'

            }
          }
        },
        yAxis: {
          gridLineColor: '#707073',
          labels: {
            style: {
              color: '#E0E0E3'
            }
          },
          lineColor: '#707073',
          minorGridLineColor: '#505053',
          tickColor: '#707073',
          tickWidth: 1,
          title: {
            style: {
              color: '#A0A0A3'
            }
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.85)',
          style: {
            color: '#F0F0F0'
          }
        },
        plotOptions: {
          series: {
            dataLabels: {
              color: '#B0B0B3'
            },
            marker: {
              lineColor: '#333'
            }
          },
          boxplot: {
            fillColor: '#505053'
          },
          candlestick: {
            lineColor: 'white'
          },
          errorbar: {
            color: 'white'
          }
        },
        legend: {
          itemStyle: {
            color: '#E0E0E3'
          },
          itemHoverStyle: {
            color: '#FFF'
          },
          itemHiddenStyle: {
            color: '#606063'
          }
        },
        credits: {
          style: {
            color: '#666'
          }
        },
        labels: {
          style: {
            color: '#707073'
          }
        },

        drilldown: {
          activeAxisLabelStyle: {
            color: '#F0F0F3'
          },
          activeDataLabelStyle: {
            color: '#F0F0F3'
          }
        },

        navigation: {
          buttonOptions: {
            symbolStroke: '#DDDDDD',
            theme: {
              fill: '#505053'
            }
          }
        },

        // scroll charts
        rangeSelector: {
          buttonTheme: {
            fill: '#505053',
            stroke: '#000000',
            style: {
              color: '#CCC'
            },
            states: {
              hover: {
                fill: '#707073',
                stroke: '#000000',
                style: {
                  color: 'white'
                }
              },
              select: {
                fill: '#000003',
                stroke: '#000000',
                style: {
                  color: 'white'
                }
              }
            }
          },
          inputBoxBorderColor: '#505053',
          inputStyle: {
            backgroundColor: '#333',
            color: 'silver'
          },
          labelStyle: {
            color: 'silver'
          }
        },

        navigator: {
          handles: {
            backgroundColor: '#666',
            borderColor: '#AAA'
          },
          outlineColor: '#CCC',
          maskFill: 'rgba(255,255,255,0.1)',
          series: {
            color: '#7798BF',
            lineColor: '#A6C7ED'
          },
          xAxis: {
            gridLineColor: '#505053'
          }
        },

        scrollbar: {
          barBackgroundColor: '#808083',
          barBorderColor: '#808083',
          buttonArrowColor: '#CCC',
          buttonBackgroundColor: '#606063',
          buttonBorderColor: '#606063',
          rifleColor: '#FFF',
          trackBackgroundColor: '#404043',
          trackBorderColor: '#404043'
        },

        // special colors for some of the
        legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
        background2: '#505053',
        dataLabelsColor: '#B0B0B3',
        textColor: '#C0C0C0',
        contrastTextColor: '#F0F0F3',
        maskColor: 'rgba(255,255,255,0.3)'
      };

// Apply the theme
      Highcharts.setOptions(Highcharts.theme);

      $('#container').highcharts({

        chart: {
          type: 'line'
        },
        plotOptions: {
          line: {
            marker: {
              enabled: false,
              states: {
                hover: {
                  enabled: false
                }
              }
            }
          }
        },
        tooltip: {
          crosshairs: true,
          shared: true,
          valueSuffix: '$'
        },
        title: {
          text: '{{$cote}}'
        },
        rangeSelector:{
          enabled:true,
          selected: 1
        },
        xAxis: {
          categories: categories

        },
        yAxis: {
          title: {
            text: 'valeur ($)'
          }
        },
        series: [{
          name: '{{$cote}}',
          data: data
        },{
          name: 'moyenne',
          data: moyenne
        },{
            name: 'sigma supérieur',
            data: sigma_sup
          },{
          name: 'sigma inférieur',
          data: sigma_inf
        }]
      });
    });

  </script>
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <div class="row">

    <div class="col-md-12">
      <div id="container"></div>
      <div>
        <table id="dat" class="datatable" style="width:100%">

        </table>
      </div>
      <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"></script>
      <script src="//cdn.datatables.net/buttons/1.2.3/js/buttons.flash.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
      <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
      <script src="//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"></script>
      <script>
        $(document).ready(function(){

          $('#dat').hide();

          var table = $('#dat').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.serverSide') }}',
            oSearch: {"sSearch": "{{$cote}}"},
            dom: 'Bfrtip',
            buttons: [
              'csv', 'excel'
            ],
            columns:[
              {sTitle:"Jour"},
              {sTitle:"Cote"},
              {sTitle:"Type d'anomalie"}, //this still shows on load
              {sTitle:"Valeur en anomalie"} //does not show on load
            ],
            /*columnDefs: [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button>Afficher</button>"
          } ],*/

          });

          $('#dat').show();

          //https://datatables.net/examples/ajax/null_data_source.html
          /*$('#dat tbody').on( 'click', 'button', function () {
            var dataTab = table.row( $(this).parents('tr') ).data();
            var cote = dataTab[1];
            {{--URL::route('cote_graphique/', array('cote_id' => "AA"))--}}
            {{--App::make(GraphiquesController)->boutGraphique(dataTab[1])--}}
            } );*/
        });

        //var oTable = $('#dat').dataTable();
        /*$(oTable.fnGetNodes()).on("mouseover", function (event) {
          $(this).closest('table').find('button#add_button').remove();
          var $button = $("").text("Add");
          $($button).on("click", function(event){alert("hello");});
          $(this).append($button);
        });*/

        {{--src = "{{ route('searchajax') }}";
        $("#search_text").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: src,
              dataType: "json",
              data: {
                term : request.term
              },
              success: function(data) {
                response(data);

              }
            });
          },
          min_length: 3,

        });--}}

      </script>
    </div>

  </div>
@endsection
