

<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
	<meta charset="utf-8">
	<meta name="author" content="nguyenthanhnha">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="public/css/style.css">
	<link rel="stylesheet" href="public/css/font-awesome.css">
</head>
<body>

	
<?php if(isset($works)){?>

  <div class="container">
  	<form action="" method="post">
	  <div class="form-group">
	    <label for="exampleFormControlInput1">Work Name</label>
	    <input type="text" class="form-control" name="work_name" required="required" id="exampleFormControlInput1" value="<?php echo $works['work_name']?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleFormControlInput1">Starting Date</label>
	    <input type="text" class="form-control" name="starting_date" required="required" id="from1" autocomplete="off" value="<?php echo date_format(date_create($works['starting_date']), 'd-m-Y ')?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleFormControlInput1">Ending Date</label>
	    <input type="text" class="form-control" name="ending_date" required="required" id="to1" autocomplete="off" value="<?php echo date_format(date_create($works['ending_date']), 'd-m-Y ')?>">
	  </div>
	
	  <div class="form-group">
	    <label for="exampleFormControlSelect1">Status</label>
	    <select class="form-control" id="exampleFormControlSelect1" name="status">
	      <option value="Planning" <?php echo ($works['status'] == 'Planning')?'selected':''?>>Planning</option>
	      <option value="Doing" <?php echo ($works['status'] == 'Doing')?'selected':''?>>Doing</option>
	      <option value="Complete" <?php echo ($works['status'] == 'Complete')?'selected':''?>>Complete</option>
	    </select>
	  </div>
		
	  <div class="form-group">
	  	<button type="submit" class="btn btn-primary" name="submit_edit" value="<?php echo $works['id']?>">Edit</button>
	  </div>
	</form>
<?php }?>
	<a href="index.php">Back!</a>
</div>    



<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  	
<script>
 
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from1" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to1" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  });
  </script>
</body>
</html>