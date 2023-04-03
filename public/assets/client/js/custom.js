const onOutsideLogin = (event) => {
    const ignoreClickOnMeElement = document.querySelector(".form-main-login");
    const isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    if (!isClickInsideElement) {
        offForm();
    }
};

const onOutsideRegister = (event) => {
    const ignoreClickOnMeElement = document.querySelector(".form-main-register");
    const isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    if (!isClickInsideElement) {
        offForm();
    }
};

const onOutsideForgot = (event) => {
    const ignoreClickOnMeElement = document.querySelector(".form-main-forgot");
    const isClickInsideElement = ignoreClickOnMeElement.contains(event.target);
    if (!isClickInsideElement) {
        offForm();
    }
};


const resetFormLogin = () => {
    const form = document.querySelector(".container-form-login");
    const showErr = form.querySelector('.alert-danger');
    showErr.textContent = "";
    showErr.classList.add('hidden');
    let inputs = document.querySelectorAll('.container-form-login .form-control');
    let errors = document.querySelectorAll('.container-form-login .error');
    inputs.forEach(item => item.value = "");
    errors.forEach(item => item.textContent = "");
}
const resetFormRegister = () => {
    const form = document.querySelector(".container-form-register");
    const showErr = form.querySelector('.alert-danger');
    showErr.textContent = "";
    showErr.classList.add('hidden');
    let inputs = document.querySelectorAll('.container-form-register .form-control');
    let errors = document.querySelectorAll('.container-form-register .error');
    inputs.forEach(item => item.value = "");
    errors.forEach(item => item.textContent = "");
}

const resetFormForgot = () => {
    const form = document.querySelector(".container-form-forgot");
    const showErr = form.querySelector('.alert-danger');
    showErr.textContent = "";
    showErr.classList.add('hidden');
    let inputs = document.querySelectorAll('.container-form-forgot .form-control');
    let errors = document.querySelectorAll('.container-form-forgot .error');
    inputs.forEach(item => item.value = "");
    errors.forEach(item => item.textContent = "");
}

const onFormLogin = () => {
    const form = document.querySelector(".container-form-login");
    form.classList.add("active");
    form.querySelector('.email').focus();
};
const onFormRegister = () => {
    const form = document.querySelector(".container-form-register");
    form.classList.add("active");
    form.querySelector('.fullname').focus();
};

const onFormForgot = () => {
    const form = document.querySelector(".container-form-forgot");
    form.classList.add("active");
};


const offForm = () => {
    const formLogin = document.querySelector(".container-form-login");
    formLogin.classList.remove("active");
    const formRegister = document.querySelector(".container-form-register");
    formRegister.classList.remove("active");
    const formForgot = document.querySelector(".container-form-forgot");
    formForgot.classList.remove("active");
};

const onLogin = () => {
    resetFormLogin()
    offForm();
    onFormLogin();
};

const onRegister = () => {
    resetFormRegister()
    offForm();
    onFormRegister();
};

const onForgot = () => {
    resetFormForgot()
    offForm();
    onFormForgot();
};

async function checkLogin() {
    const form = document.querySelector(".container-form-login");
    const showErr = form.querySelector('.alert-danger');
    const email = form.querySelector('.email').value.trim();
    const password = form.querySelector('.password').value;
    let validate = true;

    if (!email) {
        form.querySelector('.error-email').textContent = "Vui lòng nhập email!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        form.querySelector('.error-email').textContent = "Email không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else {
        form.querySelector('.error-email').textContent = "";
    }

    if (!password) {
        form.querySelector('.error-password').textContent = "Vui lòng nhập mật khẩu!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else if (password.length < 6) {
        form.querySelector('.error-password').textContent = "Mật khẩu ít nhất 6 kí tự!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else {
        form.querySelector('.error-password').textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('email', email);
        data.append('password', password);
        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/auth/post_login", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);
        if (jsonData['check']) {
            offForm();
            alert("Đăng nhập thành công!");
            location.reload();
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        }
    } else {
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu nhập vào";
        showErr.classList.remove('hidden');
    }
}


const checkRegister = async () => {
    const form = document.querySelector(".container-form-register");
    const showErr = form.querySelector('.alert-danger');
    const fullname = form.querySelector('.fullname').value.trim();
    const email = form.querySelector('.email').value.trim();
    const phone = form.querySelector('.phone').value.trim();
    const password = form.querySelector('.password').value;
    const confirm_password = form.querySelector('.confirm_password').value;
    let validate = true;
    if (!fullname) {
        form.querySelector('.error-fullname').textContent = "Vui lòng nhập họ tên!";
        if (validate) {
            validate = false;
            form.querySelector('.fullname').focus();
        }
    } else if (fullname.length < 6) {
        form.querySelector('.error-fullname').textContent = "Họ tên ít nhất 6 kí tự!";
        if (validate) {
            validate = false;
            form.querySelector('.fullname').focus();
        }
    } else {
        form.querySelector('.error-fullname').textContent = "";
    }

    if (!email) {
        form.querySelector('.error-email').textContent = "Vui lòng nhập email!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        form.querySelector('.error-email').textContent = "Email không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else {
        form.querySelector('.error-email').textContent = "";
    }

    if (!phone) {
        form.querySelector('.error-phone').textContent = "Vui lòng nhập số điện thoại!";
        if (validate) {
            validate = false;
            form.querySelector('.phone').focus();
        }
    } else if (!/(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b/.test(phone)) {
        form.querySelector('.error-phone').textContent = "Số điện thoại không hợp lệ không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.phone').focus();
        }
    } else {
        form.querySelector('.error-phone').textContent = "";
    }

    if (!password) {
        form.querySelector('.error-password').textContent = "Vui lòng nhập mật khẩu!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else if (password.length < 6) {
        form.querySelector('.error-password').textContent = "Mật khẩu ít nhất 6 kí tự!";
        if (validate) {
            validate = false;
            form.querySelector('.password').focus();
        }
    } else {
        form.querySelector('.error-password').textContent = "";
    }

    if (!confirm_password) {
        form.querySelector('.error-confirm_password').textContent = "Vui lòng xác nhận mật khẩu!";
        if (validate) {
            validate = false;
            form.querySelector('.confirm_password').focus();
        }
    } else if (confirm_password != password) {
        form.querySelector('.error-confirm_password').textContent = "Mật khẩu nhập lại không trùng khớp!";
        if (validate) {
            validate = false;
            form.querySelector('.confirm_password').focus();
        }
    } else {
        form.querySelector('.error-confirm_password').textContent = "";
    }

    if (validate) {
        showErr.textContent = "Vui lòng đợi...";
        showErr.classList.remove('hidden');
        let data = new URLSearchParams();
        data.append('fullname', fullname);
        data.append('email', email);
        data.append('phone', phone);
        data.append('password', password);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/auth/post_register", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        if (jsonData['check']) {
            resetFormRegister();
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        }
    } else {
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu nhập vào";
        showErr.classList.remove('hidden');
    }
}

const checkForgot = async () => {
    const form = document.querySelector(".container-form-forgot");
    const showErr = form.querySelector('.alert-danger');
    const email = form.querySelector('.email').value.trim();
    let validate = true;

    if (!email) {
        form.querySelector('.error-email').textContent = "Vui lòng nhập email!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        form.querySelector('.error-email').textContent = "Email không hợp lệ!";
        if (validate) {
            validate = false;
            form.querySelector('.email').focus();
        }
    } else {
        form.querySelector('.error-email').textContent = "";
    }

    if (validate) {
        showErr.textContent = "Vui lòng đợi...";
        showErr.classList.remove('hidden');
        let data = new URLSearchParams();
        data.append('email', email);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/auth/post_forgot", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        if (jsonData['check']) {
            resetFormForgot();
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        }
    } else {
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu nhập vào";
        showErr.classList.remove('hidden');
    }
}

