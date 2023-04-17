<?php
if (!defined('_INCODE')) die('Access Deined...');
?>

<style>
    .modal_form {
    background: linear-gradient(#e66465, #9198e5); 
    height: 100%
    } 

    .btn-grad {
        background-image: linear-gradient(to right, #ff6e7f 0%, #bfe9ff  51%, #ff6e7f  100%);
        /* margin: 10px; */
        padding: 10px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;            
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
        border-color: transparent;
    }
    
    .btn-grad:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
        border-color: transparent;
    }
    
    .form-group input{
        color: rgba(0,0,0,.87);
        border-bottom-color: rgba(0,0,0,.42);
        font-size: 1rem;
        font-weight: 400;
        letter-spacing: .009375em;
        text-decoration: inherit;
        text-transform: inherit;
        align-self: flex-end;
        box-sizing: border-box;
        width: 100%;
        padding: 20px 16px 6px;
        transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        border-bottom: 1px solid;
        border-radius: 4px 4px 0 0;
        background: rgb(245, 245, 245);
        height: 56px;
    }
    
    .form-group input:focus {
        border-color: #6200ee;
    }
    
    .form-group input:hover{
        border-bottom-color: rgba(0,0,0,.87);
        background: #ececec;
    }

    .form-content {
        margin-left: 15px; 
        margin-right: 15px;
    }

    .form-body {
        margin: 20px auto; 
        box-shadow: 1px 1px 3px #e0e0e0; 
        padding: 20px; 
        background-color: #FFF; 
        border-radius: 5px;
    }
</style>

<div class="modal_form">
    <div class="modal_body">
        <div class="row form-content" >
            <div class="col-6 form-body">
                <h3 class="text-center text-uppercase" style="color: rgba(0,0,0,0.7)">Đăng nhập hệ thống</h3>
                <?php empty($msg) ? false : getMsg($msg,'danger') ?>
                <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type'))?>
                <form action="<?php echo HOST_ROOT.'/admin/auth/post_login' ?>" method="post">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Địa chỉ email..."
                            value="<?php empty($dataForm) ? false : getValueInput($dataForm,'email') ?>">
                        <?php empty($errors) ? false : getMsgErr($errors,'email') ?>
                    </div>
        
                    <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu...">
                        <?php empty($errors) ? false : getMsgErr($errors,'password') ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-grad">Đăng nhập</button>
                    <hr>
                    <p class="text-center"><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/auth/forgot' ?>">Quên mật khẩu</a></p>
                </form>
            </div>
        </div>
    </div>
</div>