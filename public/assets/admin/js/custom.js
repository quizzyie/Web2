// xử lý slug
const toSlug = (str) => {
  str = str.toLowerCase();

  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/gi, "a");
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/gi, "e");
  str = str.replace(/ì|í|ị|ỉ|ĩ/gi, "i");
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/gi, "o");
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/gi, "u");
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/gi, "y");
  str = str.replace(/đ/gi, "d");
  // Some system encode vietnamese combining accent as individual utf-8 characters
  // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
  str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/gi, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
  str = str.replace(/\u02C6|\u0306|\u031B/gi, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
  // Remove extra spaces
  // Bỏ các khoảng trắng liền nhau
  str = str.replace(/ + /gi, " ");
  str = str.trim();
  // Remove punctuations
  // Bỏ dấu câu, kí tự đặc biệt
  str = str.replace(
    /!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/gi,
    ""
  );
  str = str.trim();
  str = str.replace(/ /gi, "-");
  str = str.replace(/-+-/gi, "-");
  return str;
};

let nameService = document.querySelector(".name-service");
let slug = document.querySelector(".slug");
if (nameService && slug) {
  nameService.onkeyup = (e) => {
    slug.value = toSlug(e.target.value);
  };
}

let renderLink = document.querySelector(".render-link");
if (renderLink) {
  renderLink.querySelector(
    "span"
  ).innerHTML = `<a href="${urlRoot}" target="_blank">${urlRoot}</a>`;
}

// CKEDITOR.replace('editor');
// xử lý ckeditor
let editors = document.querySelectorAll(".editor");
if (editors) {
  editors.forEach((item, index) => {
    item.id = `editor_${index + 1}`;
    let editor = CKEDITOR.replace(item.id);
    CKFinder.setupCKEditor(editor);
  });
}

const openPopup = (item) => {
  let parent = item.parentElement;
  while (!parent.classList.contains("ckfinder-group") && parent) {
    parent = parent.parentElement;
  }
  let imageRender = parent.querySelector(".image-render");
  CKFinder.popup({
    chooseFiles: true,
    width: 800,
    height: 600,
    onInit: function (finder) {
      finder.on("files:choose", function (evt) {
        let fileUrl = evt.data.files.first().getUrl();
        let arr_url = fileUrl.split('/uploads/');
        imageRender.value = arr_url[arr_url.length - 1];
        //Xử lý chèn link ảnh vào input
      });
      finder.on("file:choose:resizedImage", function (evt) {
        let fileUrl = evt.data.resizedUrl;
        //Xử lý chèn link ảnh vào input
      });
    },
  });
};

let chooseImages = document.querySelectorAll(".choose-image");
if (chooseImages) {
  chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
}

let galleryItem = `<div class="gallery-item mb-2">
<div class="row ckfinder-group">
    <div class="col-9">
        <input type="text" name="gallery[]" placeholder="Hình ảnh..." class="form-control image-render" > 
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
    </div>
    <div class="col-1">
        <button onclick="return confirm('Bạn có thực sự muốn xóa?')" type="button" class="btn btn-danger btn-block delete-image"><i class="fa fa-trash"></i></button>
    </div>
</div>
</div>`;

const handleBtnDelete = (galleryGroup, classBtnDelete, itemDelete) => {
  let btnDelete = galleryGroup.querySelectorAll(`.${classBtnDelete}`);
  if (btnDelete) {
    btnDelete.forEach(
      (item) =>
      (item.onclick = () => {
        if (confirm("Bạn có thực sự muốn xóa?")) {
          let parent = item.parentElement;
          while (!parent.classList.contains(itemDelete)) {
            parent = parent.parentElement;
          }
          parent.remove();
        }
      })
    );
  }
};

