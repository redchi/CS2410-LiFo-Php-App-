<?php
Class RequestDetailsView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $requestObj = $data["request"];
        
        $itemObj = $requestObj["item"];
        $userObj = $requestObj["user"];
        $requestObj = $requestObj["request"];
    
        $itemName = $itemObj->Name;
        
        $requestDesc = $requestObj->Description;
        $requestID = $requestObj->RequestID;
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>REQUEST DETAILS VIEW</h1>

    
                 <h3>item name = '.$itemName.'<br>
                    request description = '.$requestDesc.'
                

                    </h3>
                
                <br>
				<form action = "/UserInteraction" method = "POST">
					<input type=hidden name = "approveRequest" value ="'.$requestID.'">
					<button type = "submit">Approve</button>
				</form>
                <br>
				<form action = "/UserInteraction" method = "POST">
					<input type=hidden name = "denyRequest" value ="">
					<button type = "submit">Deny</button>
				</form>
				<br>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
}
?>