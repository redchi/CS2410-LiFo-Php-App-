<?php
Class AddItemDetailsView extends View{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function draw($data){
        parent::draw($data);
        $category = $data["Category"];
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
            
                <h1> ADD Item view!</h1>
			    <br>             
                </h3>

            <form action ="/UserInteraction" method = "POST">
        
        	<input type="text" placeholder="item name" name="name" required><br>
        	 <input list="colours" name="colour" placeholder="colour" required><br>
        					<datalist id="colours">
        							 <option value="Red">
        							<option value="Orange">
        							<option value="Yellow">
        							<option value="Green">
        							<option value="Blue">
        							<option value="Purple">
        							<option value="Brown">
        							<option value="Magenta">
        							<option value="Tan">
        							<option value="Cyan">
        							<option value="Olive">
        							<option value="Maroon">
        							<option value="Navy">
        							<option value="Aquamarine">
        							<option value="Turquoise">
        							<option value="Silver">
        							<option value="Lime">
        							<option value="Teal">
        							<option value="Indigo">
        							<option value="Violet">
        							<option value="Pink">
        							<option value="Black">
        							<option value="White">
        							<option value="Gray">
        					</datalist>
        	   <input type="text" placeholder="Location Found" name="location" required><br>
        	   <input type="date"  name="date" required><br>
        	  <input type="text" placeholder=" Item Description" name="description" required><br>
        	  <br>
              <input type="hidden" name = "Category" value ="'.$category.'">
        	  <input type="hidden" name = "addItem" value ="">
        	  <input type="submit" value="Submit">
        	  
              </form> 

                    
                    
                </body>
                </html>
                    
        ';
        
        
        echo $html;
    }
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
?>