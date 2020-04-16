<?php
Class ItemsTableView extends View{
    
    public function __construct(){
        //nothing
    }
    
    public function draw($data){
        parent::draw($data);
        $html = '
                <!DOCTYPE html>
                <html>
                <body>
            
                <h1>Main item list VIEW!</h1><br>
                           
            <table  border = "5">
            	<tbody>
            		<tr>
            			<td>Item Name </td>
            			<td>Category </td>
            			<td>Colour</td>
            			<td>Date Found </td>
            		</tr>
            		<tr>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            		</tr>
            		<tr>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            		</tr>
            		<tr>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            		</tr>
            		<tr>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            		</tr>
            		<tr>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            			<td> </td>
            		</tr>
            	</tbody>
            </table>








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