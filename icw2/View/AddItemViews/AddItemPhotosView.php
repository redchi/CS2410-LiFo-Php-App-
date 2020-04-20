<?php
Class AddItemPhotosView extends View{
    
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
            
                <h1> ADD Item  PHOTO view!</h1>
			    <br>
                </h3>
            
  

                 <form method ="POST" enctype="multipart/form-data">
                    <input type = "file" name="uploadedImage">
                    <input type="hidden" name = "Category" value ="'.$category.'">
                    <input type="hidden" name = "itemPhotosUploadRequest" value ="uploadedImage">
                    <button type = "sumbit"> upload</button>
                  </form>
                    <br>



                <form method ="POST" enctype="multipart/form-data">
                    <input type = "file" name="images[]" multiple
                    <input type="hidden" name = "Category" value ="'.$category.'">
                    <input type="hidden" name="itemPhotosUploadRequest" value="images">
                    <button type = "submit"> upload</button>
                </form>

                <br>
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