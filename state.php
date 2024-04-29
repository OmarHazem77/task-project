                                              <!-- task complete -->
                                              <?php
                                                $id = $_GET['id'];
                                                $state = $_GET['state'];



                                                include 'connect.php';


                                                if ($state == 0) {
                                                    // لو الاستيت اللى جايالى ب زيرو ف انا عايز احدثها بواحد  يعنى حدثلى جدول التاسك و خليلى الاستيت بواحد بحيث ان الايدى يساوى الايدى اللى جاى فى الرابط 
                                                    $stmt = $conn->prepare("UPDATE tasks set state =1 WHERE id = '$id'");
                                                    $stmt->execute();
                                                } else {
                                                    $stmt = $conn->prepare("UPDATE tasks set state =0 WHERE id = '$id'");
                                                    $stmt->execute();
                                                }
                                                // الفانكشن دى وظيفتها انها بعد ما بتخلص البروسيس بتاعتى بترجعنى ع الصفحه المشار عليها تانى 
                                                header("location:task.php");


                                                     // task end //