const onLogout = async () => {
    if (confirm("Bạn có chắc chắn muốn đăng xuất!")) {
        let data = new URLSearchParams();
        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/auth/logout", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        location.reload();
    }
}

const handleSubcribe = async (event) => {
    document.querySelector('.success-subcribe').textContent = "";
    event.preventDefault();
    let subcribe = document.querySelector('.subcribe').value;
    let validate = true;
    if (!subcribe) {
        document.querySelector('.error-subcribe').textContent = "Vui lòng nhập vào email!";
        validate = false;
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(subcribe)) {
        document.querySelector('.error-subcribe').textContent = "Email không hợp lệ!";
        validate = false;
    } else {
        document.querySelector('.error-subcribe').textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('email', subcribe);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/contact/subcribe", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        document.querySelector('.error-subcribe').textContent = "";
        document.querySelector('.success-subcribe').textContent = jsonData['msg'];
        document.querySelector('.subcribe').value = "";
    }
}

const sendMessage = async (event) => {
    event.preventDefault();
    let showErr = document.querySelector('.alert-contact');
    let name = document.querySelector('.name-contact').value;
    let email = document.querySelector('.email-contact').value;
    let message = document.querySelector('.message').value;
    console.log(message);

    let validate = true;
    if (!name) {
        document.querySelector('.error-name-contact').textContent = "Vui lòng nhập vào họ tên!";
        validate = false;
    } else if (name.length < 6) {
        document.querySelector('.error-name-contact').textContent = "Họ tên ít nhất 6 kí tự!";
        validate = false;
    } else {
        document.querySelector('.error-name-contact').textContent = "";
    }

    if (!email) {
        document.querySelector('.error-email-contact').textContent = "Vui lòng nhập vào email!";
        validate = false;
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        document.querySelector('.error-email-contact').textContent = "Email không hợp lệ!";
        validate = false;
    } else {
        document.querySelector('.error-email-contact').textContent = "";
    }

    if (!message) {
        document.querySelector('.error-message').textContent = "Vui lòng nhập vào lời nhắn!";
        validate = false;
    } else if (message.length < 10) {
        document.querySelector('.error-message').textContent = "Lời nhắn ít nhất 10 kí tự!";
        validate = false;
    } else {
        document.querySelector('.error-message').textContent = "";
    }

    if (validate) {
        let data = new URLSearchParams();
        data.append('name', name);
        data.append('email', email);
        data.append('message', message);

        let host_root = "";
        if (document.querySelector('.url_hoot_root')) {
            host_root = document.querySelector('.url_hoot_root').value;
        }
        let response = await fetch(host_root + "/contact/send", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data.toString()
        })
        let jsonData = await response.json();
        console.log(jsonData);

        document.querySelector('.name-contact').value = "";
        document.querySelector('.email-contact').value = "";
        document.querySelector('.message').value = "";
        if (jsonData['check']) {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        } else {
            showErr.textContent = jsonData['msg'];
            showErr.classList.remove('hidden');
        }

    } else {
        showErr.classList.remove('hidden');
        showErr.textContent = "Vui lòng kiểm tra lại dữ liệu!";
    }
}

