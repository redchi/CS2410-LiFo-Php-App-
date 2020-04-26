<?php
Class RegisterView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>REGISTER VIEW!</h1>
					<br>
				<br>
                <form action = "'.URL."/UserInteraction".'" method = "POST">
                  <input type="text" name="username" placeholder ="username" required ><br><br>
                  <input type="text" name="email" placeholder ="email" required><br><br>
                  <input type="password"  name="password" placeholder ="password" required><br><br>
                  <input type="password" name="password2" placeholder ="confirm password" required><br><br>
                  <input type="hidden" name = "registerationAttempt" value ="">
                  <input type="submit" value="Submit">
                </form> 
                <br>

				<br>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>