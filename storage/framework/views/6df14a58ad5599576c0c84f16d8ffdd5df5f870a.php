<?php $__env->startSection('panel'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $__env->stopPush(); ?>
    <div class="vstacks">
        <div class="px-3s px-md-8s pt-8s">


            <div class="row row-cols-xl-4 row-cols-md-2 g-6 mt-6">
                <div class="col">
                    <div class="card bg-primary bg-opacity-10 border-primary border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="<?php echo e(url('/')); ?>/assets/images/provider/dstv.jpg" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">DSTV
                                    </a><span class="d-block text-xs text-muted">DSTV Subscriptions</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-primary bg-opacity-25 text-primary"><?php echo e($general->cur_sym); ?><?php echo e(number_format($dstv,2)); ?></span>
                                    <span class="badge badge-count bg-primary text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card bg-warning bg-opacity-10 border-warning border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="<?php echo e(url('/')); ?>/assets/images/provider/gotv.webp" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">GOTV
                                    </a><span class="d-block text-xs text-muted">GOTV Subscriptions</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-warning bg-opacity-25 text-warning"><?php echo e($general->cur_sym); ?><?php echo e(number_format($gotv,2)); ?></span>
                                    <span class="badge badge-count bg-warning text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-danger bg-opacity-10 border-danger border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="<?php echo e(url('/')); ?>/assets/images/provider/starrtimes.png" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">Startimes Network
                                    </a><span class="d-block text-xs text-muted">Startimes Subscriptions</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-danger bg-opacity-25 text-danger"><?php echo e($general->cur_sym); ?><?php echo e(number_format($startimes,2)); ?></span>
                                    <span class="badge badge-count bg-danger text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-success bg-opacity-10 border-success border-opacity-40">
                        <div class="p-5">
                            <div class="d-flex gap-3 mb-5"><img src="<?php echo e(url('/')); ?>/assets/images/provider/showmax.svg" class="avatar"
                                    alt="...">
                                <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                        href="#">Showmax Network
                                    </a><span class="d-block text-xs text-muted">Showmax Subscriptions</span></div>
                            </div>
                            <div class="d-flex align-items-end">
                                <div class="hstack gap-2">
                                    <span class="badge bg-success bg-opacity-25 text-success"><?php echo e($general->cur_sym); ?><?php echo e(number_format($showmax,2)); ?></span>
                                    <span class="badge badge-count bg-success text-xs rounded-circle"><i
                                            class="bi bi-wallet"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row align-items-center g-6 mt-0 mb-6">

                           <form action="#">
                <div class="col-sm-6">
                    <div class="d-flex gap-2">

                        <div class="input-group input-group-sm input-group-inline w-100 w-md-50">
                            <span class="input-group-text"><i class="bi bi-search me-2"></i> </span>
                            <input type="search" class="form-control ps-0" name="search" placeholder="Search by ID" aria-label="Search">

                        </div>


                    </div>
                </div>
                    </form>
            </div>
        </div>
        <div class="border-top">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">Network</th>
                            <th class="w-md-32" scope="col">Amount</th>
                            <th class="w-md-32 d-none d-sm-table-cell" scope="col">Ref</th>
                            <th class="w-md-32" scope="col">Customer</th>
                            <th class="w-md-20 d-none d-sm-table-cell">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $__empty_1 = true; $__currentLoopData = $cabletvlog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3"><img src="<?php echo e(url('/')); ?>/assets/images/provider/img-03.png"
                                        class="avatar avatar-sm rounded-circle" alt="...">
                                    <div class=""><a class="d-inline-block text-sm text-heading fw-semibold"
                                            href="#"><?php echo e(__(@strToUpper($data->product_name))); ?>

                                        </a><span class="d-block text-xs text-muted"></span></div>
                                </div>
                            </td>
                            <td><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->price)); ?></td>
                            <td class="d-none d-sm-table-cell">
                                <span class="text-success fw-semibold"><?php echo e($data->trx); ?></span>
                            </td>

                            <td class="d-non d-sm-table-cell"><?php echo e($data->val_1); ?><br>
                            <small><?php echo e($data->val_2); ?></small>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <div class="w-rem-32">
                                    <?php echo e(showDate($data->created_at)); ?>

                                </div>
                            </td>
                        </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php echo emptyData2(); ?>

                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
            <?php if($cabletvlog->hasPages()): ?>
            <div class="py-4 px-6">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6 d-none d-md-block">
                        <span class="text-muted text-sm"></span>
                    </div>
                    <div class="col-md-auto">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-spaced gap-1">

                                <?php echo e($cabletvlog->links()); ?>


                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content overflow-hidden">
                                <div class="modal-header pb-0 border-0">
                                    <h1 class="modal-title h4" id="topUpModalLabel">Buy Cable TV Subsctiption Plan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body undefined">
                                    <form class="vstack gap-8">




                                        <div class="bg-body-secondary rounded-3 p-4">
                                            <div class="d-flex justify-content-between text-xs text-muted">
                                                <span class="fw-semibold">Decoder Number</span> </div>

                                            <div class="d-flex justify-content-between gap-2 mt-4">
                                              <input type="tel" id="decodernumber" onkeyup="validatedecoder()" class="form-control form-control-flush text-xl fw-bold w-rem-40" placeholder="123********">
                                                <button class="btn btn-sm btn-neutral rounded-pill shadow-none flex-none d-flex align-items-center gap-2 p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <a id="networkimage"><img src="<?php echo e(url('/')); ?>/assets/images/provider/img-03.png" class="w-rem-6 h-rem-6 rounded-circle" alt="..."></a>  <i class="bi bi-chevron-down text-xs me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                                                      <?php $__currentLoopData = ($networks); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li onclick="verifynetwork(`<?php echo e($plan['logo']); ?>`,`<?php echo e($plan['name']); ?>`)"><a class="dropdown-item d-flex align-items-center gap-2" href="#"><img src="<?php echo e(url('/')); ?>/assets/images/provider/<?php echo e($plan['logo']); ?>" class="w-rem-6 h-rem-6 rounded-circle" alt="...">
                                                                <span><?php echo e(strToUpper($plan['name'])); ?></span>
                                                            </a>
                                                        </li>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                         <?php $__env->startPush('script'); ?>
                                                          <script>
                                                            function verifynetwork(logo,decoder)
                                                            {

                                                              document.getElementById("decodernumber").value = null;
                                                              document.getElementById("networkimage").innerHTML = `<img src="<?php echo e(url('/')); ?>/assets/images/provider/${logo}" class="w-rem-6 h-rem-6 rounded-circle"/>`;
                                                              document.getElementById("decodertype").value = decoder;
                                                              this.getplans(logo,decoder);
                                                            }
                                                            function getplans(logo,decoder) {
                                                              var raw = JSON.stringify({
                                                                _token: "<?php echo e(csrf_token()); ?>",
                                                                decoder: decoder
                                                              });
                                                                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                                                                const url = `<?php echo e(route('user.cabletv.operators')); ?>?decoder=${encodeURIComponent(decoder)}&_token=${csrfToken}`;
                                                                console.log("Getting ready to call server");
                                                              var requestOptions = {
                                                                method: 'GET',
                                                                headers: {
                                                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                },
                                                              };
                                                              console.log("about to call server");
                                                              fetch(url, requestOptions).then(response =>
                                                                response.text()).then(result => {
                                                                    console.log("server response");
                                                                    console.log(result);
                                                                  let html = '';
                                                                  const data = JSON.parse(result);
                                                                var plans = data.content;
                                                                var image = data.image;
                                                                  plans.map(plan => {

                                                                      let htmlSegment =
                                                                        `
                                                                        <div class="form-item-checkable">
                                                                          <input class="form-item-check" type="radio" id="${plan['variation_code']}"  onchange="networkprovider('${plan['variation_code']}|${plan['variation_amount']}')" value="${plan['variation_code']}|${plan['variation_amount']}">
                                                                          <label class="form-item cursor-pointer" for="${plan['variation_code']}"><span class="form-item-click d-inline-flex flex-column gap-3 align-items-center justify-content-center form-control w-rem-24 h-rem-24 text-center text-muted">
                                                                            <img style="border-radius: 50%;"
                                                            src="<?php echo e(url('/')); ?>/assets/images/provider/${logo}"
                                                            width="30" /> <span class="fw-semibold text-xs"><b>${plan['name'].substring(0, 13)}</b><br><small class="text-muted"> <b>₦${plan['variation_amount']}</b></small></span></span></label>
                                                                        </div>`;
                                                                      html += htmlSegment;

                                                                  });
                                                                  document.getElementById("planlist").innerHTML =
                                                                    `  <div class="row align-items-center g-3">
                                                              <div class="">
                                                                  <div class="d-flex gap-3 scrollable-x">${html}</div></div></div>`;
                                                                }).catch(error => {
                                                                  console.log(error);
                                                                });
                                                            }
                                                          </script>
                                                          <script>
                                                            function setamount(input) {
                                                              document.getElementById("phone").disabled = false;
                                                              document.getElementById("amount").value = input.value;
                                                              document.getElementById("networkname").value = input.value.split('|')[3];
                                                              document.getElementById("data_plan").value = input.value.split('|')[2];
                                                            }
                                                          </script>
                                                          <script>
                                                                function networkprovider(network) {
                                                                document.getElementById("plan").value = `${network}`;
                                                                document.getElementById("decodernumber").disabled = false;
                                                                }
                                                            </script>
                                                          <?php $__env->stopPush(); ?>

                                                      <input id="amount" hidden>
                                                        <input id="plan" hiddens>
                                                        <input id="decodertype" hidden>

                                                    </ul>
                                            </div>
                                        </div>
                                        <p id="customer"></p>


                        <input id="customername" hidden>

                                                                       <a id="planlist"></a>


                                            <?php $__env->startPush('script'); ?>
                                            <script>
                                            function validatedecoder() {
                                                var decodernumber = document.getElementById("decodernumber").value;
                                                document.getElementById("submit").disabled = true;
                                                document.getElementById("customer").innerHTML = null;
                                                document.getElementById("customername").value = null;

                                                if (decodernumber.length > 9) {
                                                // START GET DATA \\
                                                $("#networkimage").html(`<center><i class="fa fa-spinner fa-spin"></i></center>`);
                                                document.getElementById("customer").innerHTML = `<center><i class="fa fa-spinner fa-spin"></i></center>`;
                                                var decoder = document.getElementById("decodertype").value;
                                                var _token = $("input[name='_token']").val();
                                                document.getElementById("customer").innerHTML = '';
                                                $.ajax({
                                                    url: "<?php echo e(route('user.cabletv.verifydecoder')); ?>",
                                                    type: 'GET',
                                                    async: true,
                                                    data: {
                                                    _token: _token,
                                                    number: decodernumber,
                                                    decoder: decoder
                                                    },
                                                    async: true,
                                                    cache: false,
                                                    dataType: "json",
                                                    success: function (data) {
                                                    if (data.ok === true) {
                                                        document.getElementById("customer").innerHTML = `<br>
                                                                            <span class="badge font-medium bg-primary">Customer Name: ${data.content
                                                        }</span
                                                                            >`;
                                                        document.getElementById("customername").value = data.content;
                                                        document.getElementById("submit").disabled = false;
                                                        $("#networkimage").html(`<i class="fa fa-check text-success"></i>`);

                                                    } else {
                                                        $("#networkimage").html(`<i class="fa fa-info text-danger"></i>`);
                                                        document.getElementById("customer").innerHTML = `<br>
                                                                                <span class="mb-1 badge font-medium bg-light-danger text-danger">Customer Name: ${data.message
                                                        }</span
                                                                                >`;
                                                    }
                                                    }
                                                });
                                                }
                                                // END GET DATA \\
                                            }
                                            </script>
                                            <?php $__env->stopPush(); ?>



                                        <div class="bg-body-secondary rounded-3 p-4">
                                            <div class="d-flex justify-content-between text-xs text-muted">
                                                <span class="fw-semibold">PIN</span></div>
                                            <div class="d-flex justify-content-between gap-2 mt-4"><input type="tel" id="password" class="form-control form-control-flush text-xl fw-bold flex-fill" placeholder="****">
                                            </div>
                                        </div>


                                        <div>
                                            <div class="vstack gap-2">
                                                 <div id="purchasemessage"></div>
                                                <div class="text-center">
                                                    <button type="button" id="submit" onclick="submitform()" class="btn btn-primary w-100"><a id="submitloader">Buy</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb'); ?>
    <button type="button" class="btn btn-sm btn-neutral d-sm-inline-flex" data-bs-target="#topUpModal" data-bs-toggle="modal">Recharge</button>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function submitform() {
            var raw = JSON.stringify({
                _token: "<?php echo e(csrf_token()); ?>",
              password: document.getElementById('password').value,
              number: document.getElementById('decodernumber').value,
              customername: document.getElementById('customername').value,
              plan: document.getElementById('plan').value,
              decoder: document.getElementById('decodertype').value,
                wallet: "main"
            });

            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            document.getElementById("submit").disabled = true;

            $(document).ready(function() {
                $.blockUI();
            });
            fetch("<?php echo e(route('user.buy.cabletv')); ?>", requestOptions).then(response => response.text()).then(
                result => {
                    resp = JSON.parse(result);
                    $(document).ready(function() {
                        $.unblockUI();
                    });
                    document.getElementById("submit").disabled = false;

                    if (resp.status == 'success') {
                         Toastify({
                          text: `${resp.message}`,
                          className: "info",
                          style: {
                              background: "linear-gradient(to right, #00b09b, #96c93d)",
                          }
                          }).showToast();
                        location.reload();
                    }
                    if (resp.status == 'danger')
                    {
                      Toastify({
                      text: `${resp.message}`,
                      className: "info",
                      style: {
                          background: "linear-gradient(to right, #D22B2B, #000000)",
                      }
                      }).showToast();
                    }
                }).catch(error => {});
        }
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\PhpstormProjects\webitechng\resources\views/templates/satoshi/user/bills/cabletv/cabletv_buy.blade.php ENDPATH**/ ?>