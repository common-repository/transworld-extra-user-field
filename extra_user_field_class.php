<?php

if(!class_exists("User_Extra_Field")){
  class User_Extra_Field{

     function User_Extra_Field() {      }                          //construtor                                                                                                                              
     public function extra_user_field_options_page(){

             $user= get_current_user_id( );

        if( isset($_POST['extra_field']) ) {
        
             $name  = $_POST['name'];
             $value = $_POST['value'];
             $type  = $_POST['type'];
             $exp   = $_POST['exp'];
        
         if ($exp == NULL ){
                 $exp="default";
         } 
            
         if ( $exp == 'default' || preg_match($exp,$value) ) { 
                   
            
              if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }


             $extra_field= $name."|". $value."|".$type."|".$exp;

             $extra_field_array = array( );

             array_push($extra_field_array , $extra_field);

             $get_extra_field = get_usermeta($user,'extra_fields');

             $key="extra_fields";

                 if ( array_key_exists($name,$get_extra_field) ){

                        unset($get_extra_field['name']);

                    }



                 if ($get_extra_field == NULL ){

                         $value=$extra_field_array;
                    }
                 else
                         $value= array_merge($get_extra_field,$extra_field_array);



                         update_usermeta( $user, $key, $value );


                 if($type == "text"){
 
                        update_usermeta( $user, $name, $_POST['value'] );
                   }else 
                        update_usermeta( $user, $name, " " );
           
              }else {?>
                    <script>  alert("the value is invalidate by reqular expresion"); </script>
      <?php          } 

     }

 ?>

                      <h3><?php _e('Add Extra Field') ?></h3>

                                  <table class="form-table">

                                         <form method="post"  name="extra_user_field" action="">

                                                <tr>
                                                <th><label for="Name"><?php _e('Name') ?></label></th>
                                                <td><input type="text" name="name" id="name" value=" " class="regular-text"/></td>
                                                </tr>

                                                <tr>
                                                <th><label for="Value"><?php _e('Value') ?></label></th>
                                                <td><input type="text" name="value" id="value" value=" " class="regular-text" /></td>
                                                </tr>



                                                <tr>
                                                <th><label for="Type"><?php _e('Type') ?></label></th>
                                                <td>
                                                       <select name="type" id="type">
                                                           <option id="text" value="text">Text</option>
                                                           <option id="checkbox" value="checkbox">CheckBox</option>
                                                           <option id="radio" value="radio">Radio</option>
                                                           <option id="option" value="option">Option</option>
                                                       </select>
                                                </td>
                                                </tr>


                                                <tr>
                                                <th><label for="Expression"><?php _e('Expression') ?></label></th>
                                                <td><input type="text" name="exp" id="exp" value="" class="regular-text" />
                                                Enter the regular expression to validate user input. <br/>                                                                                                      <span style = "color:#FF0000"> Don't use comma Outside! </span>
                                                </td>
                                                </tr>


                                                <p class="submit">
                                                <input type="submit"  id="extra_field" name="extra_field" value="<?php _e('Add Extra User Field &raquo;') ?>" />
                                                </p>

                                         </form>


                                 </table>

<?php           
                }


          


      function extra_user_field_table_page(){ 
                    

              $user= get_current_user_id( );
              
              $get_extra_field = get_usermeta($user,'extra_fields');
            //  print_r($get_extra_field);    
                                 
                           if( isset($_POST['delete_extra_field']) ) {

                                  $dname  = $_POST['dname'];
                                  $dvalue = $_POST['dvalue'];
                                  $dtype  = $_POST['dtype'];
                                  $dexp   = $_POST['dexp'];


                                  echo $dvalue;

                                  $key_field= $dname."|". $dvalue."|".$dtype."|".$dexp;
 
                                  $key=array_search($key_field,$get_extra_field);
                                  echo $key;
                                  echo $key_field; 
                                  delete_usermeta( $user, $dname);
                                  unset($get_extra_field[$key]);
                                  update_usermeta( $user, "extra_fields", $get_extra_field);            
                            }
                          




                         if ($get_extra_field != NULL ) { ?>

                     
                               <table class="widefat post fixed" cellspacing="0">
                                       <thead>
                              	              <tr>
	                                          <th scope="col" id="name" class="manage-column column-name" style="">Name</th>
	                                          <th scope="col" id="value" class="manage-column column-value" style="">Value</th>
	                                          <th scope="col" id="type" class="manage-column column-type" style="">Type</th>
                                                  <th scope="col" id="type" class="manage-column column-type" style="">Action</th>  
                                              </tr>
                   	                </thead>
                               </table>

                              

                 <?php
                     //   for ($i=0; $i<count($get_extra_field); $i++) {
                           foreach ($get_extra_field as $field_value){                             

 
                            //  $get_extra_field_value = get_usermeta($user,$field_value);
                             // $get_extra_field_value = get_usermeta($user,$get_extra_field[$i]);
                                $extra_field = explode("|",$field_value);
                                $extra_field_value = get_usermeta($user,$extra_field[0]);
                             
                             // if($extra_field == NULL )
                                  // echo "continue";
                             //    continue;
 
                         
                 ?>
                           <table class="form-table">
                               <thead>  
                                     <tr>
                                         <th scope="col" id="name" class="manage-column column-name" style=""> 
                                            <?php _e($extra_field[0]); ?>
                                          </th>
                                        
                                          <th scope="col" id="name" class="manage-column column-name" style="">
                                            <?php _e($extra_field_value); ?>                                         
                                          </th>

                                           <th scope="col" id="name" class="manage-column column-name" style="">
                                            <?php _e($extra_field[2]); ?>
                                           </th>                                             
 
                                            <th scope="col" id="name" class="manage-column column-name" style="">
                                                 <form method="post"  name="extra_user_field" action="">
                                                    <?php 
                                                        echo "<input type = 'hidden' name = 'dname'  value = '".stripslashes($extra_field[0])."' />" ; 
                                                        echo "<input type = 'hidden' name = 'dvalue'  value = '".stripslashes($extra_field[1])."' />" ; 
                                                        echo "<input type = 'hidden' name = 'dtype'  value = '".stripslashes($extra_field[2])."' />" ; 
                                                        echo "<input type = 'hidden' name = 'dexp'  value = '".stripslashes($extra_field[3])."' />" ;        
                                                     ?>
                                                        <input type="submit"  id="delete_extra_field" name="delete_extra_field" value="<?php _e('Delete') ?>" />
                                                  </form>
                                            </th>
                                      </tr>
                                  </thead>
                              </table>

             <?php  
                              }
                               
                         }
                   
                 }

         }

}

 if (class_exists("User_Extra_Field")) {
               $user_extra_field = new User_Extra_Field();
          }

   ?>
