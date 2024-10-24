<?php
    require '../config/function.php';
    $result = check_valid_ID('id');
    if(is_numeric($result)){
        $userId = validate($result);
        $user = getByID('NguoiDung','MaND',$userId);
        if($user['status'] == 200){
            $userDelete = deleteQuery('NguoiDung','MaND',$userId);
            if($userDelete){
                redirect('user.php','Xóa thành công');
            }
            else{
                redirect('user.php','Xóa thất bại');
            }
        }else{
            redirect('user.php',$result['message']);
        }
    }else{
        redirect('user.php',$result);
    }
?>