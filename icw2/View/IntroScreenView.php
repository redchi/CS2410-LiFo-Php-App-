<?php
Class IntroScreenView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>Lost and Found System!</h1>
                <form action = "./index.php" method = "POST">
					<input type=hidden name = "loginButtonClicked" value ="">
					<button type = "submit">Login</button>
				</form>
				<br>
				<form action = "./index.php" method = "POST">
					<input type=hidden name = "registerButtonClicked" value ="">
					<button type = "submit">Register</button>
				</form>
				<br>
				<form action = "./index.php" method = "POST">
					<input type=hidden name = "guestButtonClicked" value ="">
					<button type = "submit">Continue as guest</button>
				</form>
				<br>


                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>