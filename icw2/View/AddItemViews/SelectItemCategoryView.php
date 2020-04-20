<?php
Class SelectItemCategoryView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        
        //         $user = $data["user"];
        //         $item = $data["item"];
        
        //         $itemName = $item->Name;
        //         $itemType = $item->Category;
        //         $userID = $user->UserID;
        //         $itemID = $item->ItemID;
        
        
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1> select  Item  CAT  view!</h1>
			    <br>
                </h3>
            
      
                <form action = "./index.php" method="Post">
                         <p>Category:</p>
                         <select name="Category">
                            <option value="Pet">Pet</option>
                            <option value="Phone">Phone</option>
                            <option value="Jewllery">Jewllery</option>
                         </select>

                        <input type=hidden name = "itemCategorySelected" value ="">
                        <button type = "submit">submit</button>
                    </form>




                <form action = "./index.php" method = "POST">
                	<input type=hidden name = "backButtonClicked" value ="">
                	<button type = "submit">back</button>
                </form>
            
            
                </body>
                </html>
            
        ';
        
        
        echo $html;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>