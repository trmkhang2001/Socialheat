
<?php
/**
 * @var $missInteractions
 * @var $pageMissInteractions
 * @var $itemId
 */
?>
<!-- Modal User  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Tương Tác</h5>
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
                        <tbody class="miss-interaction-items">
                            <?php $this->load->view('/backend/monitoring/_miss_item_interactions' ,[
                            		'missInteractions' => $missInteractions
                            ])?>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
	            <div class="clear pagination-miss-interactions">
		            <?= $pageMissInteractions?>
	            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-off" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/http-client.js"></script>
<script>
    $(document).ready(function() {
    	$('body').on('click','.pagination-miss-interactions a',async (event) => {
		    event.preventDefault();
		    const currentElement = $(event.currentTarget);
		    let pageMIss = currentElement.data('ciPaginationPage');
		    let url = '<?= site_url("/backend/monitoring/getItemMissInteraction/{$itemId}")?>';
		    const response = await getRequest(url, {
			    page_miss : pageMIss
		    });
		    const responseJson = await getResponseJson(response);
		    if(responseJson.error){
			    toastr['error'](responseJson.error);
		    }
		    $('.miss-interaction-items').empty().append(responseJson.html);
		    $('.pagination-miss-interactions').empty().append(responseJson.pagination);
	    })


    })
</script>