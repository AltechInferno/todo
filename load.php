<?php 
require("controller/db.php");
                                        $history_query = mysqli_query($conn, "SELECT * FROM events"); 
                                        while($history = mysqli_fetch_array($history_query)){
                                          $main_id = $history['id']; 
                                            echo ' <tr>
                                            <td>'.$history['title'].'</td>
                                           <td class="nowrap">'.$history['description'].'</td>
                                         
                                           <td>'.$history['status'].'</td>
                                           <td>'.$history['start_event'].'</td>
                                           <td>'.$history['end_event'].'</td>
                                           <td>
                                           
                                           <select onchange="cc(this.value)"  name="changestatus" id="changestatus" class="nice_Select2 wide" data-rowId="'.$main_id.'">
                                                  <option>Change Status</option>
                                                  <option value="'.$history['id'].',failed">Failed</option>
                                                  <option value="'.$history['id'].',pending">Pending</option>
                                                  <option value="'.$history['id'].',completed">completed</option>
                                                </select>
                                            </td>
                                       </tr>';
                                        }
                                      ?>