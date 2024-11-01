<?php
 function extra_user_profile_fields( ) {
     
     $user= get_current_user_id( );
     $get_extra_field = get_usermeta($user,'extra_fields');

           if ($get_extra_field != NULL ) { ?>
                      
                <h3><?php _e("Extra profile information", "blank"); ?></h3>

                      <?php
                                foreach ($get_extra_field as $field_value){
    
                                  $extra_field = explode("|",$field_value);
                                  $extra_field_value = get_usermeta($user,$extra_field[0]);
                       ?>

                                   <table class="form-table">
                                        <tr>
                                        <th><label for=<?php _e($extra_field[0]); ?> > <?php _e($extra_field[0]); ?></label></th>
                                        <td>

                                              <?php if($extra_field[2] == "checkbox"){

                                                     $checkbox = explode(",",$extra_field[1]);
                                                     foreach ($checkbox as $checkbox_value) { 

                                                        echo "<input type = $extra_field[2] name = $extra_field[0] id = $extra_field[0]) value = '".stripslashes($checkbox_value)."' > ".stripslashes($checkbox_value)." <br/> " ;                                   
                                                              } 
                                                             
                                                       }  
                                                    
                                                     if($extra_field[2] == "radio"){

                                                           $radio = explode(",",$extra_field[1]);
                                                           foreach ($radio as $radio_value) {
                                                           
                                                               echo "<input type = $extra_field[2] name = $extra_field[0] id = $extra_field[0]) value = '".stripslashes($radio_value)."' > ".stripslashes($radio_value)." <br/> " ; 

                                                                 }
                                                           }



                                                      if($extra_field[2] == "option"){

                                                                 $option = explode(",",$extra_field[1]); ?>
                                                                <select name = <?php _e($extra_field[0]); ?> >
                                                         
                                                           <?php        
                                                           foreach ($option as $option_value) { 
                                                            
                                                                    echo "<option  value = '".stripslashes($option_value)."' > ".stripslashes($option_value)." </option> " ;  
                                                                    }  ?>
                                                                 </select>
                                                           <?php  }
                                                        


                                                      if($extra_field[2] == "text" ) { 
                                                                 
                                                             echo "<input type = $extra_field[2] name = $extra_field[0] id = $extra_field[0]) value = '".stripslashes($extra_field_value)."' />" ;?> 

                                                   
                                                              <br/>

                                                  
                                                             <span class="description"><?php _e("Please enter your ".$extra_field[0]); ?></span>

                                                             
                                                     <?php   }   ?> 

                                             </td>
                                        </tr>
                                   </table>                           
                     <?php }

                  }
  
          }


 function save_extra_user_profile_fields(  ) { 
     $user= get_current_user_id( );
     $get_extra_field = get_usermeta($user,'extra_fields');

              if ($get_extra_field != NULL ) { 

                  foreach ($get_extra_field as $field_value){  
                                
                              $extra_field = explode("|",$field_value);

                                
                                if ($extra_field[3] == "default") {
                                    update_usermeta($user , $extra_field[0] , $_POST[$extra_field[0]]);
                              } else  if ( preg_match($extra_field[3],$_POST[$extra_field[0]])) {
                                    update_usermeta($user , $extra_field[0] , $_POST[$extra_field[0]]);
                         }
                                else  
                                    update_usermeta($user , $extra_field[0] , "Value is not validate by Regular Expression ");
                }

           } 
     
    }

?>
