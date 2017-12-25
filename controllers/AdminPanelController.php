<?php
	class AdminPanelController extends Controller{
	
		public function display(){
			if(Session::isLoggedIn() > 1)
			{
				if(isset($_GET['loaded']))
					(new AdminPanelView(true))->render();
				else
					(new AdminPanelView(false))->render();
				}
			else if(Session::isLoggedIn() > 0)
			{
				header("Location: /?controller=main&action=display");
			}
			else
			{
				header("Location: /");
			}
		}
		public function loadSchedule()
		{
			if(empty($_POST['eventCode']))
			{
				header("Location: /?controller=admin&action=display");
			}
			else{
			(new MatchScheduleDatabaseModel())->loadSchedule($_POST['eventCode']);
			header("Location: /?controller=admin&action=display&loaded=true");
		}	

		//other loaded ranking,etc functions added here
	}

	}
   
    
    
?>
