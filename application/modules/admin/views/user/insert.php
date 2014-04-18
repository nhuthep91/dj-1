<style type="text/css">
    label{
        width: 150px;
        float: left;
    }
</style>
<?php
/**
 * Author: Nhu Thep
 * create at 25/03/2014
 * Form update user
 */
$id = $name = $email = $password = $confirmPass = $address = $phone = "";
$level = 1;
$screen = 'add';
$title = "Add User";
if (isset($this->screen)) {
    $screen = $this->screen;
    if ($screen == 'edit') {
        $data = $this->aryData;
        $id = $data['user_id'];
        $name = $data['full_name'];
        $email = $data['email'];
        $password = $data['password'];
        $address = $data['address'];
        $phone = $data['phone'];
        $level = $data['level'];
        $title = "Update User";
    }
}
?>
<h1><?php echo $title; ?></h1>
<form name="f" id="f_user" enctype="multipart/form-data" method="post" action="<?php
if ($screen == 'add') {
    echo PATH . '/admin/user/saveUser';
} else {
    echo PATH . '/admin/user/saveUserUpdate';
}
?>">

    <label>Name : </label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>"><?php echo isset($this->err['name']) ? $this->err['name'] : ''; ?>
    <span id="errName"></span>
    <br/><br/>

    <label>Password : </label>
    <input type="password" id="password" name="password">
    <input type="hidden"  name="passwordCurent" value="<?php echo $password; ?>">
    <span id="errPassword"></span>
    <br/><br/>

    <label>Confirm password : </label>
    <input type="password" id="confirmPassword" name="confirmPass"><?php echo isset($this->err['confirmPass']) ? $this->err['confirmPass'] : ''; ?>
    <span id="errconfirmPassword"></span>
    <br/><br/>

    <label>Email : </label>
    <input type="text" id="email" onchange="UserController.checkmail('email');" name="email" value="<?php echo $email; ?>"><?php echo isset($this->err['email']) ? $this->err['email'] : ''; ?>
    <span id="errEmail"></span>
    <br/><br/>

    <label>Address : </label>
    <input type="text" id="address" name="address" value="<?php echo $address; ?>"><?php echo isset( $this->err['address']) ? $this->err['address'] : ''; ?>
    <span id="errAddress"></span>
    <br/><br/>

    <label>Phone : </label>
    <input type="text" id="phone" value="<?php echo $phone; ?>" name="phone"><?php echo isset($this->err['phone']) ? $this->err['phone'] : ''; ?>
    <span id="errPhone"></span>
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
            echo 'selected="selected"';
        ?>>
            Member
        </option>
    </select>
    <br/><br/>
    <label>Avatar : </label>
    <input type="file" name="avatar">

    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <?php
    if ($this->screen == "add") {
        ?>  
        <input  type="submit" onclick="return UserController.checkForm();" value=" Thêm "> 
    <?php } elseif ($this->screen == "edit") {
        ?>
        <input  type="submit" value="Update "> 
        <?php
    }
    ?>
</form>