let galleryGroup = document.querySelector(".gallery-group");
if (galleryGroup) {
  let btnAddImage = document.querySelector(".gallery-add-img");
  if (btnAddImage) {
    btnAddImage.onclick = () => {
      let galleryItemNode = new DOMParser()
        .parseFromString(galleryItem, "text/html")
        .querySelector(".gallery-item");
      galleryGroup.appendChild(galleryItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(galleryGroup, "delete-image", "gallery-item");
    };
  }
  handleBtnDelete(galleryGroup, "delete-image", "gallery-item");
}

let slideItem = `<div class="slide">
<div class="form-group">
    <label for="">Tên slide</label>
    <input type="text" name="name[]" placeholder="Tên slide..." class="form-control" >
</div>
<div class="form-group">
    <label for="">Nội dung</label>
    <textarea class="editor" class="form-control" placeholder="Nội dung..." name="content[]" ></textarea>
</div>
<div class="row">
    <div class="col-6">
    <div class="form-group">
    <label for="">Tên nút nhấn</label>
    <input type="text" name="btn_name[]" placeholder="Tên nút nhấn..." class="form-control">
     </div>
    </div>
    <div class="col-6">
    <div class="form-group">
    <label for="">Link video</label>
    <input type="text" name="link_video[]" placeholder="Link video..." class="form-control">
</div>
    </div>
</div>
<div class="row">
    <div class="col-6">
    <div class="form-group">
    <label for="">Hình ảnh 1</label>
    <div class="row ckfinder-group">
        <div class="col-10">
            <input type="text" name="image_1[]" placeholder="Hình ảnh 1..." class="form-control image-render" >
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
        </div>
    </div>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
    <label for="">Hình ảnh 2</label>
    <div class="row ckfinder-group">
        <div class="col-10">
            <input type="text" name="image_2[]" placeholder="Hình ảnh 2..." class="form-control image-render" >
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-upload"></i></button>
        </div>
    </div>
    </div>
    </div>
</div>
<div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Hình nền</label>
                            <div class="row ckfinder-group">
                                <div class="col-10">
                                    <input type="text" name="backgroud_image[]" placeholder="Hình nền..."
                                        class="form-control image-render" >
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success btn-block choose-image"><i
                                            class="fas fa-upload"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Vị trí hình ảnh</label>
                            <select class="form-control" name="positon_image[]" id="">
                                <option value="left">Bên trái</option>
                                <option value="right">Bên phải</option>
                                <option value="center">Ở giữa</option>
                            </select>
                        </div>
                    </div>
                </div>
<button type="submit" class="btn btn-danger delete-slide">Hủy</button>
<hr>
</div>
</div>`;

let slideGroup = document.querySelector(".group-slide");
if (slideGroup) {
  let btnAddSlide = document.querySelector(".btn-add-slide");
  if (btnAddSlide) {
    btnAddSlide.onclick = () => {
      let slideItemNode = new DOMParser()
        .parseFromString(slideItem, "text/html")
        .querySelector(".slide");
      slideGroup.appendChild(slideItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(slideGroup, "delete-slide", "slide");
    };
  }
  handleBtnDelete(slideGroup, "delete-slide", "slide");
}

let contactItem = `<div class="evaluate">
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <input name="range_name[]" type="text" class="form-control" placeholder="Tên đánh giá...">
        </div>
    </div>
    <div class="col-5">
        <div class="form-group">
            <input class="form-control range" id="range" type="text" name="range[]" value="">
        </div>
    </div>
    <div class="col-1">
        <button class="btn btn-danger delete-evaluate"><i class="fas fa-trash"></i></button>
    </div>
</div>
</div>`;

let evaluateGroup = document.querySelector(".group-evaluate");
if (evaluateGroup) {
  let btnAddEvaluate = document.querySelector(".btn-add-evaluate");
  if (btnAddEvaluate) {
    btnAddEvaluate.onclick = (e) => {
      e.preventDefault();
      let evaluatetItemNode = new DOMParser()
        .parseFromString(contactItem, "text/html")
        .querySelector(".evaluate");
      evaluateGroup.appendChild(evaluatetItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(evaluateGroup, "delete-evaluate", "evaluate");
      $(".range").ionRangeSlider({
        min: 0,
        max: 100,
        type: "single",
        step: 1,
        postfix: "%",
        prettify: false,
        hasGrid: true,
      });
    };
  }
  handleBtnDelete(evaluateGroup, "delete-evaluate", "evaluate");
}

$(".range").ionRangeSlider({
  min: 0,
  max: 100,
  type: "single",
  step: 1,
  postfix: "%",
  prettify: false,
  hasGrid: true,
});

let partnerItem = `<div class="row partner">

<div class="col-6">
    <div class="form-group">
        <div class="row ckfinder-group">
            <div class="col-10">
                <input type="text" name="image[]" placeholder="Logo..." class="form-control image-render"
                    >
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-success btn-block choose-image"><i
                        class="fas fa-upload"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="col-5">
    <div class="form-group">
        <input type="text" name="link[]" placeholder="Link ..." class="form-control" />
    </div>
</div>
<div class="col-1">
    <button class="btn btn-danger delete-partner"><i class="fas fa-trash"></i></button>
</div>
</div>`;

let partnerGroup = document.querySelector(".group-partner");
if (partnerGroup) {
  let btnAddPartner = document.querySelector(".btn-add-partner");
  if (btnAddPartner) {
    btnAddPartner.onclick = (e) => {
      e.preventDefault();
      let partnerItemNode = new DOMParser()
        .parseFromString(partnerItem, "text/html")
        .querySelector(".partner");
      partnerGroup.appendChild(partnerItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(partnerGroup, "delete-partner", "partner");
    };
  }
  handleBtnDelete(partnerGroup, "delete-partner", "partner");
}

// xử lý quicklink
let quicklinkItem = `<div class="row quicklink">

<div class="col-6">
    <div class="form-group">
        <input type="text" name="name_quicklink[]" placeholder="Tên đường dẫn ..." class="form-control"
            >
    </div>
</div>
<div class="col-5">
    <div class="form-group">
        <input type="text" name="link_quicklink[]" placeholder="Đường dẫn ..." class="form-control" >
    </div>
</div>
<div class="col-1">
    <button class="btn btn-danger delete-quicklink"><i class="fas fa-trash"></i></button>
</div>
</div>`;

let quicklinkGroup = document.querySelector(".group-quicklink");
if (quicklinkGroup) {
  let btnAddquicklink = document.querySelector(".btn-add-quicklink");
  if (btnAddquicklink) {
    btnAddquicklink.onclick = (e) => {
      e.preventDefault();
      let quicklinkItemNode = new DOMParser()
        .parseFromString(quicklinkItem, "text/html")
        .querySelector(".quicklink");
      quicklinkGroup.appendChild(quicklinkItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(quicklinkGroup, "delete-quicklink", "quicklink");
    };
  }
  handleBtnDelete(quicklinkGroup, "delete-quicklink", "quicklink");
}

// xử lý quicklink 2
let quicklink2Item = `<div class="row quicklink2">

<div class="col-6">
    <div class="form-group">
        <input type="text" name="name_quicklink2[]" placeholder="Tên đường dẫn ..." class="form-control"
            >
    </div>
</div>
<div class="col-5">
    <div class="form-group">
        <input type="text" name="link_quicklink2[]" placeholder="Đường dẫn ..." class="form-control" >
    </div>
</div>
<div class="col-1">
    <button class="btn btn-danger delete-quicklink2"><i class="fas fa-trash"></i></button>
</div>
</div>`;

let quicklink2Group = document.querySelector(".group-quicklink2");
if (quicklink2Group) {
  let btnAddquicklink2 = document.querySelector(".btn-add-quicklink2");
  if (btnAddquicklink2) {
    btnAddquicklink2.onclick = (e) => {
      e.preventDefault();
      let quicklink2ItemNode = new DOMParser()
        .parseFromString(quicklink2Item, "text/html")
        .querySelector(".quicklink2");
      quicklink2Group.appendChild(quicklink2ItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(quicklink2Group, "delete-quicklink2", "quicklink2");
    };
  }
  handleBtnDelete(quicklink2Group, "delete-quicklink2", "quicklink2");
}

// xử lý thêm image
let imageItem = `<div class="image">
<div class="row">
    <div class="col-10">
        <div class="form-group">
            
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="image[]" placeholder="Hỉnh ảnh..."
                        class="form-control image-render" value="">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image"><i
                            class="fas fa-upload"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
    <button class="btn btn-danger btn-block delete-image"><i class="fas fa-trash"></i></button>
    </div>
    
</div>
</div>
`;

let imageGroup = document.querySelector(".group-image");
if (imageGroup) {
  let btnAddimage = document.querySelector(".btn-add-image");
  if (btnAddimage) {
    btnAddimage.onclick = (e) => {
      e.preventDefault();
      let imageItemNode = new DOMParser()
        .parseFromString(imageItem, "text/html")
        .querySelector(".image");
      imageGroup.appendChild(imageItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(imageGroup, "delete-image", "image");
    };
  }
  handleBtnDelete(imageGroup, "delete-image", "image");
}

async function getSize() {
  let url_module = document.querySelector('.url_module_size').value;
  let response = await fetch(url_module);
  let jsonData = await response.json();
  console.log(jsonData);
  const group_select = document.querySelectorAll('.select-form');
  group_select.forEach(item => {
    if (!item.classList.contains('select-fill')) {
      item.innerHTML = jsonData;
      item.classList.add('select-fill');
    }
  });
}

let sizeItem = `<div class="size">
<div class="row">
    <div class="col-10">
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <select name="size[]" class="select-form form-control">
                    
                    <option  value='0'>Vui lòng chọn kích thước</option>
                    
                    </select>
                </div>
                <div class="col-6">
                    <input type="text" name="quantity[]" class="form-control" placeholder="Nhập vào số lượng" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
    <button class="btn btn-danger btn-block delete-size"><i class="fas fa-trash"></i></button>
    </div>
    
</div>
</div>
`;

let sizeGroup = document.querySelector(".group-size");
if (sizeGroup) {
  let btnAddsize = document.querySelector(".btn-add-size");
  if (btnAddsize) {
    btnAddsize.onclick = (e) => {
      e.preventDefault();
      let sizeItemNode = new DOMParser()
        .parseFromString(sizeItem, "text/html")
        .querySelector(".size");
      sizeGroup.appendChild(sizeItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(sizeGroup, "delete-size", "size");
      getSize();
    };
  }
  handleBtnDelete(sizeGroup, "delete-size", "size");
}



let account_twitterItem = `
<div class="account_twitter">
<br />
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="text" name="name_account_twitter[]" placeholder="Tên tài khoản ..."
                class="form-control" >
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Đường dẫn</label>
            <input type="text" name="link_account_twitter[]" placeholder="Đường dẫn ..."
                class="form-control" >
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">Mô tả tài khoản</label>
    <input type="text" name="des_account_twitter[]" placeholder="Mô tả tài khoản..."
        class="form-control" >
</div>

<button class="btn btn-danger delete-account_twitter"><i class="fas fa-trash"></i></button>
</div>
`;

let account_twitterGroup = document.querySelector(".group-account_twitter");
if (account_twitterGroup) {
  let btnAddaccount_twitter = document.querySelector(
    ".btn-add-account_twitter"
  );
  if (btnAddaccount_twitter) {
    btnAddaccount_twitter.onclick = (e) => {
      e.preventDefault();
      let account_twitterItemNode = new DOMParser()
        .parseFromString(account_twitterItem, "text/html")
        .querySelector(".account_twitter");
      account_twitterGroup.appendChild(account_twitterItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(
        account_twitterGroup,
        "delete-account_twitter",
        "account_twitter"
      );
    };
  }
  handleBtnDelete(
    account_twitterGroup,
    "delete-account_twitter",
    "account_twitter"
  );
}

let ourteamItem = `<div class="ourteam">
<br>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">Tên thành viên</label>
            <input type="text" name="name[]" placeholder="Tên thành viên ..." class="form-control" value="">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Chức vụ</label>
            <input type="text" name="position[]" placeholder="Chức vụ ..." class="form-control" value="">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="image[]" placeholder="Hỉnh ảnh..."
                        class="form-control image-render" value="">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image"><i
                            class="fas fa-upload"></i></button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-1">
    <button class="btn btn-danger delete-ourteam"><i class="fas fa-trash"></i></button>
</div>

<hr>
</div>`;

let ourteamGroup = document.querySelector(".group-ourteam");
if (ourteamGroup) {
  let btnAddourteam = document.querySelector(".btn-add-ourteam");
  if (btnAddourteam) {
    btnAddourteam.onclick = (e) => {
      e.preventDefault();
      let ourteamItemNode = new DOMParser()
        .parseFromString(ourteamItem, "text/html")
        .querySelector(".ourteam");
      ourteamGroup.appendChild(ourteamItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      handleBtnDelete(ourteamGroup, "delete-ourteam", "ourteam");
    };
  }
  handleBtnDelete(ourteamGroup, "delete-ourteam", "ourteam");
}

let advertiseItem = `<div class="advertise">
<br>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="">Tiêu đề nhỏ</label>
            <input type="text" name="title[]" placeholder="Tiêu đề nhỏ ..." class="form-control" value="">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="">Tiêu để lớn</label>
            <input type="text" name="header[]" placeholder="Tiêu để lớn ..." class="form-control" value="">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="">Hình ảnh</label>
            <div class="row ckfinder-group">
                <div class="col-10">
                    <input type="text" name="image[]" placeholder="Hỉnh ảnh..."
                        class="form-control image-render" value="">
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success btn-block choose-image"><i
                            class="fas fa-upload"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">Mô tả quảng cáo</label>
    <textarea name="description[]" placeholder="Mô tả sản phẩm" class="editor" cols="30"
        rows="10"></textarea>
</div>
<div class="col-1">
    <button class="btn btn-danger delete-advertise"><i class="fas fa-trash"></i></button>
</div>

<hr>
</div>`;

let advertiseGroup = document.querySelector(".group-advertise");
if (advertiseGroup) {
  let btnAddadvertise = document.querySelector(".btn-add-advertise");
  if (btnAddadvertise) {
    btnAddadvertise.onclick = (e) => {
      e.preventDefault();
      let advertiseItemNode = new DOMParser()
        .parseFromString(advertiseItem, "text/html")
        .querySelector(".advertise");
      advertiseGroup.appendChild(advertiseItemNode);
      let chooseImages = document.querySelectorAll(".choose-image");
      if (chooseImages) {
        chooseImages.forEach((item) => (item.onclick = () => openPopup(item)));
      }
      let editors = document.querySelectorAll(".editor");
      if (editors) {
        editors.forEach((item, index) => {
          item.id = `editor_${index + 1}`;
          let editor = CKEDITOR.replace(item.id);
          CKFinder.setupCKEditor(editor);
        });
      }
      handleBtnDelete(advertiseGroup, "delete-advertise", "advertise");
    };
  }
  handleBtnDelete(advertiseGroup, "delete-advertise", "advertise");
}


// xử lý phân trang
let groupBtnPage;

async function fetchData(page) {
  let data = new URLSearchParams();
  data.append('page', page);
  data.append('keyword', document.querySelector('.keyword') ? document.querySelector('.keyword').value : "");
  data.append('status', document.querySelector('.status') ? document.querySelector('.status').value : "");
  data.append('group_id', document.querySelector('.group_id') ? document.querySelector('.group_id').value : "");
  data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id').value : "");
  data.append('brand_id', document.querySelector('.brand_id') ? document.querySelector('.brand_id').value : "");
  data.append('phone', document.querySelector('.phone') ? document.querySelector('.phone').value : "");
  data.append('fromDate', document.querySelector('.fromDate') ? document.querySelector('.fromDate').value : "");
  data.append('toDate', document.querySelector('.toDate') ? document.querySelector('.toDate').value : "");
  data.append('sort_by', document.querySelector('.sort_by') ? document.querySelector('.sort_by').value : "");
  data.append('email', document.querySelector('.email') ? document.querySelector('.email').value : "");
  data.append('star', document.querySelector('.star') ? document.querySelector('.star').value : "");
  data.append('product_id', document.querySelector('.product_id') ? document.querySelector('.product_id').value : "");
  data.append('type', document.querySelector('.type') ? document.querySelector('.type').value : "");

  let url_module = document.querySelector('.url_module').value + '/phan_trang';

  let response = await fetch(url_module, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: data.toString()
  })
  let jsonData = await response.json();
  // console.log(jsonData);
  // console.log(123);
  document.querySelector('.fetch-data-table').innerHTML = jsonData; // outputs an array of user objects
  groupBtnPage = document.querySelectorAll('.btn-page');
  groupBtnPage.forEach(item => {
    if (item.textContent != page) {
      item.classList.remove('active');
    } else {
      item.classList.add('active');
    }
  })
  if (document.querySelector('.btn-pre')) {

    document.querySelector('.btn-pre').onclick = (e) => {
      e.preventDefault();
      if (page == 1) {
        page++;
      }
      fetchData(page - 1);
    }
  }
  if (document.querySelector('.btn-next')) {

    document.querySelector('.btn-next').onclick = (e) => {
      e.preventDefault();
      if (page == document.querySelector('.max-page').value) {
        page--;
      }
      fetchData(parseInt(page) + 1);
    }
  }

  if (document.querySelector('.btn-search')) {
    document.querySelector('.btn-search').onclick = async function () {
      await fetchPagination(1);
      await fetchData(1);
    }

  }
}

async function fetchPagination(page) {
  let data = new URLSearchParams();
  data.append('page', page);
  data.append('keyword', document.querySelector('.keyword') ? document.querySelector('.keyword').value : "");
  data.append('status', document.querySelector('.status') ? document.querySelector('.status').value : "");
  data.append('group_id', document.querySelector('.group_id') ? document.querySelector('.group_id').value : "");
  data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id').value : "");
  data.append('brand_id', document.querySelector('.brand_id') ? document.querySelector('.brand_id').value : "");
  data.append('phone', document.querySelector('.phone') ? document.querySelector('.phone').value : "");
  data.append('fromDate', document.querySelector('.fromDate') ? document.querySelector('.fromDate').value : "");
  data.append('toDate', document.querySelector('.toDate') ? document.querySelector('.toDate').value : "");
  data.append('sort_by', document.querySelector('.sort_by') ? document.querySelector('.sort_by').value : "");
  data.append('email', document.querySelector('.email') ? document.querySelector('.email').value : "");
  data.append('star', document.querySelector('.star') ? document.querySelector('.star').value : "");
  data.append('product_id', document.querySelector('.product_id') ? document.querySelector('.product_id').value : "");
  data.append('type', document.querySelector('.type') ? document.querySelector('.type').value : "");

  let url_module = document.querySelector('.url_module').value + '/pagination';

  let response = await fetch(url_module, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: data.toString()
  })
  let jsonData = await response.json();

  document.querySelector('.fetch-pagination').innerHTML = jsonData; // outputs an array of user objects
  groupBtnPage = document.querySelectorAll('.btn-page');
  groupBtnPage.forEach(item => {
    item.onclick = (e) => {
      e.preventDefault();
      let page = item.textContent;
      fetchData(page);
    }
  })
  if (document.querySelector('.btn-pre')) {

    document.querySelector('.btn-pre').onclick = (e) => {
      e.preventDefault();
      if (page == 1) {
        page++;
      }
      fetchData(page - 1);
    }
  }
  if (document.querySelector('.btn-next')) {

    document.querySelector('.btn-next').onclick = (e) => {
      e.preventDefault();
      if (page == document.querySelector('.max-page').value) {
        page--;
      }
      fetchData(parseInt(page) + 1);
    }
  }

  if (document.querySelector('.btn-search')) {
    document.querySelector('.btn-search').onclick = async function () {
      await fetchPagination(1);
      await fetchData(1);
    }

  }

}

if (document.querySelector('.url_module')) {
  fetchPagination(1)
  fetchData(1)
}

function generateRandomColor() {
  let maxVal = 0xFFFFFF; // 16777215
  let randomNumber = Math.random() * maxVal;
  randomNumber = Math.floor(randomNumber);
  randomNumber = randomNumber.toString(16);
  let randColor = randomNumber.padStart(6, 0);
  return `#${randColor.toUpperCase()}`
}

async function fetchChartCircle() {

  let data = new URLSearchParams();
  data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id')
    .value :
    "");
  data.append('fromDate', document.querySelector('.fromDate') ? document.querySelector('.fromDate')
    .value :
    "");
  data.append('toDate', document.querySelector('.toDate') ? document.querySelector('.toDate')
    .value :
    "");
  let host_root = "";
  if (document.querySelector('.url_hoot_root')) {
    host_root = document.querySelector('.url_hoot_root').value;
  }
  let response = await fetch(host_root + '/admin/statistics/fetchData', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: data.toString()
  })
  let jsonData = await response.json();
  var barColors = [];
  var xValues = [];
  var yValues = [];
  console.log(jsonData);
  let total = 0;
  jsonData.forEach(element => {
    barColors.push(generateRandomColor());
    xValues.push(element['name']);
    yValues.push(element['so_luong'] ? element['so_luong'] : 0);
    total += element['so_luong'] ? parseInt(element['so_luong']) : 0;
  });

  new Chart("myChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues,
      },],
    },
    options: {
      title: {
        display: true,
        text: "Theo danh mục sản phẩm : " + total,
      },
    },
  });
}

fetchChartCircle();

var resetCanvas = function () {
  $('#myChart').remove(); // this is my <canvas> element
  $('.container-content').append(
    '<canvas id="myChart" style="width: 50%; max-width: 600px"></canvas>'
  );
  $('#myChart2').remove(); // this is my <canvas> element
  $('.container-content-2').append(
    '<canvas id="myChart2"></canvas>'
  );
};

if (document.querySelector(".btn-thongke")) {
  document.querySelector(".btn-thongke").onclick = () => {
    resetCanvas();
    fetchChartCircle();
    fetchChartBar();
    fetchSmallBoxs();
    fetchPagination(1)
    fetchData(1)
  }
}




async function fetchChartBar() {
  let data = new URLSearchParams();
  data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id')
    .value :
    "");
  data.append('fromDate', document.querySelector('.fromDate') ? document.querySelector('.fromDate')
    .value :
    "");
  data.append('toDate', document.querySelector('.toDate') ? document.querySelector('.toDate')
    .value :
    "");

  let host_root = "";
  if (document.querySelector('.url_hoot_root')) {
    host_root = document.querySelector('.url_hoot_root').value;
  }
  let response = await fetch(host_root + '/admin/statistics/fetchDataChartBar', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: data.toString()
  })
  let jsonData = await response.json();
  console.log(jsonData);

  // document.querySelector('.bill_quantity').innerHTML = jsonData['bill_quantity'];
  // document.querySelector('.bill_quantity_cancel').innerHTML = (jsonData['bill_quantity_cancel'] * 100 / jsonData['bill_quantity'])+'%';
  // document.querySelector('.new_users').innerHTML = jsonData['new_users'];
  // document.querySelector('.total_revenue').innerHTML = jsonData['total_revenue'];
  const ctx = document.getElementById('myChart2');

  let arrLabel = [];
  let arrData = [];
  let total = 0;
  jsonData['arr_month'].forEach(element => {
    arrLabel.push(element['col']);
    arrData.push(element['value'] ? element['value'] : 0);
    total += parseInt(element['value']);
  });

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: arrLabel,
      datasets: [{
        label: '# quantity products : ' + total,
        data: arrData,
        borderWidth: 1,
        min: 0,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

fetchChartBar();

async function fetchSmallBoxs() {
  let data = new URLSearchParams();
  data.append('category_id', document.querySelector('.category_id') ? document.querySelector('.category_id')
    .value :
    "");
  data.append('fromDate', document.querySelector('.fromDate') ? document.querySelector('.fromDate')
    .value :
    "");
  data.append('toDate', document.querySelector('.toDate') ? document.querySelector('.toDate')
    .value :
    "");

  let host_root = "";
  if (document.querySelector('.url_hoot_root')) {
    host_root = document.querySelector('.url_hoot_root').value;
  }

  let response = await fetch(host_root + '/admin/statistics/fetchSmallBoxs', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: data.toString()
  })
  let jsonData = await response.json();
  console.log(jsonData);

  document.querySelector('.bill_quantity').innerHTML = jsonData['bill_quantity'];
  document.querySelector('.bill_quantity_cancel').innerHTML = jsonData['bill_quantity'] ? (Math.round(jsonData['bill_quantity_cancel'] * 100 / jsonData['bill_quantity'])) + '%' : "0%";
  document.querySelector('.new_users').innerHTML = jsonData['new_users'];
  document.querySelector('.total_revenue').innerHTML = jsonData['total_revenue'] ? jsonData['total_revenue'] : 0;

}

fetchSmallBoxs();

