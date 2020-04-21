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
                <form action = "./index.php" method = "POST">
                  <input type="text" name="username" placeholder ="username" required ><br><br>
                  <input type="text" name="email" placeholder ="email" required><br><br>
                  <input type="password"  name="password" placeholder ="password" required><br><br>
                  <input type="password" name="password2" placeholder ="confirm password" required><br><br>
                  <input type="hidden" name = "registerationAttempt" value ="">
                  <input type="submit" value="Submit">
                </form> 
                <br>




                    <form action = "./index.php" method = "POST">
					<input type=hidden name = "backButtonClicked" value ="">
					<button type = "submit">back</button>
				<form>
				<br>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>