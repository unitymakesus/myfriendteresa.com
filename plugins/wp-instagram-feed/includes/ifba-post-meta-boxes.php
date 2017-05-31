<?php add_action( 'add_meta_boxes' , 'ifba_add_meta_boxes'); 

function ifba_add_meta_boxes(){ add_meta_box( 'ifba_shortcode_meta_box' , 'Shortcode' , 'ifba_shortcode_meta_box_UI' , 'ifba_instagram_feed','side');

 add_meta_box( 'ifba_buy_premium_meta_box' , 'Buy Premium And:' , 'ifba_premium_version' , 'ifba_instagram_feed' , 'side' , 'high'); 

 add_meta_box( 'ifba_promotion_meta_box' , 'You may also need:' , 'ifba_promotion' , 'ifba_instagram_feed' , 'side'); 

} function ifba_shortcode_meta_box_UI( $post ){ wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

 ?> <p id="ifba_shortcode_label" style="font-weight: bold;">Use this shortcode to add Instagram Feed in your Posts, Pages & Text Widgets: </p> <input style="width: 100%; text-align: center; font-weight: bold; font-size: 20px;" type="text" readonly id="ifba_shortcode_value" name="ifba_shortcode_value" value="[arrow_feed id='<?php echo $post->ID; ?>']" /> <?php } 

function ifba_promotion(){ ?> <style type="text/css"> #ifba_promotion_meta_box .inside{ margin: 0 !important; padding:0; margin-top: 5px; } </style> <a href="https://www.arrowplugins.com/popup-plugin" target="_blank"><img width="100%" src="<?php echo plugins_url('images/promotion.png' , __FILE__); ?>" /></a> <strong> <ul style="margin-left: 10px;"> <li> - 14 Beautifully Designed Popup</li> <li> - MailChimp, GetResponse, Active Campaign</li> <li> - Highly Customizable</li> <li> - Mobile Friendly (Responsive)</li> <li> - And much more...</li> </ul> </strong> <?php } 

function ifba_premium_version(){

 ?> <style type="text/css"> .ifba-action-button{ width: 93%; text-align: center; background: #e14d43; display: block; padding: 18px 8px; font-size: 16px; border-radius: 5px; color: white; text-decoration: none; border: 2px solid #e14d43;

 transition: all 0.2s; } .ifba-action-button:hover{ width: 93%; text-align: center; display: block; padding: 18px 8px; font-size: 16px; border-radius: 5px; color: white !important; text-decoration: none; background: #bb4138 !important; border: 2px solid #bb4138; }

 </style><strong> <ul> <li> - Unlock All Feed Templates</li> <li> - Unlock All Feed Styles</li> <li> - Unlock Hashtage Support</li> <li> - Unlock Unlimited Creation of Feeds</li> <li> - Unlock Widget Support</li> <li> - Unlock All Customization Optisons</li> <li> - Create 3, 4, 5, 6 Columns Masonry Feed</li> <li> - Custom Size for Thumbnail View</li> <li> - Get 24/7 Premium Support</li> <li> - Unlimited Updates</li> </ul> </strong> <a href="https://www.arrowplugins.com/instagram-feed/" target="_blank" class="ifba-action-button">GET PREMIUM NOW</a> <?php }