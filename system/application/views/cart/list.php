            <?php if(count($this->cart->contents()) == 0): ?>
            <div class="cart_row">
                You have no items in your cart.
            </div>
            <?php endif; ?>
            <?php foreach($this->cart->contents() as $item): ?>
            <div class="cart_row" id="<?php echo $item['id']; ?>">
                <table>
                    <tr>
                        <td style="width:30%">
                            <div id="item_details">
                                <?php echo $item['name']; ?>
                            </div>
                        </td>
                        <td style="width:30%">
                            <div id="item_status">
                                <?php //TODO echo $item['status']; ?>
                                <?php echo $spaces[0] . " Spaces Available"; ?>
                            </div>
                        </td>
                        <td style="width:30%;">
                            <?php if($display == 'single'): ?>
                            <div id="item_price">
                                <?php echo $item['price']; ?>
                            </div>
                            <?php else: ?>
                            <div id="attendees">
                                <!-- Generated by UI -->
                            </div>
                            <?php endif; ?>
                        </td>
                        <td style="width:10%;">
                            <div class="item_remove" id="<?php echo $item['rowid']; ?>">
                                Remove
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>