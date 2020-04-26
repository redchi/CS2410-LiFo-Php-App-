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
                <form action = "'.URL.'/Login">
					<button type = "submit">Login</button>
				</form>
				<br>
				<form action = "'.URL.'/Register">				
					<button type = "submit">Register</button>
				</form>
                <br>
	               <form action = "'.URL.'/Home">				
					<button type = "submit">Continue as guest</button>
				</form>

                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>