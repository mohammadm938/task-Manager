<?php

include_once "db.php";

class user extends db
{
    protected $tbl = 'user';

    public function login($data)
    {
        $name = $data['name'];
        $password = $data['password'];

        $this->setTbl($this->tbl);
        $user_data = $this->searchData('name', $name);
        if (password_verify($password, $user_data->password)) {
            session_start();
            $_SESSION['name'] = $user_data->name;
            $_SESSION['id'] = $user_data->id;
            header("location:index.php");
        } else {
            echo "<script>alert('اطلاعات نادرست میباشد');</script>";
        }
    }

    public function logout()
    {
        session_destroy();
        header("location:index.php");
    }

    public function signUp($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $options = [
            'cost' => 11,
        ];
        // Get the password from post
        $password = $data['password'];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        $phone = $data['phone'];

        $this->setTbl($this->tbl);
        $user_data_cheak_name = $this->searchData('name', $name);
        $user_data_cheak_email = $this->searchData('email', $email);
        $user_data_cheak_phone = $this->searchData('phone', $phone);
        if (is_bool($user_data_cheak_name) == false) {
            echo "<script>alert('این نام کاربری موجود میباشد لطفا یک نام کاربری دیگر انتخاب کنید');</script>";
        } else if (is_bool($user_data_cheak_email) == false) {
            echo "<script>alert('این ایمیل موجود میباشد لطفا یک ایمیل دیگر انتخاب کنید');</script>";
        } else if (is_bool($user_data_cheak_phone) == false) {
            echo "<script>alert('این شماره تلفن موجود میباشد لطفا یک شماره تلفن دیگر انتخاب کنید');</script>";
        } else {
            $this->insertData(['name', 'email', 'phone', 'password'], [$name, $email, $phone, $password]);
            $user_data = $this->searchData('name', $name);
            session_start();
            $_SESSION['name'] = $user_data->name;
            $_SESSION['id'] = $user_data->id;
            header("location:index.php");
        }
    }
}
