<div class="container">
	<h1 class="mt-5">CEK PAKET</h1>

	<div class="form-group row">
	    
	    <div class="col-sm-6">
	      <input type="text" id="resi" class="form-control" placeholder="Input resi anda ...">
	    </div>
	    <button class="btn btn-primary col-sm-2" id="cek">Cek</button>

	    
  	</div>

  	<div class="col-sm-8">
  	<div class="row">
	    	<div class="col">
			    <div class="form-check">
				  <input class="form-check-input" type="radio" name="kurir" id="kurir" value="jne" >
				  <label class="form-check-label" for="jne">
				    JNE
				  </label>
				</div>
			</div>
			<div class="col">
			    <div class="form-check">
				  <input class="form-check-input" type="radio" name="kurir" id="kurir" value="tiki" >
				  <label class="form-check-label" for="tiki">
				    TIKI
				  </label>
				</div>
			</div>
			<div class="col">
			    <div class="form-check">
				  <input class="form-check-input" type="radio" name="kurir" id="kurir" value="pos" >
				  <label class="form-check-label" for="pos">
				    POS
				  </label>
				</div>
			</div>
			<div class="col">
			    <div class="form-check">
				  <input class="form-check-input" type="radio" name="kurir" id="kurir" value="sicepat" >
				  <label class="form-check-label" for="sicepat">
				    SiCepat
				  </label>
				</div>
			</div>
			<div class="col">
			    <div class="form-check">
				  <input class="form-check-input" type="radio" name="kurir" id="kurir" value="anteraja" >
				  <label class="form-check-label" for="anteraja">
				    AnterAja
				  </label>
				</div>
			</div>
			<div class="col">
			    <div class="form-check">
				  <input class="form-check-input" type="radio" name="kurir" id="kurir" value="ninja" >
				  <label class="form-check-label" for="ninja">
				    Ninja
				  </label>
				</div>
			</div>
			<div class="col">
			    <div class="form-check">
				  <input class="form-check-input" type="radio" name="kurir" id="kurir" value="jnt" >
				  <label class="form-check-label" for="jnt">
				    JNT
				  </label>
				</div>
			</div>
		</div>
		</div>

		<div id="detail">
		<div class="col-sm-8 mt-4">
			<p class="text-center text-success">(history.date - index ke 0)</p>
			<p>DELIVERED TO <span id="to">Michael Daud Tonda</span>, <span id="tujuan">DKI Jakarta</span>, <span id="tgl">30 Dec 2020 21:57:00</span></p>

			<table class="table" id="table1">
				<tr>
					<th>Nomor Resi</th>
					<th>Tanggal Pengirim</th>
					<th>Pengiriman</th>
					<th>Penerima</th>
				</tr>
			</table>
			<hr>
			<br>
			<h6>Detil Pengiriman</h6>

			<table id="detil">
				<tr>
					<th width="50%">Tanggal/Waktu</th>
					<th width="50%">Deskripsi</th>
				</tr>
			</table>
		</div>
		</div>
</div>

<script type="text/javascript">
	$('#detail').hide();
	$('#cek').click(function(){
		var resi = $('#resi').val();
		var kurir = $('input[name="kurir"]:checked').val();
		var api_key = 'af674d2c4b2e12287accecdaba51572c81e522ca8d3d17140245538695f8ca9f';
		$.ajax({
		  url: "https://api.binderbyte.com/v1/track?api_key=af674d2c4b2e12287accecdaba51572c81e522ca8d3d17140245538695f8ca9f&courier="+kurir+"&awb="+resi,
    		dataType: 'json', 
    		method: 'GET',
		  success: function(result){
		  	$('#detail').show();
		  	$('#to').text(result.data.detail.shipper);
		  	$('#tujuan').text(result.data.detail.destination);
		  	$('#tgl').text(result.data.summary.date);

		  	$('#table1').append(`
		  		<tr>
		  			<td>`+result.data.summary.awb+`</td>
		  			<td>`+result.data.summary.date+`</td>
		  			<td>`+result.data.detail.shipper+`</td>
		  			<td>`+result.data.detail.receiver+`</td>
		  		</tr>
		  	`);

		  	$.each(result.data.history, function (i) {
		  		console.log(result.data.history[i]);
			    // $.each(result.data.history[i], function (key, val) {
			    //     console.log(key + val);
			        $('#detil').append(`
					   	<tr>
					   	<td>`+result.data.history[i].date+`</td>
					   	<td>`+result.data.history[i].desc+`</td>
					   	</tr>
				  	 	`);
			    // });
			});

		  	// $.each(result.data.history, function( key, value ) {
			  // console.log( key + ": " + value );
			  // $('#detil').append(`
			  // 	<tr>
			  // 	<td>`+date+`</td>
			  // 	<td>`+desc+`</td>
			  // 	</tr>
		  	// 	`);
			// });
		  	

		    console.log(result.data.history);	
		  }
		});
	})
</script>