<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>
        <?php empty($msg) ? false : getMsg($msg,'danger') ?>
        <?php getMsg(Session::getFlashData('msg'),Session::getFlashData('msg_type'))?>
        <form action="<?php echo HOST_ROOT.'/AuthController/post_login' ?>" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input id="emailLogin" type="email" name="email" class="form-control" placeholder="Địa chỉ email..."
                    value="<?php empty($dataForm) ? false : getValueInput($dataForm,'email') ?>">
                <?php empty($errors) ? false : getMsgErr($errors,'email') ?>
            </div>

            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input id="passLogin" type="password" name="password" class="form-control" placeholder="Mật khẩu...">
                <?php empty($errors) ? false : getMsgErr($errors,'password') ?>
            </div>
            <button id="btnLogin" type="button" class="btn btn-primary btn-block">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/auth/forgot' ?>">Quên mật khẩu</a></p>
        </form>
    </div>
</div>
<script>
const tenDoAn = "Web2";
const HOST_ROOT = document.getElementById("_HOST_ROOT");


let emailLogin = document.getElementById("emailLogin")
let passLogin = document.getElementById("passLogin")
let btnLogin = document.getElementById("btnLogin")
btnLogin.addEventListener("click", login)

function login() {
    let email = emailLogin.value
    let pass = passLogin.value
    const currentUrl = window.location.origin + "/" + tenDoAn;
    const relativeUrl = "/AuthController/post_login";
    const fullUrl = currentUrl + relativeUrl;
    const data = {
        email: email,
        pass: pass,
    };
    fetch(fullUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                alert(data.error)
            } else {
                window.location.href = data.link;
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
</script>