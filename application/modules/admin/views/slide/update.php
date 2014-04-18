<style type="text/css">
    label{
        width: 150px;
        float: left;
    }
    span{
        color: red;
    }
</style>
<?php
/* Author: Nhu Thep
 * create at 25/03/2014
 * Form update user
 */
$id = $name = $email = $password = $confirmPass = $address = $phone = "";

$screen = 'edit';
$title = "Add";
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
<h1><?php echo $title; ?></h1>
<form name="f" id="f_user" enctype="multipart/form-data" method="post" action="<?php
    echo PATH . '/admin/user/saveUserUpdate';

?>">
    <label>Name : </label>
    <input type="text" name="name" value="<?php echo $name;  ?>"><span><?php echo $this->err['name'];  ?></span>
    <br/><br/>

    <label>Password : </label>
    <input type="password" name="password"><span> <?php echo $this->err['pass']; ?></span>
    <input type="hidden"  name="passwordCurent" value="<?php echo $password;  ?>">
    <br/><br/>

    <label>Confirm password : </label>
    <input type="password" name="confirmPass"><span><?php echo $this->err['confirmPass'];  ?></span>
    <br/><br/>

    <label>Email : </label>
    <input type="text" name="email" value="<?php echo $email;  ?>"><span><?php echo $this->err['email'];  ?></span>
    <br/><br/>

    <label>Address : </label>
    <input type="text" name="address" value="<?php echo $address;  ?>"><span><?php echo $this->err['address'];  ?></span>
    <br/><br/>

    <label>Phone : </label>
    <input type="text" value="<?php echo $phone;  ?>" name="phone"><span><?php echo $this->err['phone'];  ?></span>
    <br/><br/>
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
        <label>Avatar : </label>
        <img src="<?php echo PATH.'/upload/'.$image_url ?>"/><br/>
        <input type = "file" name = "avata">

    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input  type="submit" value="Update "> 
    
</form>