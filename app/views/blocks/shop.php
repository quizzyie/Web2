<!-- Breadcrumb Section Begin -->
<style>

.shop__sidebar__price .field{
    height: 45px;
    width: 100%;
    display: flex;
    align-items: center;


}
.shop__sidebar__price .separator{
    width: 60px;
    display: flex;
   height: 1px;
    align-items: center;
    justify-content: center;
    background-color: #999;
}
.field input{
    width: 100%;
    height: 100%;
    outline: none;
    font-size:16px;
    text-align:center;
    /* margin-left:12px; */
    border-radius:5px;
    border:1px solid #999;
    -moz-appearance: textfield;
}
input[type="number"]::-webkit-inner-spin-button, input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.collapse{
    margin:12px 0;
}
.slider{
    height: 5px;
    border-radius:5px;
    background: #ddd;
    position: relative;

}
.slider .progress{
    height: 5px;
    left: 25%;
    right: 25%;
    position: absolute;
    border-radius: 5px;
    background-color: #17A2B8;
}
.range-input{
    position: relative;
}
.range-input input{
    position: absolute;
    width: 100%;
    height: 5px;
    top: -5px;
    background: none;
    pointer-events: none;
    -webkit-appearance: none;
}
input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    height: 17px;
    width: 17px;
    pointer-events: auto;
    border-radius: 50%;
    background: #17A2B8;

}
input[type="range"]::-moz-rang-thumb {
    -moz-appearance: none;
    height: 17px;
    width: 17px;
    border: none;
    pointer-events: auto;
    border-radius: 50%;
    background: #17A2B8;

}
</style>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">

                        <input id="search" type="text" placeholder="Search...">
                        <button onclick="filter()" type="button"><span class="icon_search"></span></button>

                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div id="CategoryList" class="shop__sidebar__categories">

                                            <?php foreach($dsCategories as $l): ?>

                                            <input type="checkbox" name="categories" value="<?php echo $l['id'] ?>">
                                            <label><?php echo $l['name'] ?></label>
                                            <br>
                                            <?php endforeach ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div id="BrandList" class="shop__sidebar__brand">
                                            <?php foreach($dsBrands as $th): ?>
                                            <input type="checkbox" name="brands" value="<?php echo $th['id'] ?>">
                                            <label><?php echo $th['name'] ?></label>
                                            <br>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                       <div class="shop__sidebar__price" style="display: flex;
                                                            width: 100%;  justify-content: center;
                                                                align-items: center;">

                                            <div class="field">

                                                <input type="number" class="input-min" value="2500">
                                            </div>
                                            <div class="separator"></div>
                                            <div class="field">
                                                <input type="number" class="input-max" value="7500">
                                            </div>
                                        </div>
                                    </div>
                                      <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="10000" value="2500" step ="100"  >
                                        <input type="range" class="range-max" min="0" max="10000" value="7500" step ="100"  >
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div id="SizeList" class="shop__sidebar__size">
                                            <?php foreach($dsSizes as $s): ?>
                                            <label><?php echo $s['name'] ?>
                                                <input type="checkbox" name="sizes" value="<?php echo $s['id'] ?>">
                                            </label>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">



                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select id="sort" onchange="filter()">
                                    <option value="1">Low To High</option>
                                    <option value="2">High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dsProducts" class="row">
                    <?php 
                        foreach($dsProducts as $sp): 
                        $linkImage = HOST_ROOT .'/uploads/'.$sp['img'];
                    ?>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?php echo $linkImage ?>"
                                style="background-image: url('<?php echo $linkImage ?>');">
                                <ul class="product__hover">
                                    <li><a href="#"><img
                                                src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/heart.png"
                                                alt=""></a></li>
                                    <li><a href="#"><img
                                                src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/compare.png"
                                                alt=""> <span>Compare</span></a>
                                    </li>
                                    <li><a href="#"><img
                                                src="<?php echo HOST_ROOT ?>/public/assets/client/img/icon/search.png"
                                                alt=""></a></li>
                                </ul>

                            </div>
                            <div class="product__item__text">
                                <h6><?php echo $sp['name'] ?></h6>
                                <a href="detail?idsp=<?php echo $sp['id'] ?>"
                                    data-product-id="<?php echo $sp['id'] ?>">+ SEE DETAIL</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$<?php echo $sp['price'] ?></h5>
                            </div>
                        </div>
                    </div>

                    <?php endforeach?>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="soTrang" class="product__pagination">
                            <?php for($i=1;$i<=$soTrang;$i++):
                                $vt = $i-1;?>
                            <?php if($vt==0):?>
                            <a onclick="filter( <?php echo $vt ?>)" class="active">
                                <?php echo $i ?> </a>
                            <?php endif ?>
                            <?php if($vt!=0):?>
                            <a onclick="filter(<?php echo $vt ?>)"> <?php echo $i ?>
                            </a>
                            <?php endif?>
                            <?php endfor ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
<!-- Shop Section End -->
<script>
    const rangeInput = document.querySelectorAll(".range-input input");
    let priceInput = document.querySelectorAll(".shop__sidebar__price input");
    let progress = document.querySelector(".slider .progress")
    let priceGap = 1000;
    priceInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minVal = parseInt(priceInput[0].value);
            let maxVal = parseInt(priceInput[1].value);

           if((maxVal-minVal>=priceGap)&&maxVal<=10000){
                if(e.target.className ==="input-min"){
                    rangeInput[0].value = minVal;
                    progress.style.left = (minVal/rangeInput[0].max)*100 + "%";
                }else{
                    rangeInput[1].value = maxVal;
                    progress.style.right = 100-(maxVal/rangeInput[1].max)*100 + "%";
                }
           }


        });
        input.addEventListener("blur",()=>{
            let minVal = parseInt(priceInput[0].value);
            let maxVal = parseInt(priceInput[1].value);
            let minValue = document.querySelector(".input-min");
            let maxValue = document.querySelector(".input-max");
            if(maxVal-minVal<priceGap){
                maxVal= minVal+priceGap;
                rangeInput[1].value = maxVal;
                maxValue.value = maxVal;
                progress.style.right = 100-(maxVal/rangeInput[1].max)*100 + "%";
            }
            if(minVal<0){
                minVal=0;
                rangeInput[0].value = minVal;
                minValue.value = minVal;
                progress.style.left = (minVal/rangeInput[0].max)*100 + "%";
            }
            if(maxVal>10000){
                maxVal=10000;
                rangeInput[1].value = maxVal;
                maxValue.value = maxVal;
                progress.style.right = 100-(maxVal/rangeInput[1].max)*100 + "%";
            }
        })
    });

    rangeInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minVal = parseInt(e.target.parentElement.children[0].value);
            let maxVal = parseInt(e.target.parentElement.children[1].value);

           if(maxVal-minVal <priceGap){
                if(e.target.className ==="range-min"){
                    rangeInput[0].value = maxVal-priceGap;
                }else{
                    rangeInput[1].value = minVal+priceGap;
                }
           }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            progress.style.left = (minVal/rangeInput[0].max)*100 + "%";
            progress.style.right = 100-(maxVal/rangeInput[1].max)*100 + "%";
           }



        });
    });
</script>