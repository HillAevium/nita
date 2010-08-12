<?php
// Some mock data
$profiles = json_encode(array (
    array('id' => 1, 'name' => 'A'),
    array('id' => 2, 'name' => 'B'),
    array('id' => 3, 'name' => 'C'),
    array('id' => 4, 'name' => 'D'),
    array('id' => 5, 'name' => 'E'),
    array('id' => 6, 'name' => 'F')
));
$companyInfo = json_encode(array(
    'name' => "Jen's Law Firm",
    'address' => "1667 W. Alimosa Ave.",
    'city' => 'Denver',
    'state' => 'CO',
    'country' => 'USA',
    'zip' => '80219',
    'phone' => '303-824-2789',
    'fax' => '303-824-2291'
));

echo <<<JS

<script type="text/javascript">
    var profiles = $profiles;
    var companyInfo = $companyInfo;
</script>
JS;

?>
    
    <div id="content_main_inner">
        <h1 class="page_title"><?php echo $title; ?></h1>
        <div class="gray_line"></div>
        <div id="billing_container" style="display:none;">
            <?php echo $this->load->view('cart/billing')?>
        </div>
        <div id="cart_container">
            <?php foreach($this->cart->contents() as $item): ?>
            <div id="<?php echo $item['id']; ?>">
                <table>
                    <tr>
                        <td style="width:75%">
                            <div id="item_details">
                                <?php echo $item['name']; ?>
                            </div>
                        </td>
                        <td style="width:25%">
                            <div id="attendees">
                                <!-- Generated by UI -->
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="gray_line"></div>
        <div id="add_profile" style="float:left;margin:10px 0;">Add New Profile +</div>
        <div id="profile_box">
            <h1 class="page_title" style="margin-top:-40px;">Create a New Profile</h1>
            <button class="close">Close</button>
            <?php //echo $this->load->view('user/form_profile', null, true); ?>
        </div>
        <!-- TODO - Fix buttons -->
        <div id="review" class="button_generic">Review</div>
        <div id="billing" class="button_generic" style="display:none;">Billing</div>
        <div id="finish" class="button_generic" style="display:none;">Finish</div>
        <div id="print" class="button_generic" style="display:none;">Print</div>
        <div class="clear"></div>
    </div> <!-- #content_main_inner -->
    