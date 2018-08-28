<!DOCTYPE html>
<html>
<head>
	<title>To Do List</title>
	<meta charset="utf-8">
	<meta content="nguyenthanhnha" name="author">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="public/css/style.css">
	<link rel="stylesheet" href="public/css/font-awesome.css">
</head>
<body>
	<?php if(isset($msg)){?>
		<script type="text/javascript">
			alert('<?php echo $msg?>');
		</script>
	<?php }?>
	<h1 class="title">TO DO LIST - NGUYEN THANH NHA </h1>
	<a href="" class="btn-add" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i>Add Work</a>

	<div class="wrap-form">
		<form action="index.php?op=filter" method="post" class="form-filter">
			<div class="form-group">
		    	<label for="exampleFormControlInput1">Date</label>
		    	<input type="text" class="form-control" name="date" required="required" id="date" autocomplete="off">
		    	<span>
		    		<button type="submit" class="btn btn-primary" name="filter_date" value="0"><i class="fa fa-filter" aria-hidden="true"></i></button>
		    	</span>
		  	</div>
		</form>
		<form action="index.php?op=filter" method="post" class="form-filter">
			<div class="form-group">
		    	<label for="exampleFormControlInput1">Week</label>
		    	<input type="week" class="form-control" name="week" required="required" id="week" autocomplete="off">
		    	<span>
		    		<button type="submit" class="btn btn-primary" name="filter_week" value="0"><i class="fa fa-filter" aria-hidden="true"></i></button>
		    	</span>
		  	</div>
		</form>
		<form action="index.php?op=filter" method="post" class="form-filter">
			<div class="form-group">
		    	<label for="exampleFormControlInput1">Month</label>
		    	<input type="text" class="form-control" name="month" required="required" id="month" autocomplete="off">
		    	<span>
		    		<button type="submit" class="btn btn-primary" name="filter_month" value="0"><i class="fa fa-filter" aria-hidden="true"></i></button>
		    	</span>
		  	</div>
		</form>
	</div>
	<div class="wrap-view">
		<ul class="menu-view">
			<li><a href="index.php?op=home&view=date">View with Date</a></li>
			<li><a href="index.php?op=home&view=week">View with Week</a></li>
			<li><a href="index.php?op=home&view=month">View with Month</a></li>
		</ul>
	</div>
	<?php if (isset($view)) {?>
		<?php if($view == 'month'){?>
			<div class="content-table">
				<table class="table table-striped">
				  	<thead>
					    <tr>
					      	<th scope="col">#</th>
					      	<th scope="col">Month</th>
					      	<th scope="col">Year</th>
					      	<th scope="col">Total Works</th>
					      	<th width="20%"></th>
					    </tr>
				  	</thead>
				  	<tbody>
				  		<?php $d = 0?>
				  		<?php foreach ($works as $work){ $d +=1?>
						    <tr>
						      	<th scope="row"><?=$d?></th>
						      	<td><?php echo $work['month']?></td>
						      	<td><?php echo $work['year']?></td>
						      	<td><?php echo $work['total']?></td>
						      	<td>
						      		<a href="index.php?op=detail&month=<?php echo $work['month']?>&year=<?php echo $work['year']?>" class="btn-edit"><i class="fa fa-eye" aria-hidden="true"></i><span>View</span></a>
						      	</td>
						    </tr>
					    <?php }?>	
				  	</tbody>
				</table>
			</div>
		<?php }else if($view == 'week'){?>
			<div class="content-table">
				<table class="table table-striped">
				  	<thead>
					    <tr>
					      	<th scope="col">#</th>
					      	<th scope="col">Weeks</th>
					      	<th scope="col">Year</th>
					      	<th scope="col">Total Works</th>
					      	<th width="20%"></th>
					    </tr>
				  	</thead>
				  	<tbody>
				  		<?php $d = 0?>
				  		<?php foreach ($works as $work){ $d +=1?>
						    <tr>
						      	<th scope="row"><?=$d?></th>
						      	<td><?php echo $work['week']?></td>
						      	<td><?php echo $work['year']?></td>
						      	<td><?php echo $work['total']?></td>
						      	<td>
						      		<a href="index.php?op=detail&week=<?php echo $work['week']?>&year=<?php echo $work['year']?>" class="btn-edit"><i class="fa fa-eye" aria-hidden="true"></i><span>View</span></a>
						      	</td>
						    </tr>
					    <?php }?>	
				  	</tbody>
				</table>
			</div>
		<?php }else{?>
			<div class="content-table">
				<table class="table table-striped">
				  	<thead>
					    <tr>
					      	<th scope="col">#</th>
					      	<th scope="col">Work Name</th>
					      	<th scope="col">Starting Date</th>
					      	<th scope="col">Ending Date</th>
					      	<th scope="col">Status</th>
					      	<th width="20%"></th>
					    </tr>
				  	</thead>
				  	<tbody>
				  		<?php $d = 0?>
				  		<?php foreach ($works as $work){ $d +=1?>
						    <tr>
						      	<th scope="row"><?=$d?></th>
						      	<td><?php echo $work['work_name']?></td>
						      	<td><?php echo date_format(date_create($work['starting_date']), 'H:i:s d-m-Y ')?></td>
						      	<td><?php echo date_format(date_create($work['ending_date']), 'H:i:s d-m-Y ')?></td>
						      	<td><?php echo $work['status']?></td>
						      	<td>
						      		<a href="index.php?op=edit&id=<?php echo $work['id']?>" class="btn-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Edit</span></a>
									<a href="index.php?op=delete&id=<?php echo $work['id']?>" class="btn-delete"><i class="fa fa-trash" aria-hidden="true"></i><span>Delete</span></a>
						      	</td>
						    </tr>
					    <?php }?>	
				  	</tbody>
				</table>
			</div>
		<?php }?>
	<?php }?>
		

	

  <!-- The Modal Add -->
	<div class="modal" id="addModal">
	    <div class="modal-dialog">
	    	<div class="modal-content">
	      
		        <!-- Modal Header -->
		        <div class="modal-header">
		          <h4 class="modal-title">Modal Heading</h4>
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
		        
		        <!-- Modal body -->
		        <div class="modal-body">
		          	<form action="index.php" method="post">
					  <div class="form-group">
					    <label for="exampleFormControlInput1">Work Name</label>
					    <input type="text" class="form-control" name="work_name" required="required" id="exampleFormControlInput1" placeholder="work name">
					  </div>
					  <div class="form-group">
					    <label for="exampleFormControlInput1">Starting Date</label>
					    <input type="text" class="form-control" name="starting_date" required="required" id="from1" autocomplete="off">
					  </div>
					  <div class="form-group">
					    <label for="exampleFormControlInput1">Ending Date</label>
					    <input type="text" class="form-control" name="ending_date" required="required" id="to1" autocomplete="off">
					  </div>
					
					  <div class="form-group">
					    <label for="exampleFormControlSelect1">Status</label>
					    <select class="form-control" id="exampleFormControlSelect1" name="status">
					      <option value="Planning">Planning</option>
					      <option value="Doing">Doing</option>
					      <option value="Complete">Complete</option>
					    </select>
					  </div>

					  <div class="form-group">
					  	<button type="submit" class="btn btn-primary" name="submit_add" value="0">Add</button>
					  </div>
					</form>
		        </div>
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        </div>
	        
	    	</div>
		</div>
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

  	$( function() {
    	var mon = null;
		var sun = null;

		$('#date').datepicker({onSelect: findWeek, beforeShowDay: disableWeek});

		function findWeek() {
		      mon = $(this).datepicker('getDate');
		      if (mon) {
		            mon.setDate(mon.getDate() + 1 - (mon.getDay() || 7));
		            sun = new Date(mon.getTime());
		            sun.setDate(sun.getDate() + 6);
		      }
		}

		function disableWeek(date) {
		      return [!mon || mon.getTime() > date.getTime() || sun.getTime() < date.getTime(), ''];
		}
  	});
  	 $(function() {
            $('#month').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'mm-yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
        });
  </script>
  	
</body>
</html>