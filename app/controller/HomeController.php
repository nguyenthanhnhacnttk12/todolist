<?php
/*---------------------  Nguyenthanhnha.cnttk12@gmail.com ----------------------*/
	require_once 'app/model/MyModel.php';

	Class HomeController{

		private $myModel = NULL;

		public function __construct()
		{
			$this->myModel = new MyModel();
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}

		public function redirect($location) {
	        header('Location: '.$location);
	    }


  		//router request 
	    public function handleRequest()
	    {	
	    	$op = isset($_GET['op'])?$_GET['op']:NULL;
	            if ( !$op || ($op == 'home')) {
	                $this->index();
	            } elseif ( $op == 'delete' ) {
	                $this->delete();
	            }else if( $op == 'edit'){
	            	$this->edit();
	            }else if( $op == 'detail'){
	            	$this->detailViewMonth();
	            }else if( $op == 'filter'){
	            	$this->filterWorks();
	            }
	    }

	    public function index()
	    {	

	    	//setting view work with date, week and month
	    	if (isset($_GET['view'])) {
	    		$view = $_GET['view'];
	    		if($view == 'date'){
	    			$view = 'date';
	    			$works = $this->myModel->findAll('work_name');
	    			include 'app/view/index.php';
	    			exit();
	    		}else if($view == 'week'){
	    			$view= 'week';
	    			$works = $this->myModel->findByDateTime('week');
	    			include 'app/view/index.php';
	    			exit();
	    		}else if($view == 'month'){
	    			$view= 'month';
	    			$works = $this->myModel->findByDateTime('month');
	    			include 'app/view/index.php';
	    			exit();
	    		}else{
	    			$view = 'date';
	    			$works = $this->myModel->findAll('work_name');
	    			include 'app/view/index.php';
	    			exit();
	    		}
	    	}

	    	// setting add work
	    	if(isset($_POST['submit_add'])){
	    		$work_name     = $_POST['work_name'];
	    		$starting_date = $_POST['starting_date'];
	    		$ending_date   = $_POST['ending_date'];
	    		$status        = $_POST['status'];

	    		if ($this->myModel->insert($work_name,$starting_date,$ending_date,$status) != true) {
	    			$msg = 'Created error!';
	    		}else{
	    			$msg = 'Created Success!';
	    		}
	    	}
	    	$view = 'date';
	    	$works = $this->myModel->findAll('work_name');
	    	include 'app/view/index.php';
	        
	    }

	    public function detailViewMonth()
	    {
	    	// view detail works in month
	    	if (isset($_GET['month']) && isset($_GET['year'])) {
	    		$month = $_GET['month'];
	    		$year = $_GET['year'];
	    		$works = $this->myModel->filterByDateTime(null,$month,$year,null);
	    		$view = 'date';
	    		include 'app/view/index.php';
	    		exit();

	    	// view detail works in week
	    	}else if (isset($_GET['week']) && isset($_GET['year'])) {
	    		$week = $_GET['week'];
	    		$year = $_GET['year'];
	    		$works = $this->myModel->filterByDateTime(null,null,$year,$week);
	    		$view = 'date';
	    		include 'app/view/index.php';
	    		exit();
	    	}

	    }


	    public function filterWorks()
	    {
	    	//filter work with date
	    	if (isset($_POST['filter_date'])) {
	    		$date = $_POST['date'];
	    		$works = $this->myModel->filterByDateTime($data,null,null,null);
	    		$view = 'date';
	    		include 'app/view/index.php';
	    		exit();

	    	//filter work with week
	    	}else if (isset($_POST['filter_week'])) {
	    		$date = $_POST['week'];
	    		$year = explode("-", $date)[0];
	    		$week = str_replace("W","",(explode("-", $date)[1]))-1;
	    		$works = $this->myModel->filterByDateTime(null,null,$year,$week);
	    		$view = 'date';
	    		include 'app/view/index.php';
	    		exit();

	    	//filter work with month
	    	}else if( isset($_POST['filter_month'])){
	    		$date = $_POST['month'];
	    		$year = explode("-", $date)[1];
	    		$month = explode("-", $date)[0];
	    		$works = $this->myModel->filterByDateTime(null,$month,$year,null);
	    		$view = 'date';
	    		include 'app/view/index.php';
	    		exit();
	    	}

	    }

	    // function update infomation work
	    public function edit()
	    {	
	    	if (isset($_GET['id'])) {
	    		$id = $_GET['id'];
	    		$works = $this->myModel->findById($id);
	    	}

	    	if(isset($_POST['submit_edit'])){
	    		$id 		   = $_POST['submit_edit'];
	    		$work_name     = $_POST['work_name'];
	    		$starting_date = $_POST['starting_date'];
	    		$ending_date   = $_POST['ending_date'];
	    		$status        = $_POST['status'];

	    		if ($this->myModel->edit($id,$work_name,$starting_date,$ending_date,$status) != true) {
	    			$msg = 'Editted error!';
	    		}else{
	    			$msg = 'Editted Success!';
	    		}

					
				$this->redirect('index.php');
	    	}
	    	
	    	include 'app/view/edit.php';
	    }

	    //function delete work
	    public function delete()
	    {
	    	if (isset($_GET['id'])) {
	    		$id = $_GET['id'];
	    		$works = $this->myModel->delete($id);
	    	}

	    	$this->redirect('index.php');
	    }
	}


?>