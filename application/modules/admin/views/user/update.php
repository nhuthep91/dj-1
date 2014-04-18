<style type="text/css">
    label{
        width: 200px; padding-left: 10px;
        float: left;
    }
    #title{
        padding-left: 450px; font-size: 24px; color: #8330FF; font-style: italic;
    }
    .updateImg{ padding-left: 20px;}

    span{
        color: red;
    }
    td{border:none; width: 550px}
    table{margin: 0px;  border-collapse:collapse}
</style>
<?php
/* Author: Nhu Thep
 * create at 25/03/2014
 * Form update user
 */
$id = $name = $email = $password = $confirmPass = $address = $phone = "";

$screen = 'edit';
$page = $_GET['page'];
$title = "Update User";
if (isset($this->screen)) {

        $data = $this->aryData;
        $id = $data['user_id'];
        $name = $data['full_name'];
        $email = $data['email'];
        $password = $data['password'];
        $address = $data['address'];
        $phone = $data['phone'];
        $level = $data['level'];
        $image_url = $data['avatar'];
}
?>
<span id="title"><?php echo $title; ?></span><hr/><br/>

<table>
<form name="f" id="f_user" enctype="multipart/form-data" method="post" action="<?php
    echo PATH . '/admin/user/saveUserUpdate';

?>">
    <tr>
        <td>
            <label>Name : </label>
            <input type="text" name="name" value="<?php echo $name;  ?>"><span><?php echo $this->err['name'];  ?></span>
            <br/><br/><br/>

            <label>Password : </label>
            <input type="password" name="password"><span> <?php echo $this->err['pass']; ?></span>
            <input type="hidden"  name="passwordCurent" value="<?php echo $password;  ?>">
            <br/><br/><br/>

            <label>Confirm password : </label>
            <input type="password" name="confirmPass"><span><?php echo $this->err['confirmPass'];  ?></span>
            <br/><br/><br/>
                <label>Avatar : </label>
            <img src="<?php echo PATH.'/upload/'.$image_url ?>"  width="80px" height="80px" /><br/><br/><br/>
            <input type = "file" name = "avata" class="updateImg">

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <input  type="submit" value="Update " > 
    

        </td>
        <td>
             <label>Email : </label>
            <input type="text" name="email" value="<?php echo $email;  ?>"><span><?php echo $this->err['email'];  ?></span>
            <br/><br/><br/>

            <label>Address : </label>
            <input type="text" name="address" value="<?php echo $address;  ?>"><span><?php echo $this->err['address'];  ?></span>
            <br/><br/><br/>

            <label>Phone : </label>
            <input type="text" value="<?php echo $phone;  ?>" name="phone"><span><?php echo $this->err['phone'];  ?></span>
            <br/><br/><br/>

             <label>Level : </label>
            <select name="level">
                <option value="1"  <?php
            if ($level == 1)
                echo 'selected="selected"';
            ?>>
                        Admin
            </option>
            <option value="2"  <?php
                if ($level == 2)
                    echo 'selected="selected"';?>>
                Member
                </option>
                </select>
                <br/><br/>
        </td>
    </tr>

    </form>
</table>
    
   
   
        
