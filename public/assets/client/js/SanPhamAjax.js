const tenDoAn = "Web2";
let gdsp = document.getElementById("dsProducts");
let dsSoTrang = document.getElementById("soTrang");
const HOST_ROOT = document.getElementById("_HOST_ROOT").value;
console.log(HOST_ROOT);
const categories = document.getElementsByName("categories");
const categoryValues = [];
const brands = document.getElementsByName("brands");
const brandValues = [];
const sizes = document.getElementsByName("sizes");
const sizeValues = [];

const categoryCheckbox = document.querySelectorAll('input[name="categories"]');
for (var i = 0; i < categoryCheckbox.length; i++) {
  categoryCheckbox[i].addEventListener("change", filter);
}
const brandCheckbox = document.querySelectorAll('input[name="brands"]');
for (var i = 0; i < brandCheckbox.length; i++) {
  brandCheckbox[i].addEventListener("change", filter);
}
const sizeCheckbox = document.querySelectorAll('input[name="sizes"]');
for (var i = 0; i < sizeCheckbox.length; i++) {
  sizeCheckbox[i].addEventListener("change", filter);
}
function checkedCategories() {
  for (var i = 0; i < categories.length; i++) {
    if (categories[i].checked) {
      categoryValues.push(categories[i].value);
    }
  }
}
function checkedBrands() {
  for (var i = 0; i < brands.length; i++) {
    if (brands[i].checked) {
      brandValues.push(brands[i].value);
    }
  }
}
function checkSizes() {
  for (var i = 0; i < sizes.length; i++) {
    if (sizes[i].checked) {
      sizeValues.push(sizes[i].value);
    }
  }
}
function getValueofCheckBox() {
  categoryValues.splice(0, categoryValues.length);
  brandValues.splice(0, categoryValues.length);
  sizeValues.splice(0, sizeValues.length);
  checkedBrands();
  checkedCategories();
  checkSizes();
}

function printRadioSize(dsSizes) {
  let html = "";
  let defaultSize = 1;
  dsSizes.forEach((s) => {
    if (s.id == defaultSize) {
      html += `<label>
      <input type="radio" name="product__size" value="${s.id}" checked> ${s.name} 
      </label>`;
    } else {
      html +=
        `<label>
      <input type="radio" name="product__size" value="${s.id}">` +
        "  " +
        ` ${s.name}` +
        "  " +
        ` </label>`;
    }
  });
  return html;
}

function giaoDienSanPham(products, htmlSize) {
  var html = "";
  products.forEach(function (product) {
    html +=
      `<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
      <a class="link-product" href="${HOST_ROOT}/chi-tiet">
        <div class="product__item__pic set-bg" style="background-image: url('${HOST_ROOT}/uploads/${product.img}');"  >
          <ul class="product__hover">
            <li><a href="#"><img src="${HOST_ROOT}/public/assets/client/img/icon/heart.png" alt=""></a></li>
            <li><a href="#"><img src="${HOST_ROOT}/public/assets/client/img/icon/compare.png" alt=""> <span>Compare</span></a></li>
            <li><a href="#"><img src="${HOST_ROOT}/public/assets/client/img/icon/search.png" alt=""></a></li>
          </ul>
        </div>
      </a>
      <div class="product__item__text">
        <h6>${product.name}</h6>
        <a onclick="addToCart(event)" class="add-cart" data-product-id=${product.id}>+ Add To Cart</a>
        <div class="rating">
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
        </div>
        <h5>$${product.price}</h5>` +
      htmlSize +
      `
        
      </div>
    </div>
  </div>`;
  });
  gdsp.innerHTML = html;
}

function filter(vtt) {
  if (typeof vtt === "object") {
    vtt = "0";
  }
  const currentUrl = window.location.origin + "/" + tenDoAn;
  const relativeUrl = "/shop/filter";
  const fullUrl = currentUrl + relativeUrl;
  getValueofCheckBox(); //Lay gia tri cac checkBox
  const data = {
    trang: vtt,
    category: categoryValues,
    brand: brandValues,
    size: sizeValues,
  };
  console.log(fullUrl);

  fetch(fullUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      var products = data.ds;
      let htmlSize = printRadioSize(data.dsSize);
      giaoDienSanPham(products, htmlSize); //In ra giao dien San Pham
      var trang = data.soTrang;
      var htmlTrang = "";
      for (let i = 1; i <= trang; i++) {
        if (i == vtt + 1) {
          htmlTrang += `<a class="active" onclick="filter(${i - 1})">${i}</a>`;
        } else {
          htmlTrang += `<a  onclick="filter(${i - 1})">${i}</a>`;
        }
      }
      // console.log(data);
      // console.log(htmlTrang);
      dsSoTrang.innerHTML = htmlTrang;
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Giỏ Hàng
let addCart = document.querySelectorAll(".add-cart");
addCart.forEach(function (button) {
  button.addEventListener("click", addToCart);
});

function addToCart(event) {
  let productId = event.target.getAttribute("data-product-id");
  // let productAmount = event.target.getAttribute("data-product-amount");
  let productSizeInputs = event.target.parentNode.querySelectorAll(
    "[name='product__size']"
  );
  let productSize;
  productSizeInputs.forEach(function (input) {
    if (input.checked) {
      productSize = input.value;
    }
  });

  //fetch nè
  const currentUrl = window.location.origin + "/" + tenDoAn;
  const relativeUrl = "/cartcontroller/themVaoGio";
  const fullUrl = currentUrl + relativeUrl;

  const data = {
    idsp: productId,
    slm: 1,
    idSize: productSize,
  };

  fetch(fullUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {})
    .catch((error) => {
      console.error("Error:", error);
    });
}
