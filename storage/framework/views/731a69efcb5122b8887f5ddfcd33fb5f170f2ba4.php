<?php $__env->startSection('panel'); ?>

<?php $__env->startPush('style'); ?>
<link id="themeColors" rel="stylesheet" href="<?php echo e(asset('assets/assets/dist/css/product.min.css')); ?>" />
<?php $__env->stopPush(); ?>
 <!--Contents-->
    <!-- Listing Grid View -->
    <section class="py-24" data-aos="fade-up">
      <div class="container">

      <div class="card position-relative overflow-hidden">
        <div class="shop-part d-flex w-100">
          <div class="shop-filters flex-shrink-0 border-end d-none d-lg-block"
          style="float:left;
          overflow-y: auto;
          height: 1000px;"
          >

            <ul class="list-group pt-2 border-bottom rounded-0">
              <h6 class="my-3 mx-4 fw-semibold"><?php echo app('translator')->get('Sort Country'); ?></h6>
              <div class="pb-4 px-4">
                <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check fw-normal py-8 d-flex align-items-center gap-2 mb-0">
                  <input value="<?php echo e($data->isoName); ?>" data-iso="<?php echo e($data->isoName); ?>" onchange="fetch_data(10,1)" class="form-check-input p-2" type="radio" name="country" id="flexRadioDefault<?php echo e($key); ?>" checked>
                  <label class="form-check-label" for="flexRadioDefault<?php echo e($key); ?>"><?php echo e($data->name); ?></label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </ul>

            <div class="p-4">
              <a href="" class="btn btn-primary w-100"><?php echo app('translator')->get('Reset Filters'); ?></a>
            </div>
          </div>
          <div class="card-body p-4 pb-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="d-lg-none d-flex">
                <select id="country" onchange="fetch_data(10,1)" class="selectpicker show-tick">
                  <option><?php echo app('translator')->get('Filter By Country'); ?></option>
                  <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option data-iso="<?php echo e($data->isoName); ?>"><?php echo e($data->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block" id="total_products"><?php echo app('translator')->get('Products'); ?></h5>
              <form class="position-relative">
                <input type="text" class="form-control search-chat py-2 ps-5" id="brandname" onkeyup="fetch_data(10,1)" placeholder="Search Product">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
              </form>
            </div>
            <div id="mylist"></div>

                <div id="page_container"> </div>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                </div>

          </div>

        </div>
      </div>
    </div>
    </section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php echo $__env->make($activeTemplate . 'partials.loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>

var total_records = 10000;
var perpage = 10;
var total_pages = Math.round(total_records / perpage);

$(document).ready(function(){
	var pagenum = 1;
    //createpagination(pagenum);
	fetch_data(perpage,pagenum);
});



function createpagination(pagenum){
		$("#page_container").html("");

		if(pagenum == 1){
			$("#page_container").append("<button class='btn btn-light-secondary btn-sm text-secondary font-medium disabled active'><<</button>");
		}else{
			$("#page_container").append("<button class='btn btn-light-secondary btn-sm text-secondary font-medium' onclick='makecall("+(pagenum-1)+")'>>></button>");
		}

		var i=0;
		for(i=0; i <= 10; i++){
			if(pagenum == (pagenum+i)){
				$("#page_container").append("<button class='btn btn-light-secondary btn-sm text-secondary font-medium' onclick='makecall("+(pagenum-1)+")'>"+(pagenum+i)+"</button>");
			}else{
				if((pagenum+i)<=total_pages){
            $("#page_container").append("<button class='btn btn-light-secondary btn-sm text-secondary font-medium' onclick='makecall("+(pagenum-1)+")'>"+(pagenum+i)+"</button>");
				}
			}
		}

		if(pagenum == total_pages){
			$("#page_container").append("<button class='btn btn-light-secondary btn-sm text-secondary font-medium disabled active'><<</button>");
		}else{
			$("#page_container").append("<button class='btn btn-light-secondary btn-sm text-secondary font-medium' onclick='makecall("+(pagenum-1)+")'>>></button>");
		}
}

function fetch_data(perpage, pagenum){

    var search = document.getElementById('brandname').value;
    var iso = $("#country option:selected").attr('data-iso');
    var ele = document.getElementsByName('country');
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                {
                  iso =  ele[i].value;
                }
            }

    let url = `<?php echo e(route('user.fecthgiftcards')); ?>?page=${pagenum}&countryCode=${iso ? iso : ''}&productName=${search ? search : ''}`;
    document.getElementById('mylist').innerHTML = `  <div class="main-page">
            <div class="loader">
                <div class="spin-blend"></div>
                <div class="spin-blend"></div>
                <div class="spin-blend"></div>
                <div class="spin-blend"></div>
                <div class="spin-blend"></div>
            </div>
            <div class="loading-text">
                <div class="letter">L</div>
                <div class="letter">o</div>
                <div class="letter">a</div>
                <div class="letter">d</div>
                <div class="letter">i</div>
                <div class="letter">n</div>
                <div class="letter">g</div>
                <div class="letter">.</div>
                <div class="letter">.</div>
                <div class="letter">.</div>
            </div>
        </div>`;

  fetch(url)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
    if(!data.data)
    {
    document.getElementById("mylist").innerHTML = `<?php echo emptyData2(); ?>`;
    return;
    }

    let resultTRX = data.data.content;
    var perpage = 10;
	// let obj = JSON.parse(resultTRX)
    var total_records = data.data.totalElements;
    var total_pages = Math.round(total_records / perpage);

    document.getElementById('total_products').innerHTML = "Page "+ pagenum+ " of " + total_pages +" | "+ total_records+" Products";

    var perpage = 10;
    var total_pages = Math.round(total_records / perpage);

    $(document).ready(function(){
        var pagenum = 1;
        createpagination(pagenum);
    });

	let html = '';

    resultTRX.map(card => {
        let htmlSegment = `
        <div class="col-sm-6 col-xl-4">
                <div class="card hover-img overflow-hidden rounded-2">
                  <div class="position-relative">
                    <a href="<?php echo e(route('user.giftcard')); ?>?id=${card.productId}"><img src="${card.logoUrls}" class="card-img-top rounded-0" alt="..."></a>
                    <a href="<?php echo e(route('user.giftcard')); ?>?id=${card.productId}" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>                      </div>
                  <div class="card-body pt-3 p-4">
                    <h6 class="fw-semibold fs-4">${card.productName}</h6>
                    <p id="${card.brand.brandName}"></p>
                    <div class="d-flex align-items-center justify-content-between">
                      <h6 class="fw-semibold fs-4 mb-0">${card.country.name}</h6><small>(${card.recipientCurrencyCode})</small>
                    </div>
                  </div>
                </div>
        </div>

                `;
	html += htmlSegment;

    });

    var total_records = data.data.totalPages;
    var perpage = 10;

    // var total_pages = total_records;
    var total_pages = Math.round(total_records / perpage);

    $(document).ready(function(){
        //var pagenum = 1;
        createpagination(pagenum);
        //fetch_data(perpage,pagenum);
    });

    let text = "";
    document.getElementById('mylist').innerHTML = '<div class="row">'+html+'</div>';
	})
}

function makecall(pagenum){
	createpagination(pagenum);
	fetch_data(perpage,pagenum);
}

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/public_html/core/resources/views/templates/basic/user/giftcard_auto/shop.blade.php ENDPATH**/ ?>