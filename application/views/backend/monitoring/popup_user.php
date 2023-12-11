<style>
    .btnhidden {
        display: none;
    }
</style>
<!-- Modal User  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Tương Tác</h5>
                <button type="button" class="btn-close btnUserTt" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th>
                                    NO.
                                </th>
                                <th>Profile</th>
                                <th>Uid</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <?php $index = 0;
                            foreach ($missinteractions['miss'] as $miss) {
                                $index++ ?>
                                <tr>
                                    <td>
                                        <span><?= $index ?>.</span>
                                    </td>
                                    <td>
                                        <a href="https://facebook.com/<?= $miss->uid ?>" class="symbol symbol-50px me-4" target="_blank">
                                            <img style="width: 40px; height:40px" class="border rounded-pill m--img-rounded m--marginless" src="https://graph.facebook.com/<?= $miss->uid ?>/picture?type=large&amp;width=500&amp;height=500&amp;access_token=<?= FB_TOKEN ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="https://facebook.com/100004882509279" target="_blank">
                                                <span class="text-dark fw-bold text-hover-primary fs-6"><?= $miss->uid ?></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-back btnhidden">Back</button>
                <button type="button" class="btn btn-primary btn-next">Next</button>
                <button type="button" class="btn btn-secondary btn-off" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var number_page = urlParams.get('page_miss');
        var show = urlParams.get('show');
        // console.log(number_page);
        // console.log(show);
        var total_miss = <?= json_encode(count($missinteractions['miss'])) ?>;
        if (number_page == null) {
            var number_page = 1;
        } else {
            var number_page = urlParams.get('page_miss');
        }
        if (number_page > 1) {
            $('.btn-back').removeClass('btnhidden');
        }
        if (total_miss < 5) {
            $('.btn-next').addClass('btnhidden');
        }
        if (show == true) {
            $('.btnUserTt').trigger('click');
        }
        // console.log(number_page);
        $(".btn-off").on("click", function() {
            window.location = "?page_miss" + number_page;
        })
        $(".btn-back").on("click", function() {
            number_page--;
            // console.log("back ne", number_page);
            window.location.href = "?page_miss=" + number_page + "&show=1";
        })
        $(".btn-next").on("click", function() {
            number_page++;
            // console.log("next ne", number_page);
            window.location.href = "?page_miss=" + number_page + "&show=1";
        })
    })
</script>