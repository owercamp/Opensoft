@extends('modules.comercialPermanentcontracts')

@section('space')
<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      @php $yearNow = date('Y') @endphp
      <div class="btn-group mx-3">
        <a href="#" class="btn btn-outline-primary btn-less"><i class="fas fa-angle-left"></i></a>
        <button class="px-3" style="border-top: 1px solid #000; border-bottom: 1px solid #000;"> AÑO: </button>
        <button class="btn btn-default year" style="border-top: 1px solid #000; border-bottom: 1px solid #000;">{{ $yearNow }}</button>
        <a href="#" class="btn btn-default btn-plus" disabled><i class="fas fa-angle-right"></i></a>
      </div>
    </div>
    <div class="col-md-6">
      <!-- <div class="form-group">
    				<input type="hidden" class="form-control form-control-sm" name="year" value="{{ $yearNow }}" readonly required>
    				<input type="hidden" name="view_file" class="form-control form-control-sm" readonly required>
					<button type="button" class="btn btn-outline-tertiary mx-3 my-3 form-control-sm btn-drawPdf"><i class="fas fa-file-pdf"></i> DESCARGAR</button>
    			</div> -->
    </div>
  </div>
  <div id="sectionToPdf" class="row"></div>
  <div class="row sectionToPdf">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-8 content-schudeling">
          <canvas id="statisticLegalizations" width="300" height="150"></canvas>
        </div>
        <div class="col-md-4">
          <table id="tblLegalizations" class="table table-hover text-center mt-4 border-top">
            <thead>
              <tr>
                <th></th>
                <!-- <th>TOTAL</th> -->
                <th>VIGENTE</th>
                <th>TERMINADO</th>
              </tr>
            </thead>
            <tbody>
              @for($i = 1;$i <= 12;$i++) <tr>
                @if($i == '1') <td>ENERO</td> @endif
                @if($i == '2') <td>FEBRERO</td> @endif
                @if($i == '3') <td>MARZO</td> @endif
                @if($i == '4') <td>ABRIL</td> @endif
                @if($i == '5') <td>MAYO</td> @endif
                @if($i == '6') <td>JUNIO</td> @endif
                @if($i == '7') <td>JULIO</td> @endif
                @if($i == '8') <td>AGOSTO</td> @endif
                @if($i == '9') <td>SEPTIEMBRE</td> @endif
                @if($i == '10') <td>OCTUBRE</td> @endif
                @if($i == '11') <td>NOVIEMBRE</td> @endif
                @if($i == '12') <td>DICIEMBRE</td> @endif
                <!-- <td>{{ $datesAll[$i][0] }}</td> -->
                <td>{{ $datesAll[$i][0] }}</td>
                <td>{{ $datesAll[$i][1] }}</td>
                </tr>
                @endfor
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  //Colors: Naranja: #fd8701 Verde: #a4b068
  var canvas = document.getElementById('statisticLegalizations');
  var ctx = document.getElementById('statisticLegalizations').getContext('2d');
  var statistic = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
          label: 'VIGENTE',
          data: [{
              !!$datesAll[1][0] !!
            },
            {
              !!$datesAll[2][0] !!
            },
            {
              !!$datesAll[3][0] !!
            },
            {
              !!$datesAll[4][0] !!
            },
            {
              !!$datesAll[5][0] !!
            },
            {
              !!$datesAll[6][0] !!
            },
            {
              !!$datesAll[7][0] !!
            },
            {
              !!$datesAll[8][0] !!
            },
            {
              !!$datesAll[9][0] !!
            },
            {
              !!$datesAll[10][0] !!
            },
            {
              !!$datesAll[11][0] !!
            },
            {
              !!$datesAll[12][0] !!
            }
          ],
          backgroundColor: [
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green'
          ],
          borderColor: [
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green',
            'green'
          ],
          borderWidth: 1
        },
        {
          label: 'TERMINADO',
          data: [{
              !!$datesAll[1][1] !!
            },
            {
              !!$datesAll[2][1] !!
            },
            {
              !!$datesAll[3][1] !!
            },
            {
              !!$datesAll[4][1] !!
            },
            {
              !!$datesAll[5][1] !!
            },
            {
              !!$datesAll[6][1] !!
            },
            {
              !!$datesAll[7][1] !!
            },
            {
              !!$datesAll[8][1] !!
            },
            {
              !!$datesAll[9][1] !!
            },
            {
              !!$datesAll[10][1] !!
            },
            {
              !!$datesAll[11][1] !!
            },
            {
              !!$datesAll[12][1] !!
            }
          ],
          backgroundColor: [
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red'
          ],
          borderColor: [
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red',
            'red'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
  var img = new Image();
  $(function() {
    convertCanvasToImage();
  });

  $('.btn-drawPdf').on('click', function(e) {
    e.preventDefault();
    convertCanvasToImage();
    var pdf = new jsPDF();
    pdf.setFontSize(15);
    pdf.text('REPORTE DE CONTRATOS DEL AÑO ' + $('button.year').text(), 30, 25);
    pdf.addImage(img, 'png', 20, 40, 170, 90);
    pdf.save("REPORTE_" + $('button.year').text() + "_GENERADO EL " + Date() + ".pdf");
  });

  function convertCanvasToImage() {
    img.src = canvas.toDataURL("image/png");
  }

  $('.btn-less').on('click', function(e) {
    e.preventDefault();
    var year = parseInt($('.year').text()) - 1;
    var yearnow = new Date().getFullYear();
    if (year <= parseInt(yearnow)) {
      if (year == parseInt(yearnow)) {
        $('.btn-plus').attr('disabled', true);
        $('.btn-plus').removeClass('btn-outline-primary');
        $('.btn-plus').addClass('btn-default');
      }
      // $.ajax({
      // 	type: 'GET',
      // 	url: "{{ route('clients.statistic.pending') }}",
      // 	data: {year: year},
      // 	dataType: 'json',
      // 	async: false
      // }).done(function(response){
      // 	statistic.data.datasets[0].data = response;
      // 	var i = 0;
      // 	$('#tblLegalizations tbody tr').each(function(){
      // 		$(this).find('td:nth-child(2)').text(response[i]);
      // 		i++;
      // 	});
      // });
      $.ajax({
        type: 'GET',
        url: "{{ route('permanent.statistic.now') }}",
        data: {
          year: year
        },
        dataType: 'json',
        async: false
      }).done(function(response) {
        statistic.data.datasets[0].data = response;
        var i = 0;
        $('#tblLegalizations tbody tr').each(function() {
          $(this).find('td:nth-child(2)').text(response[i]);
          i++;
        });
      });
      $.ajax({
        type: 'GET',
        url: "{{ route('permanent.statistic.not') }}",
        data: {
          year: year
        },
        dataType: 'json',
        async: false
      }).done(function(response) {
        statistic.data.datasets[1].data = response;
        var i = 0;
        $('#tblLegalizations tbody tr').each(function() {
          $(this).find('td:nth-child(3)').text(response[i]);
          i++;
        });
      });
      $('.year').text(year);
      $('input[name=year]').val(year);
      if (year == parseInt(yearnow)) {
        $('.btn-plus').attr('disabled', true);
        $('.btn-plus').removeClass('btn-outline-primary');
        $('.btn-plus').addClass('btn-default');
      } else {
        $('.btn-plus').attr('disabled', false);
        $('.btn-plus').removeClass('btn-default');
        $('.btn-plus').addClass('btn-outline-primary');
      }
      statistic.update();
      convertCanvasToImage();
    } else {
      $('.btn-plus').attr('disabled', true);
      $('.btn-plus').removeClass('btn-outline-primary');
      $('.btn-plus').addClass('btn-default');
    }
  });

  $('.btn-plus').on('click', function(e) {
    e.preventDefault();
    var year = parseInt($('.year').text()) + 1;
    var yearnow = new Date().getFullYear();
    if (year <= parseInt(yearnow)) {
      $.ajax({
        type: 'GET',
        url: "{{ route('permanent.statistic.now') }}",
        data: {
          year: year
        },
        dataType: 'json',
        async: false
      }).done(function(response) {
        statistic.data.datasets[0].data = response;
        var i = 0;
        $('#tblLegalizations tbody tr').each(function() {
          $(this).find('td:nth-child(2)').text(response[i]);
          i++;
        });
      });
      $.ajax({
        type: 'GET',
        url: "{{ route('permanent.statistic.not') }}",
        data: {
          year: year
        },
        dataType: 'json',
        async: false
      }).done(function(response) {
        statistic.data.datasets[1].data = response;
        var i = 0;
        $('#tblLegalizations tbody tr').each(function() {
          $(this).find('td:nth-child(3)').text(response[i]);
          i++;
        });
      });
      $('.year').text(year);
      $('input[name=year]').val(year);
      if (year == parseInt(yearnow)) {
        $('.btn-plus').attr('disabled', true);
        $('.btn-plus').removeClass('btn-outline-primary');
        $('.btn-plus').addClass('btn-default');
      } else {
        $('.btn-plus').attr('disabled', false);
        $('.btn-plus').removeClass('btn-default');
        $('.btn-plus').addClass('btn-outline-primary');
      }
      statistic.update();
      convertCanvasToImage();
    } else {
      $('.btn-plus').attr('disabled', true);
      $('.btn-plus').removeClass('btn-outline-primary');
      $('.btn-plus').addClass('btn-default');
    }
  });
</script>
@endsection