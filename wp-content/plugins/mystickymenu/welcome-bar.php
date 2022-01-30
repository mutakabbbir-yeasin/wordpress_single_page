<?php

function mysticky_welcome_bar_backend() {
	$upgarde_url = admin_url("admin.php?page=my-stickymenu-upgrade");
	$nonce = wp_create_nonce('mysticky_option_welcomebar_update');
	$nonce_reset = wp_create_nonce('mysticky_option_welcomebar_reset');

	$welcomebar = get_option( 'mysticky_option_welcomebar' );
	if ( $welcomebar == '' || empty($welcomebar)) {
		$welcomebar = mysticky_welcomebar_pro_widget_default_fields();
	}
	$mysticky_welcomebar_showx_desktop = $mysticky_welcomebar_showx_mobile = '';
	$mysticky_welcomebar_btn_desktop = $mysticky_welcomebar_btn_mobile = '';
	$mysticky_welcomebar_display_desktop = $mysticky_welcomebar_display_mobile = '';
	if( isset($welcomebar['mysticky_welcomebar_x_desktop']) ) {
		$mysticky_welcomebar_showx_desktop = ' mysticky-welcomebar-showx-desktop';
	}
	if( isset($welcomebar['mysticky_welcomebar_x_mobile']) ) {
		$mysticky_welcomebar_showx_mobile = ' mysticky-welcomebar-showx-mobile';
	}
	if( isset($welcomebar['mysticky_welcomebar_btn_desktop']) ) {
		$mysticky_welcomebar_btn_desktop = ' mysticky-welcomebar-btn-desktop';
	}
	if( isset($welcomebar['mysticky_welcomebar_btn_mobile']) ) {
		$mysticky_welcomebar_btn_mobile = ' mysticky-welcomebar-btn-mobile';
	}
	
	if( !isset($welcomebar['mysticky_welcomebar_redirect_rel']) ) {
		$welcomebar['mysticky_welcomebar_redirect_rel'] = '';
	}
	$display = ' mysticky-welcomebar-attention-'. ( isset($welcomebar['mysticky_welcomebar_attentionselect']) ? $welcomebar['mysticky_welcomebar_attentionselect'] : '' );
	$display_entry_effect = (isset($welcomebar['mysticky_welcomebar_entry_effect'])) ? ' mysticky-welcomebar-entry-effect-'.$welcomebar['mysticky_welcomebar_entry_effect'] : ' mysticky-welcomebar-entry-effect-slide-in';
	$display_main_class = "mysticky-welcomebar-position-" . $welcomebar['mysticky_welcomebar_position'] . $mysticky_welcomebar_showx_desktop . $mysticky_welcomebar_showx_mobile . $mysticky_welcomebar_btn_desktop . $mysticky_welcomebar_btn_mobile . $display . $display_entry_effect;
	?>
	<form class="mysticky-welcomebar-form" id="mysticky_welcomebar_form" method="post" action="#">
		<div class="mysticky-welcomebar-header-title">
			<h3><?php _e('Welcome Bar', 'myStickymenu'); ?></h3>
			<label for="mysticky-welcomebar-contact-form-enabled" class="mysticky-welcomebar-switch">
				<input type="checkbox" id="mysticky-welcomebar-contact-form-enabled" name="mysticky_option_welcomebar[mysticky_welcomebar_enable]" value="1" <?php checked( @$welcomebar['mysticky_welcomebar_enable'], '1' );?> />
				<span class="slider"></span>
			</label>
		</div>
		<div class="mysticky-welcomebar-setting-wrap">
			<div class="mysticky-welcomebar-setting-left">
				<div class="mysticky-welcomebar-setting-block">
					<div class="mysticky-welcomebar-subheader-title">
						<h4><?php _e('Design', 'myStickymenu'); ?></h4>
					</div>
					<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-setting-position">
						<label><?php _e('Position', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_position]" value= "top" type="radio" <?php checked( @$welcomebar['mysticky_welcomebar_position'], 'top' );?> />
								<?php _e("Top", 'mystickymenu'); ?>
							</label>
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_position]" value="bottom" type="radio" disabled />
								<?php _e("Bottom", 'mystickymenu'); ?>
							</label>
							<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( 'Upgrade Now', 'mystickymenu' );?></a></span>
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Height', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<div class="px-wrap">
								<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_height" name="mysticky_option_welcomebar[mysticky_welcomebar_height]" value="60" disabled />
								<span class="input-px">PX</span>
							</div>
							<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( 'Upgrade Now', 'mystickymenu' );?></a></span>
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Background Color', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker">
							<input type="text" id="mysticky_welcomebar_bgcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_bgcolor]" class="my-color-field" data-alpha="true" value="<?php echo $welcomebar['mysticky_welcomebar_bgcolor'];?>" />
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Background Text Color', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker">
							<input type="text" id="mysticky_welcomebar_bgtxtcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_bgtxtcolor]" class="my-color-field" data-alpha="true" value="<?php echo $welcomebar['mysticky_welcomebar_bgtxtcolor'];?>" />
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Font', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<select name="mysticky_option_welcomebar[mysticky_welcomebar_font]" class="form-fonts">
								<option value=""><?php _e( 'Select font family', 'myStickymenu' );?></option>
								<?php $group= ''; foreach( myStickymenu_fonts() as $key=>$value):
											if ($value != $group){
												echo '<optgroup label="' . $value . '">';
												$group = $value;
											}
										?>
									<option value="<?php echo esc_attr($key);?>" <?php selected( @$welcomebar['mysticky_welcomebar_font'], $key ); ?>><?php echo esc_html($key);?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Font Size', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<div class="px-wrap">
								<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_fontsize" name="mysticky_option_welcomebar[mysticky_welcomebar_fontsize]" value="<?php echo @$welcomebar['mysticky_welcomebar_fontsize'];?>" />
								<span class="input-px">PX</span>
							</div>
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Bar Text', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
						<?php 
							$settings = array(
								'media_buttons' => false, 
								'textarea_name' => 'mysticky_option_welcomebar[mysticky_welcomebar_bar_text]',
								'tinymce' => false,
								'quicktags' => array(
									'buttons' => 'strong,em,link'
								)
							);
							wp_editor( stripslashes($welcomebar['mysticky_welcomebar_bar_text']), 'mysticky_bar_text', $settings );      
							// add more buttons to the html editor
							function underline_tag_add_quicktags() {
								if ( wp_script_is('quicktags') ){ ?>
								<script type="text/javascript">
									QTags.addButton( 'underline_tag', 'U', '<u>', '</u>', 'underline', 'underline', 20, '' );
								</script>
							<?php
								}
							}
							add_action( 'admin_print_footer_scripts', 'underline_tag_add_quicktags' );    
							?>
						<!--<textarea id="mysticky_bar_text" class="mystickyinput" name="mysticky_option_welcomebar[mysticky_welcomebar_bar_text]" rows="4" style="display: none;"><?php echo stripslashes($welcomebar['mysticky_welcomebar_bar_text']);?> </textarea>-->
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Show X', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_x_desktop]" value= "desktop" type="checkbox" <?php checked( @$welcomebar['mysticky_welcomebar_x_desktop'], 'desktop' );?> />
								<?php _e( 'Desktop', 'mystickymenu' );?>
							</label>
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_x_mobile]" value= "mobile" type="checkbox" <?php checked( @$welcomebar['mysticky_welcomebar_x_mobile'], 'mobile' );?> />
								<?php _e( 'Mobile', 'mystickymenu' );?>
							</label>
						</div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-block">
					<div class="mysticky-welcomebar-subheader-title">
						<h4><?php _e('Button', 'myStickymenu'); ?></h4>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Button', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_btn_desktop]" value= "desktop" type="checkbox" <?php checked( @$welcomebar['mysticky_welcomebar_btn_desktop'], 'desktop' );?> />
								<?php _e( 'Desktop', 'mystickymenu' );?>
							</label>
							<label>
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_btn_mobile]" value= "mobile" type="checkbox"<?php checked( @$welcomebar['mysticky_welcomebar_btn_mobile'], 'mobile' );?> />
								<?php _e( 'Mobile', 'mystickymenu' );?>
							</label>
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Button Color', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker mysticky_welcomebar_btn_color">
							<input type="text" id="mysticky_welcomebar_btncolor" name="mysticky_option_welcomebar[mysticky_welcomebar_btncolor]" class="my-color-field" data-alpha="true" value="<?php echo esc_attr($welcomebar['mysticky_welcomebar_btncolor']);?>" />
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Button Text Color', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-colorpicker mysticky_welcomebar_btn_color">
							<input type="text" id="mysticky_welcomebar_btntxtcolor" name="mysticky_option_welcomebar[mysticky_welcomebar_btntxtcolor]" class="my-color-field" data-alpha="true" value="<?php echo $welcomebar['mysticky_welcomebar_btntxtcolor'];?>" />
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Button Text', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<input type="text" id="mysticky_welcomebar_btn_text" class="mystickyinput mysticky_welcomebar_disable" name="mysticky_option_welcomebar[mysticky_welcomebar_btn_text]" value="<?php echo stripslashes($welcomebar['mysticky_welcomebar_btn_text']);?>"  />
						</div>
					</div>
					<!-- -->
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Attention Effect', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<div class="mysticky-welcomebar-setting-attention">
								<select name="mysticky_option_welcomebar[mysticky_welcomebar_attentionselect]" class="mysticky-welcomebar-attention mysticky_welcomebar_disable">
									<option value="default" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], '	' ); ?>><?php _e( 'None', 'myStickymenu' );?></option>
									<option value="flash" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'flash' ); ?>><?php _e( 'Flash', 'myStickymenu' );?></option>
									<option value="shake" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'shake' ); ?>><?php _e( 'Shake', 'myStickymenu' );?></option>
									<option value="swing" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'swing' ); ?>><?php _e( 'Swing', 'myStickymenu' );?></option>
									<option value="tada" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'tada' ); ?>><?php _e( 'Tada', 'myStickymenu' );?></option>
									<option value="heartbeat" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'heartbeat' ); ?>><?php _e( 'Heartbeat', 'myStickymenu' );?></option>
									<option value="wobble" <?php selected( @$welcomebar['mysticky_welcomebar_attentionselect'], 'wobble' ); ?>><?php _e( 'Wobble', 'myStickymenu' );?></option>
								</select>
							</div>
						</div>
					</div>
					<!-- -->
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Button Submission', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-redirect-wrap">
							<div class="mysticky-welcomebar-setting-action">
								<select name="mysticky_option_welcomebar[mysticky_welcomebar_actionselect]" class="mysticky-welcomebar-action mysticky_welcomebar_disable">
									<option value="redirect_to_url" <?php selected( @$welcomebar['mysticky_welcomebar_actionselect'], 'redirect_to_url' ); ?>><?php _e( 'Redirect to URL', 'myStickymenu' );?></option>
									<option value="close_bar" <?php selected( @$welcomebar['mysticky_welcomebar_actionselect'], 'close_bar' ); ?>><?php _e( 'Close bar', 'myStickymenu' );?></option>
									<option value="poptin_popup" <?php selected( @$welcomebar['mysticky_welcomebar_actionselect'], 'poptin_popup' ); ?> ><?php _e( 'Launch a Poptin pop-up', 'myStickymenu' );?></option>
									<option value="thankyou_screen" data-href="<?php echo esc_url($upgarde_url); ?>"><?php _e( 'Thank you screen (Upgrade Now)', 'myStickymenu' );?></option>
								</select>
							</div>
							
						</div>
					</div>
					
					<div class="mysticky-welcomebar-poptin-popup" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'poptin_popup' ) : ?> style="display:none;" <?php endif;?>>						
						<div class="mysticky-welcomebar-setting-content">
							<p class="mysticky-welcomebar-poptin-content" >Sign up at <a href="https://www.poptin.com/?utm_source=msm" target="_blank">Poptin</a> for free and launch pop-ups on <a href="https://help.poptin.com/article/show/72942-how-to-show-a-poptin-when-the-visitor-clicks-on-a-button-link-on-your-site" target="_blank">click</a>							
							</p>							
						</div>
						<div class="mysticky-welcomebar-setting-content">
							<label><?php _e('Poptin pop-up direct link', 'myStickymenu'); ?></label>
							<div class="mysticky-welcomebar-setting-content-right">
								<input type="text" id="mysticky_welcomebar_poptin_popup_link" class="mystickyinput mysticky_welcomebar_disable" name="mysticky_option_welcomebar[mysticky_welcomebar_poptin_popup_link]" value="<?php echo (isset($welcomebar['mysticky_welcomebar_poptin_popup_link'])) ? $welcomebar['mysticky_welcomebar_poptin_popup_link'] : '';?>" placeholder="<?php echo esc_url("https://app.popt.in/APIRequest/click/some_id_here"); ?>"  />
								<input type="hidden" id="welcome_save_anyway"  value='' />
							</div>
						</div>
					</div>
					<!-- -->
					
					<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-redirect-container" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'redirect_to_url' ) : ?> style="display:none;" <?php endif;?>>
						<label><?php _e('Redirection link', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-action mysticky-welcomebar-redirect" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] == 'close_bar' ) : ?> style="display:none;" <?php endif;?> >
							<input type="text" id="mysticky_welcomebar_redirect" class="mystickyinput mysticky_welcomebar_disable" name="mysticky_option_welcomebar[mysticky_welcomebar_redirect]" value="<?php echo esc_url($welcomebar['mysticky_welcomebar_redirect']);?>" placeholder="<?php echo esc_url("https://www.yourdomain.com"); ?>"  />
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-redirect-container" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'redirect_to_url' ) : ?> style="display:none;" <?php endif;?>>
						<label><?php _e( 'Open in a new tab', 'mystickymenu' );?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-newtab mysticky-welcomebar-redirect"  >
							<label class="mysticky-welcomebar-switch">
								<input name="mysticky_option_welcomebar[mysticky_welcomebar_redirect_newtab]" value= "1" type="checkbox" disabled />
								<span class="slider"></span>
							</label>
							<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( 'Upgrade Now', 'mystickymenu' );?></a></span>
						</div>
					</div>
					<div class="mysticky-welcomebar-setting-content mysticky-welcomebar-redirect-container" <?php if ( $welcomebar['mysticky_welcomebar_actionselect'] != 'redirect_to_url' ) : ?> style="display:none;" <?php endif;?>>
						<label><?php _e('rel Attribute', 'myStickymenu'); ?>
							<span class="mysticky-custom-fields-tooltip">
								<a href="javascript:void(0);" class="mysticky-tooltip mysticky-new-custom-btn"><i class="dashicons dashicons-editor-help"></i></a>
								<p>Add a "rel" attribute to the button link. You can use it to add a rel="nofollow", "sponsored", or any other "rel" attribute option</p>
							</span>
						</label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-setting-newtab mysticky-welcomebar-redirect"  >
							<input type="text" id="mysticky_welcomebar_redirect_rel" class="mystickyinput mysticky_welcomebar_disable" name="mysticky_option_welcomebar[mysticky_welcomebar_redirect_rel]" value="" placeholder="" disabled />
							<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( 'Upgrade Now', 'mystickymenu' );?></a></span>
						</div>
					</div>
					<!-- -->
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('After Submission', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<div class="mysticky-welcomebar-setting-action">
								<select name="mysticky_option_welcomebar[mysticky_welcomebar_aftersubmission]" class="mysticky-welcomebar-aftersubmission mysticky_welcomebar_disable">
									<option value="dont_show_welcomebar" <?php selected( @$welcomebar['mysticky_welcomebar_aftersubmission'], 'dont_show_welcomebar' ); ?>><?php _e( "Don't show the Welcome Bar", 'myStickymenu' );?></option>
									<option value="show_welcomebar_next_visit" <?php selected( @$welcomebar['mysticky_welcomebar_aftersubmission'], 'show_welcomebar_next_visit' ); ?>><?php _e( 'Show the Welcome Bar in the next visit', 'myStickymenu' );?></option>
									<option value="show_welcomebar_every_page" <?php selected( @$welcomebar['mysticky_welcomebar_aftersubmission'], 'show_welcomebar_every_page' ); ?> ><?php _e( 'Show the Welcome Bar on every page', 'myStickymenu' );?></option>
								</select>
							</div>
						</div>
					</div>
					<!-- -->
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Close welcome bar Automatically', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right mysticky-welcomebar-close-automatically-sec">
							<label for="mysticky-welcomebar-close-automatically-enabled" class="mysticky-welcomebar-switch">
								<input type="checkbox" id="mysticky-welcomebar-close-automatically-enabled" name="mysticky_option_welcomebar[mysticky_welcomebar_enable_automatical]" value="1" disabled />
								<span class="slider"></span>
							</label>
							<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( 'Upgrade Now', 'mystickymenu' );?></a></span>
							<div class="mysticky-welcomebar-setting-action" style="display:none;">
								<div class="px-wrap">
									<span><?php _e('Close welcome bar after ', 'myStickymenu'); ?></span>
									<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_triggersec_automatically" name="mysticky_option_welcomebar[mysticky_welcomebar_triggersec_automatically]" value="0">
									<span class="input-px"><?php _e('Sec', 'myStickymenu'); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="mysticky-welcomebar-setting-block">
					<div class="mysticky-welcomebar-subheader-title">
						<h4><?php _e('Display Rules', 'myStickymenu'); ?></h4>
					</div>
					<div class="mysticky-welcomebar-setting-content">
						<label><?php _e('Entry effect', 'myStickymenu'); ?></label>
						<div class="mysticky-welcomebar-setting-content-right">
							<?php $welcomebar['mysticky_welcomebar_entry_effect'] = (isset($welcomebar['mysticky_welcomebar_entry_effect']) && $welcomebar['mysticky_welcomebar_entry_effect']!= '') ? $welcomebar['mysticky_welcomebar_entry_effect'] : 'slide-in'; ?>
							<select id="myStickymenu-entry-effect" name="mysticky_option_welcomebar[mysticky_welcomebar_entry_effect]" >
								<option value="none" <?php selected( @$welcomebar['mysticky_welcomebar_entry_effect'], 'none' ); ?>><?php _e( 'No effect', 'myStickymenu' );?></option>
								<option value="slide-in" <?php selected( @$welcomebar['mysticky_welcomebar_entry_effect'], 'slide-in' ); ?>><?php _e( 'Slide in', 'myStickymenu' );?></option>
								<option value="fade" <?php selected( @$welcomebar['mysticky_welcomebar_entry_effect'], 'fade' ); ?>><?php _e( 'Fade', 'myStickymenu' );?></option>
							</select>
						</div>
					</div>
					<div class="mysticky-welcomebar-upgrade-main mysticky_device_upgrade">
						<span class="myStickymenu-upgrade">
							<a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( ' Upgrade Now', 'mystickymenu' );?></a>
						</span>
						<div class="mysticky-welcomebar-setting-content">
							<label><?php _e('Devices', 'myStickymenu'); ?></label>
							<div class="mysticky-welcomebar-setting-content-right">
								<label>
									<input name="mysticky_option_welcomebar[mysticky_welcomebar_device_desktop]" value= "desktop" type="checkbox" checked disabled />
									<?php _e( 'Desktop', 'mystickymenu' );?>
								</label>
								<label>
									<input name="mysticky_option_welcomebar[mysticky_welcomebar_device_mobile]" value= "mobile" type="checkbox" checked disabled />
									<?php _e( 'Mobile', 'mystickymenu' );?>
								</label>
							</div>
						</div>
						<div class="mysticky-welcomebar-setting-content">
							<label><?php _e('Trigger', 'myStickymenu'); ?></label>
							<div class="mysticky-welcomebar-setting-content-right">
								<div class="mysticky-welcomebar-setting-action mysticky-welcomebar-trigger-wrap">
									<label>
										<input type="radio" name="mysticky_option_welcomebar[mysticky_welcomebar_trigger]" value="after_a_few_seconds" checked disabled />&nbsp;<?php _e( 'After a few seconds', 'myStickymenu' );?>
									</label>
									<label>
										<input type="radio" name="mysticky_option_welcomebar[mysticky_welcomebar_trigger]" value="after_scroll" disabled />&nbsp;<?php _e( 'After Scroll', 'myStickymenu' );?>
									</label>
								</div>
								<div class="mysticky-welcomebar-setting-action mysticky-welcomebar-triggersec">
									<div class="px-wrap">
										<input type="number" class="" min="0" step="1" id="mysticky_welcomebar_triggersec" name="mysticky_option_welcomebar[mysticky_welcomebar_triggersec]" value="0" disabled />
										<span class="input-px"><?php echo ( isset($welcomebar['mysticky_welcomebar_trigger']) && $welcomebar['mysticky_welcomebar_trigger'] == 'after_scroll' ) ? '%' : 'Sec'; ?></span>
									</div>
								</div>
							</div>
						</div>
						<div class="mysticky-welcomebar-setting-content">
							<label><?php _e('Expiry date', 'myStickymenu'); ?></label>
							<div class="mysticky-welcomebar-setting-content-right">
								<div class="mysticky-welcomebar-expirydate">
									<input type="text" id="mysticky_welcomebar_expirydate" name="mysticky_option_welcomebar[mysticky_welcomebar_expirydate]" placeholder="<?php _e('No expiry date', 'myStickymenu'); ?>" value="" disabled />
									<span class="dashicons dashicons-calendar-alt"></span>
								</div>
								<div class="mysticky-welcomebar-expirydate-gmt">
									<select name="mysticky_option_welcomebar[mysticky_welcomebar_expirydate_gmt]" id="mysticky_welcomebar_expirydate_gmt" disabled>
										<?php for( $i=12; $i>=-12;$i-- ) { ?>
										<option value="<?php echo $i ?>"><?php echo "GMT " . ( $i>0 ? "+" : "" ).( $i ) ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="mysticky-welcomebar-setting-content show-on-apper">
							<label><?php _e('Page targeting', 'myStickymenu'); ?></label>
							<div class="mysticky-welcomebar-setting-content-right">
								<a href="javascript:void(0);" class="create-rule" id="create-rule"><?php esc_html_e( "Add Rule", "mystickyelements" );?></a>
							</div>
							<?php 
							$url_options = array(
								'page_contains' => 'pages that contain',
								'page_has_url' => 'a specific page',
								'page_start_with' => 'pages starting with',
								'page_end_with' => 'pages ending with',
							);
							?>
							<div class="mysticky-welcomebar-page-options-html" style="display: none">
								<div class="mysticky-welcomebar-page-option">
									<div class="url-content">
										<div class="mysticky-welcomebar-url-select">
											<select name="" id="url_shown_on___count___option">
												<option value="show_on"><?php esc_html_e("Show on", "mysticky" );?></option>
												<option value="not_show_on"><?php esc_html_e("Don't show on", "mysticky" );?></option>
											</select>
										</div>
										<div class="mysticky-welcomebar-url-option">
											<select class="mysticky-welcomebar-url-options" name="" id="url_rules___count___option">
												<option selected="selected" value=""><?php esc_html_e("Select Rule", "mysticky" );?></option>
												<?php foreach($url_options as $key=>$value) {
													echo '<option value="'.$key.'">'.$value.'</option>';
												} ?>
											</select>
										</div>
										<div class="mysticky-welcomebar-url-box">
											<span class='mysticky-welcomebar-url'><?php echo site_url("/"); ?></span>
										</div>
										<div class="mysticky-welcomebar-url-values">
											<input type="text" value="" name="mysticky_option_welcomebar[page_settings][__count__][value]" id="url_rules___count___value" disabled />
										</div>
										<div class="clear"></div>
									</div>
									<span class="myStickymenu-upgrade"><a class="sticky-header-upgrade-now" href="<?php echo esc_url($upgarde_url); ?>" target="_blank"><?php _e( 'Upgrade Now', 'mystickymenu' );?></a></span>
								</div>
							</div>
							<div class="mysticky-welcomebar-page-options mysticky-welcomebar-setting-content-right" id="mysticky-welcomebar-page-options" style="display:none"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="mysticky-welcomebar-setting-right">
				<div class="mysticky-welcomebar-header-title">
					<h3><?php _e('Preview', 'mystickyelements'); ?></h3>
				</div>
				<div class="mysticky-welcomebar-preview-screen">
					<link href="https://fonts.googleapis.com/css?family=<?php echo $welcomebar['mysticky_welcomebar_font'] ?>:400,600,700|Lato:400,500,600,700" rel="stylesheet" type="text/css" class="sfba-google-font">
					<div class="mysticky-welcomebar-fixed mysticky-welcomebar-display-desktop <?php echo $display_main_class; ?>" >
						<div class="mysticky-welcomebar-fixed-wrap">
							<div class="mysticky-welcomebar-content">
								<?php echo wpautop(isset($welcomebar['mysticky_welcomebar_bar_text'])? stripslashes($welcomebar['mysticky_welcomebar_bar_text']) :"Get 30% off your first purchase");?>
							</div>
							<div class="mysticky-welcomebar-btn">
								<a href="#" ><?php echo isset($welcomebar['mysticky_welcomebar_btn_text']) ? stripslashes($welcomebar['mysticky_welcomebar_btn_text']) : "Got it!";?></a>
							</div>
							<a href="javascript:void(0)" class="mysticky-welcomebar-close">X</a>						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mysticky-welcomebar-submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save', 'mystickymenu');?>">
		</div>
		<input type="hidden" name="nonce" value="<?php echo $nonce; ?>">
		<input type="hidden" name="active_tab_element" value="1">
		<input type="hidden" id="save_welcome_bar" name="save_welcome_bar" value="">

	</form>
	<form class="mysticky-welcomebar-form-reset" method="post" action="#">
		<div class="mysticky-welcomebar-submit">
			<input type="submit" name="mysticky_welcomebar_reset" id="reset" class="button button-secondary" value="<?php _e('Reset', 'mystickymenu');?>">
		</div>
		<input type="hidden" name="nonce_reset" value="<?php echo $nonce_reset; ?>">
		<input type="hidden" name="active_tab_element" value="1">
	</form>
	<div id="mysticky-welcomebar-save-confirm" style="display:none;" title="<?php esc_attr_e( 'myStickymenu is currently off', 'mystickymenu' ); ?>">
		<p>
			<?php _e('Your Welcome Bar is currently turned off, would you like to save and show it on your site?', 'mystickymenu' ); ?>
		</p>
	</div>
	
	<div id="mysticky-welcomebar-poptin-popup-confirm" style="display:none;" title="<?php esc_attr_e( 'Poptin pop-up is not configured properly', 'mystickymenu' ); ?>">
		<p>
			Seems like you haven't filled up the Poptin pop-up direct link field properly. Please <a href="https://help.poptin.com/article/show/72942-how-to-show-a-poptin-when-the-visitor-clicks-on-a-button-link-on-your-site" target="_blank">check the guide</a> to know how you can copy direct link of a pop-up from Poptin.
		</p>
	</div>
	<script>
	jQuery(".mysticky-welcomebar-fixed").on(
		"animationend MSAnimationEnd webkitAnimationEnd oAnimationEnd",
		function() {
			jQuery(this).removeClass("animation-start");
		}
	);
	jQuery(document).ready(function() { 
		var container = jQuery(".mysticky-welcomebar-fixed");
        var refreshId = setInterval(function() {
            container.addClass("animation-start");
        }, 3500);
    });
	</script>
	<style>
		.mysticky-welcomebar-fixed {
			background-color: <?php echo $welcomebar['mysticky_welcomebar_bgcolor'] ?>;
			font-family: <?php echo $welcomebar['mysticky_welcomebar_font'] ?>;
			position: absolute;
			left: 0;
			right: 0;
			opacity: 0;
			z-index: 9999999;
			-webkit-transition: all 1s ease 0s;
			-moz-transition: all 1s ease 0s;
			transition: all 1s ease 0s;
		}
		.mysticky-welcomebar-fixed-wrap {
			min-height: 60px;
			padding: 20px 10px 20px 10px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.mysticky-welcomebar-preview-mobile-screen .mysticky-welcomebar-fixed{
			padding: 0 25px;
		}
		.mysticky-welcomebar-position-top {
			top:0;
		}
		.mysticky-welcomebar-position-bottom {
			bottom:0;
		}
		.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in {
			top: -80px;
		}
		.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in {
			bottom: -80px;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect {
			top:0;
			opacity: 1;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect {
			bottom:0;
			opacity: 1;
		}
		.mysticky-welcomebar-entry-effect-fade {
			opacity: 0;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-fade.entry-effect {
			opacity: 1;
		}
		.mysticky-welcomebar-entry-effect-none {
			display: none;
		}
		.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-none.entry-effect {
			display: block;
			opacity: 1;
		}
		.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
			top: 0;			
		}
		.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
			bottom: 0;
		}		
		.mysticky-welcomebar-fixed .mysticky-welcomebar-content p a,
		.mysticky-welcomebar-fixed .mysticky-welcomebar-content p {
			color: <?php echo $welcomebar['mysticky_welcomebar_bgtxtcolor'] ?>;
			font-size: <?php echo $welcomebar['mysticky_welcomebar_fontsize'] ?>px;
			font-family: inherit;
			margin: 0;
			padding: 0;
			line-height: 1.2;
			font-weight: 400;
		}
		.mysticky-welcomebar-fixed .mysticky-welcomebar-btn {
			padding-left: 30px;
			display: none;
		}
		.mysticky-welcomebar-fixed.mysticky-welcomebar-btn-desktop .mysticky-welcomebar-btn {
			display: block;
		}
		.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a {
			background-color: <?php echo $welcomebar['mysticky_welcomebar_btncolor'] ?>;
			font-family: inherit;
			color: <?php echo $welcomebar['mysticky_welcomebar_btntxtcolor'] ?>;
			border-radius: 4px;
			text-decoration: none;
			display: inline-block;
			vertical-align: top;
			line-height: 1.2;
			font-size: <?php echo $welcomebar['mysticky_welcomebar_fontsize'] ?>px;
			font-weight: 400;
			padding: 5px 20px;
			white-space: nowrap;
		}
		.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a:hover {
			/*opacity: 0.7;*/
			-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);
			-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
			box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
		}
		.mysticky-welcomebar-fixed .mysticky-welcomebar-close {
			display: none;
			vertical-align: top;
			width: 20px;
			height: 20px;
			text-align: center;
			text-decoration: none;
			line-height: 20px;
			border-radius: 5px;
			color: #000;
			position: absolute;
			font-family: Lato;
			top: 5px;
			right: 5px;
			text-shadow: 0 0 0px #fff;
			-webkit-transition: all 0.5s ease 0s;
			-moz-transition: all 0.5s ease 0s;
			transition: all 0.5s ease 0s;
			-webkit-transform-origin: 50% 50%;
			-moz-transform-origin: 50% 50%;
			transform-origin: 50% 50%;
		}
		.mysticky-welcomebar-fixed .mysticky-welcomebar-close:hover {
			opacity: 1;
			-webkit-transform: rotate(180deg);
			-moz-transform: rotate(180deg);
			transform: rotate(180deg);
		}
		.mysticky-welcomebar-fixed.mysticky-welcomebar-showx-desktop .mysticky-welcomebar-close {
			display: inline-block;
		}
		@media only screen and (max-width: 1024px) {
			.mysticky-welcomebar-fixed {
				padding: 0 10px 0 10px;
			}
			.mysticky-welcomebar-fixed .mysticky-welcomebar-close {
				width: 20px;
				height: 20px;
				line-height: 20px;
				right: 0px;
			}
		}
		
		/* Animated Buttons */
		.mysticky-welcomebar-btn a {
			-webkit-animation-duration: 1s;
			animation-duration: 1s;
		}
		@-webkit-keyframes flash {
			from,
			50%,
			to {
				opacity: 1;
			}

			25%,
			75% {
				opacity: 0;
			}
		}
		@keyframes flash {
			from,
			50%,
			to {
				opacity: 1;
			}

			25%,
			75% {
				opacity: 0;
			}
		}
		.mysticky-welcomebar-attention-flash.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: flash;
			animation-name: flash;
		}
		
		@keyframes shake {
			from,
			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			10%,
			30%,
			50%,
			70%,
			90% {
				-webkit-transform: translate3d(-10px, 0, 0);
				transform: translate3d(-10px, 0, 0);
			}

			20%,
			40%,
			60%,
			80% {
				-webkit-transform: translate3d(10px, 0, 0);
				transform: translate3d(10px, 0, 0);
			}
		}

		.mysticky-welcomebar-attention-shake.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: shake;
			animation-name: shake;
		}
		
		@-webkit-keyframes swing {
			20% {
				-webkit-transform: rotate3d(0, 0, 1, 15deg);
				transform: rotate3d(0, 0, 1, 15deg);
			}

			40% {
				-webkit-transform: rotate3d(0, 0, 1, -10deg);
				transform: rotate3d(0, 0, 1, -10deg);
			}

			60% {
				-webkit-transform: rotate3d(0, 0, 1, 5deg);
				transform: rotate3d(0, 0, 1, 5deg);
			}

			80% {
				-webkit-transform: rotate3d(0, 0, 1, -5deg);
				transform: rotate3d(0, 0, 1, -5deg);
			}
	
			to {
				-webkit-transform: rotate3d(0, 0, 1, 0deg);
				transform: rotate3d(0, 0, 1, 0deg);
			}
		}

		@keyframes swing {
			20% {
				-webkit-transform: rotate3d(0, 0, 1, 15deg);
				transform: rotate3d(0, 0, 1, 15deg);
			}

			40% {
				-webkit-transform: rotate3d(0, 0, 1, -10deg);
				transform: rotate3d(0, 0, 1, -10deg);
			}

			60% {
				-webkit-transform: rotate3d(0, 0, 1, 5deg);
				transform: rotate3d(0, 0, 1, 5deg);
			}

			80% {
				-webkit-transform: rotate3d(0, 0, 1, -5deg);
				transform: rotate3d(0, 0, 1, -5deg);
			}

			to {
				-webkit-transform: rotate3d(0, 0, 1, 0deg);
				transform: rotate3d(0, 0, 1, 0deg);
			}
		}

		.mysticky-welcomebar-attention-swing.animation-start .mysticky-welcomebar-btn a {
			-webkit-transform-origin: top center;
			transform-origin: top center;
			-webkit-animation-name: swing;
			animation-name: swing;
		}
		
		@-webkit-keyframes tada {
			from {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}

			10%,
			20% {
				-webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
			}

			30%,
			50%,
			70%,
			90% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
			}

			40%,
			60%,
			80% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
			}

			to {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}
		}

		@keyframes tada {
			from {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}

			10%,
			20% {
				-webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
			}

			30%,
			50%,
			70%,
			90% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
			}

			40%,
			60%,
			80% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
			}

			to {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}
		}

		.mysticky-welcomebar-attention-tada.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: tada;
			animation-name: tada;
		}
		
		@-webkit-keyframes heartBeat {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			14% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			28% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			42% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			70% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}
		}

		@keyframes heartBeat {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			14% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			28% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			42% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			70% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}
		}

		.mysticky-welcomebar-attention-heartbeat.animation-start .mysticky-welcomebar-btn a {
		  -webkit-animation-name: heartBeat;
		  animation-name: heartBeat;
		  -webkit-animation-duration: 1.3s;
		  animation-duration: 1.3s;
		  -webkit-animation-timing-function: ease-in-out;
		  animation-timing-function: ease-in-out;
		}
		
		@-webkit-keyframes wobble {
			from {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			15% {
				-webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
				transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
			}

			30% {
				-webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
				transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
			}

			45% {
				-webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
				transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
			}

			60% {
				-webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
				transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
			}

			75% {
				-webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
				transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
			}

			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
		}

		@keyframes wobble {
			from {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			15% {
				-webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
				transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
			}

			30% {
				-webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
				transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
			}

			45% {
				-webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
				transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
			}

			60% {
				-webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
				transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
			}

			75% {
				-webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
				transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
			}

			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
		}
		
		.mysticky-welcomebar-attention-wobble.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: wobble;
			animation-name: wobble;
		}
	</style>

	<?php
}

function mysticky_welcomebar_pro_widget_default_fields() {
	return array(
			'mysticky_welcomebar_position' 			=> 'top',
			'mysticky_welcomebar_height' 			=> '60',
			'mysticky_welcomebar_bgcolor' 			=> '#03ed96',
			'mysticky_welcomebar_bgtxtcolor' 		=> '#000000',
			'mysticky_welcomebar_font' 				=> 'Poppins',
			'mysticky_welcomebar_fontsize' 			=> '16',
			'mysticky_welcomebar_bar_text' 			=> 'Get 30% off your first purchase',
			'mysticky_welcomebar_x_desktop' 		=> 'desktop',
			'mysticky_welcomebar_x_mobile' 			=> 'mobile',
			'mysticky_welcomebar_btn_desktop' 		=> 'desktop',
			'mysticky_welcomebar_btn_mobile' 		=> 'mobile',
			'mysticky_welcomebar_btncolor' 			=> '#000000',
			'mysticky_welcomebar_btntxtcolor' 		=> '#ffffff',
			'mysticky_welcomebar_btn_text' 			=> 'Got it!',
			'mysticky_welcomebar_actionselect'		=> 'close_bar',
			'mysticky_welcomebar_aftersubmission'	=> 'dont_show_welcomebar',
			'mysticky_welcomebar_redirect' 			=> 'https://www.yourdomain.com',
			'mysticky_welcomebar_redirect_newtab' 	=> '',
			'mysticky_welcomebar_redirect_rel' 		=> '',
			'mysticky_welcomebar_device_desktop'	=> 'desktop',
			'mysticky_welcomebar_device_mobile' 	=> 'mobile',
			'mysticky_welcomebar_entry_effect'		=> 'slide-in',
			'mysticky_welcomebar_trigger' 			=> 'after_a_few_seconds',
			'mysticky_welcomebar_triggersec' 		=> '0',
			'mysticky_welcomebar_expirydate' 		=> '',
			'mysticky_welcomebar_page_settings' 	=> '',
	);
}

function mysticky_welcome_bar_frontend(){
	$welcomebar = get_option( 'mysticky_option_welcomebar' );

	if ( ( isset($welcomebar['mysticky_welcomebar_expirydate']) && $welcomebar['mysticky_welcomebar_expirydate'] !='' && strtotime( date('m/d/Y')) > strtotime($welcomebar['mysticky_welcomebar_expirydate']) ) || !isset($welcomebar['mysticky_welcomebar_enable'] ) ) {
		return;
	}
	$mysticky_welcomebar_showx_desktop = $mysticky_welcomebar_showx_mobile = '';
	$mysticky_welcomebar_btn_desktop = $mysticky_welcomebar_btn_mobile = '';
	$mysticky_welcomebar_display_desktop = $mysticky_welcomebar_display_mobile = '';
	if( isset($welcomebar['mysticky_welcomebar_x_desktop']) ) {
		$mysticky_welcomebar_showx_desktop = ' mysticky-welcomebar-showx-desktop';
	}
	if( isset($welcomebar['mysticky_welcomebar_x_mobile']) ) {
		$mysticky_welcomebar_showx_mobile = ' mysticky-welcomebar-showx-mobile';
	}
	if( isset($welcomebar['mysticky_welcomebar_btn_desktop']) ) {
		$mysticky_welcomebar_btn_desktop = ' mysticky-welcomebar-btn-desktop';
	}
	if( isset($welcomebar['mysticky_welcomebar_btn_mobile']) ) {
		$mysticky_welcomebar_btn_mobile = ' mysticky-welcomebar-btn-mobile';
	}
	$display = ' mysticky-welcomebar-attention-'.$welcomebar['mysticky_welcomebar_attentionselect'];
	$display_entry_effect = (isset($welcomebar['mysticky_welcomebar_entry_effect'])) ? ' mysticky-welcomebar-entry-effect-'.$welcomebar['mysticky_welcomebar_entry_effect'] : ' mysticky-welcomebar-entry-effect-slide-in';
	$mysticky_welcomebar_display_desktop = ' mysticky-welcomebar-display-desktop';
	$mysticky_welcomebar_display_mobile = ' mysticky-welcomebar-display-mobile';
	
	$display_main_class = "mysticky-welcomebar-position-" . $welcomebar['mysticky_welcomebar_position'] . $mysticky_welcomebar_showx_desktop . $mysticky_welcomebar_showx_mobile . $mysticky_welcomebar_btn_desktop . $mysticky_welcomebar_btn_mobile . $mysticky_welcomebar_display_desktop . $mysticky_welcomebar_display_mobile .$display . $display_entry_effect;

	if( isset($welcomebar['mysticky_welcomebar_actionselect']) ) {
		
		if( $welcomebar['mysticky_welcomebar_actionselect'] == 'redirect_to_url' ) {
				$mysticky_welcomebar_actionselect_url = esc_url( $welcomebar['mysticky_welcomebar_redirect'] );
			} else if( $welcomebar['mysticky_welcomebar_actionselect'] == 'poptin_popup'){
				$mysticky_welcomebar_actionselect_url = esc_url( $welcomebar['mysticky_welcomebar_poptin_popup_link'] );
			} else {
				$mysticky_welcomebar_actionselect_url = 'javascript:void(0)';
			}
	}	

	?>
	<div class="mysticky-welcomebar-fixed <?php echo $display_main_class; ?>" style="<?php //echo $welcomebar_enable_block; ?>" data-after-triger="after_a_few_seconds" data-triger-sec="0" data-position="<?php echo esc_attr($welcomebar['mysticky_welcomebar_position']);?>" data-height="<?php echo esc_attr($welcomebar['mysticky_welcomebar_height']);?>" data-rediect="<?php echo esc_attr($welcomebar['mysticky_welcomebar_actionselect']);?>" data-aftersubmission="<?php echo esc_attr($welcomebar['mysticky_welcomebar_aftersubmission']);?>">
		<div class="mysticky-welcomebar-fixed-wrap">
			<div class="mysticky-welcomebar-content">
				<?php echo wpautop( isset($welcomebar['mysticky_welcomebar_bar_text'])? stripslashes($welcomebar['mysticky_welcomebar_bar_text']) :"Get 30% off your first purchase" );?>
			</div>
			<div class="mysticky-welcomebar-btn">
				<a href="<?php echo $mysticky_welcomebar_actionselect_url; ?>" <?php if( isset($welcomebar['mysticky_welcomebar_redirect_newtab']) && $welcomebar['mysticky_welcomebar_actionselect'] == 'redirect_to_url' && $welcomebar['mysticky_welcomebar_redirect_newtab']== 1):?> target="_blank" <?php endif;?>><?php echo isset($welcomebar['mysticky_welcomebar_btn_text'])? stripslashes($welcomebar['mysticky_welcomebar_btn_text']) :"Got it!";?></a>
			</div>
			<a href="javascript:void(0)" class="mysticky-welcomebar-close">X</a>		
		</div>
	</div>
	<script>

	jQuery(document).ready(function($){
		var adminBarHeight = 0;
		if ( $("#wpadminbar").length != 0 ){
			var adminBarHeight = $('#wpadminbar').height();
		}
		var mysticky_welcomebar_height = adminBarHeight + jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
		if( jQuery( '.mysticky-welcomebar-fixed' ).data('position') == 'top' ) {
			jQuery( '.mysticky-welcomebar-entry-effect-slide-in.mysticky-welcomebar-fixed' ).css( 'top', '-' + mysticky_welcomebar_height + 'px' );
		} else {
			jQuery( '.mysticky-welcomebar-entry-effect-slide-in.mysticky-welcomebar-fixed' ).css( 'bottom', '-' + mysticky_welcomebar_height + 'px' );
		}
		var divi_topbar_height = $( '.et_fixed_nav #top-header' ).outerHeight();
		var divi_total_height = mysticky_welcomebar_height + divi_topbar_height;
		var welcombar_aftersubmission = $( '.mysticky-welcomebar-fixed' ).data('aftersubmission');
		if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
			var welcomebar_storage = localStorage.getItem("welcomebar_close");
		} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
			var welcomebar_storage = sessionStorage.getItem("welcomebar_close");
		} else {
			sessionStorage.removeItem('welcomebar_close');
			localStorage.removeItem('welcomebar_close');
			var welcomebar_storage = null;
		}
		if ( welcomebar_storage === null ){

			var after_trigger = jQuery( '.mysticky-welcomebar-fixed' ).data('after-triger');
			
			jQuery( 'body' ).addClass( 'mysticky-welcomebar-apper' );

			if ( after_trigger == 'after_a_few_seconds' ) {
				
				if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-desktop' ) ) {
					if ( $( window ).width() > 767 ) {
						var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
						var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
						var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
						
						setTimeout(function(){
							jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
							$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
							if ( welcombar_position == 'top' ) {								
								
								jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', (adminBarHeight + 0) + 'px' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-bottom', '' );
								jQuery( '#mysticky_divi_style' ).remove();
								jQuery( '.et_fixed_nav #top-header' ).css( 'top', welcombar_height + 'px' );
								jQuery( 'head' ).append( '<style id="mysticky_divi_style" type="text/css">.et_fixed_nav #main-header {top: ' + welcombar_height + 'px !important}.et_fixed_nav #top-header + #main-header{top: ' + divi_total_height + 'px !important}</style>' );
								$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
								$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
							} else {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-top', '' );
								jQuery( '#mysticky_divi_style' ).remove();
								jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
								$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
							}
						}, trigger_sec );
					}
				}
			}
			if ( $( window ).width() < 767 ) {
				if ( after_trigger == 'after_a_few_seconds' ) {
					if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
						var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
						var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
						var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
						setTimeout(function(){
							jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
							$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
							jQuery( '#mysticky_divi_style' ).remove();
							jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );							
							if ( welcombar_position == 'top' ) {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight + 0) + 'px' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-bottom', '' );
								$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
								$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
							} else {
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
								jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
								$( 'html' ).css( 'margin-top', '' );
								$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
							}
						}, trigger_sec );
					}
				}
			}
			mystickyelements_present();
		}
		$( window ).resize( function(){
			var mysticky_welcomebar_height = jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
			if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
				var welcomebar_storage = localStorage.getItem("welcomebar_close");
			} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
				var welcomebar_storage = sessionStorage.getItem("welcomebar_close");
			} else {
				sessionStorage.removeItem('welcomebar_close');
				localStorage.removeItem('welcomebar_close');
				var welcomebar_storage = null;
			}
			if ( welcomebar_storage === null ){
				var after_trigger = jQuery( '.mysticky-welcomebar-fixed' ).data('after-triger');
				if ( ! $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-notapper' ) ) {
					jQuery( 'body' ).addClass( 'mysticky-welcomebar-apper' );
				} else {
					jQuery( 'body' ).removeClass( 'mysticky-welcomebar-apper' );
				}
				if ( after_trigger == 'after_a_few_seconds' ) {
					var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
					var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
					var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
					if ( $( window ).width() < 767 ) {
						if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
							setTimeout(function(){
								jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
								$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
								jQuery( '#mysticky_divi_style' ).remove();
								jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
								if ( welcombar_position == 'top' ) {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight +  0) + 'px' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-bottom', '' );
									$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
									$( '.mysticky-welcomebar-apper #mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
								} else {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-top', '' );
									$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
								}
							}, trigger_sec );
						}
					} else {
						if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-desktop' ) ) {
							setTimeout(function(){
								jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
								$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
								if ( welcombar_position == 'top' ) {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight + 0) + 'px' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-bottom', '' );
									jQuery( '#mysticky_divi_style' ).remove();
									jQuery( '.mysticky-welcomebar-apper.et_fixed_nav #top-header' ).css( 'top', welcombar_height + 'px' );
									jQuery( 'head' ).append( '<style id="mysticky_divi_style" type="text/css">.mysticky-welcomebar-apper.et_fixed_nav #main-header {top: ' + welcombar_height + 'px !important}.mysticky-welcomebar-apper.et_fixed_nav #top-header + #main-header{top: ' + divi_total_height + 'px !important}</style>' );
									$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
									$( '.mysticky-welcomebar-apper #mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
								} else {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-top', '' );
									jQuery( '#mysticky_divi_style' ).remove();
									jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
									$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
								}
							}, trigger_sec );
						}
					}
				}
				mystickyelements_present();
			}
		} );

		jQuery(window).on( 'scroll', function(){			
			if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
				var welcomebar_storage = localStorage.getItem("welcomebar_close");
			} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
				var welcomebar_storage = sessionStorage.getItem("welcomebar_close");
			} else {
				sessionStorage.removeItem('welcomebar_close');
				localStorage.removeItem('welcomebar_close');
				var welcomebar_storage = null;
			}
			if ( welcomebar_storage === null ){
				var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
				var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
				if ( welcombar_position == 'top' ) {
					$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
				}
				if ( after_trigger === 'after_scroll' ) {
					var scroll = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
					var after_scroll_val = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec');
					var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
					var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
					if( scroll > after_scroll_val ) {
						if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-desktop' ) ) {
							if ( $( window ).width() > 767 ) {
								jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
								$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
								if ( welcombar_position == 'top' ) {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', (adminBarHeight+ 0 ) + 'px' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-bottom', '' );
									$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
									$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
								} else {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-top', '' );
									$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
								}
							}
						}
						if ( $( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
							if ( $( window ).width() < 767 ) {
								jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-animation' );
								$( '.mysticky-welcomebar-fixed' ).addClass( 'entry-effect' );
								if ( welcombar_position == 'top' ) {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight +0 ) + 'px' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-bottom', '' );
									$( 'html' ).attr( 'style', 'margin-top: ' + mysticky_welcomebar_height + 'px !important' );
									$( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
								} else {
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '0' );
									jQuery( '.mysticky-welcomebar-fixed' ).css( 'opacity', '1' );
									$( 'html' ).css( 'margin-top', '' );
									$( 'html' ).attr( 'style', 'margin-bottom: ' + mysticky_welcomebar_height + 'px !important' );
								}
							}
						}
					}
				}
				mystickyelements_present();
			}

		});
		
		jQuery( '.mysticky-welcomebar-close, .mysticky-welcomebar-btn a' ).on( 'click', function(){
			if( welcombar_aftersubmission != 'show_welcomebar_every_page' ){
				if( welcombar_aftersubmission == 'dont_show_welcomebar' ){
					sessionStorage.removeItem('welcomebar_close');
					localStorage.setItem('welcomebar_close', 'close');
				} else if( welcombar_aftersubmission == 'show_welcomebar_next_visit' ) {
					localStorage.removeItem('welcomebar_close');
					sessionStorage.setItem('welcomebar_close', 'close');
				}
			}
			var welcombar_position = $( '.mysticky-welcomebar-fixed' ).data('position');
			var welcombar_height = $( '.mysticky-welcomebar-fixed' ).outerHeight();
			jQuery( '.mysticky-welcomebar-fixed' ).addClass( 'mysticky-welcomebar-notapper' );
			jQuery( 'body' ).removeClass( 'mysticky-welcomebar-apper' );
			jQuery( '.mysticky-welcomebar-fixed' ).slideUp( 'slow' );
			if ( welcombar_position == 'top' ) {
				jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', '-' + mysticky_welcomebar_height + 'px' );
			} else {
				jQuery( '.mysticky-welcomebar-fixed' ).css( 'bottom', '-' + mysticky_welcomebar_height + 'px' );
			}
			jQuery( '#mysticky_divi_style' ).remove();
			jQuery( '.et_fixed_nav #top-header' ).css( 'top', '' );
			jQuery( 'html' ).css( 'margin-top', '' );
			jQuery( 'html' ).css( 'margin-bottom', '' );
			$( '#mysticky-nav' ).css( 'top', '0px' );
			/*if mystickyelements show*/
			var mystickyelements_show = $( '.mystickyelements-fixed' ).length;
			if( mystickyelements_show && $( window ).width() <= 1024 && $( '.mystickyelements-fixed' ).hasClass( 'mystickyelements-position-mobile-top' ) && welcombar_position == 'top' ) {
				var mystickyelements_height 	  = $( '.mystickyelements-fixed' ).height();
				$( '.mystickyelements-fixed' ).css( 'top', '' );
				$( 'html' ).attr( 'style', 'margin-top: ' + mystickyelements_height + 'px !important' );
			}
		} );
	});
	function mystickyelements_present() {
		var after_trigger 		  = jQuery( '.mysticky-welcomebar-fixed' ).data('after-triger');
		var mystickyelements_show = jQuery( '.mystickyelements-fixed' ).length;		
		var welcombar_position 			  = jQuery( '.mysticky-welcomebar-fixed' ).data('position');
		var adminBarHeight = 0;
		if ( jQuery("#wpadminbar").length != 0 ){
			var adminBarHeight = jQuery('#wpadminbar').height();
		}
		
		if ( jQuery( window ).width() <= 600 && jQuery(window).scrollTop() != 0 && welcombar_position == 'top') {
			jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', '0px' );
			var welcombar_height = jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
			jQuery( '#mysticky-nav' ).css( 'top', welcombar_height + 'px' );
		} else if ( welcombar_position == 'top' ) {
			var mysticky_welcomebar_height = adminBarHeight + jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
			jQuery( '.mysticky-welcomebar-fixed' ).css( 'top', ( adminBarHeight + 0) + 'px' );			
			jQuery( '#mysticky-nav' ).css( 'top', mysticky_welcomebar_height + 'px' );
		}
		if( mystickyelements_show ) {
			
			var welcombar_height 			  = jQuery( '.mysticky-welcomebar-fixed' ).outerHeight();
			var mystickyelements_height 	  = jQuery( '.mystickyelements-fixed' ).height();
			var mystickyelements_total_height = welcombar_height + mystickyelements_height;
			if ( jQuery( window ).width() <= 1024 && jQuery( '.mystickyelements-fixed' ).hasClass( 'mystickyelements-position-mobile-top' ) ) {
				if ( after_trigger == 'after_a_few_seconds' ) {
					if ( jQuery( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
						var trigger_sec = jQuery( '.mysticky-welcomebar-fixed' ).data('triger-sec') * 1000;
						setTimeout(function(){
							if ( welcombar_position == 'top' ) {
								jQuery( '.mystickyelements-fixed' ).css( 'top', welcombar_height );
								jQuery( 'html' ).attr( 'style', 'margin-top: ' + mystickyelements_total_height + 'px !important' );
							} else {
								jQuery( '.mystickyelements-fixed' ).css( 'top', '' );
								jQuery( 'html' ).attr( 'style', 'margin-bottom: ' + welcombar_height + 'px !important' );
							}
						}, trigger_sec );
					}
				} else if ( after_trigger === 'after_scroll' ) {
					var scroll = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
					var after_scroll_val = $( '.mysticky-welcomebar-fixed' ).data('triger-sec');
					if( scroll > after_scroll_val ) {
						if ( jQuery( '.mysticky-welcomebar-fixed' ).hasClass( 'mysticky-welcomebar-display-mobile' ) ) {
							if ( welcombar_position == 'top' ) {
								jQuery( '.mystickyelements-fixed' ).css( 'top', welcombar_height );
								jQuery( 'html' ).attr( 'style', 'margin-top: ' + mystickyelements_total_height + 'px !important' );
							} else {
								jQuery( '.mystickyelements-fixed' ).css( 'top', '' );
								jQuery( 'html' ).attr( 'style', 'margin-bottom: ' + welcombar_height + 'px !important' );
							}
						}
					}
				}
			}
		}
	}
	jQuery(".mysticky-welcomebar-fixed").on(
		"animationend MSAnimationEnd webkitAnimationEnd oAnimationEnd",
		function() {
			jQuery(this).removeClass("animation-start");
		}
	);
	jQuery(document).ready(function() { 
		var container = jQuery(".mysticky-welcomebar-fixed");
        var refreshId = setInterval(function() {
            container.addClass("animation-start");
        }, 3500);
    });
	
	</script>
	<style>
	.mysticky-welcomebar-fixed , .mysticky-welcomebar-fixed * {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.mysticky-welcomebar-fixed {
		background-color: <?php echo $welcomebar['mysticky_welcomebar_bgcolor'] ?>;
		font-family: <?php echo $welcomebar['mysticky_welcomebar_font'] ?>;
		position: fixed;
		left: 0;
		right: 0;
		z-index: 9999999;
		opacity: 0;
	}
	.mysticky-welcomebar-fixed-wrap {
		min-height: 60px;
		padding: 20px 50px;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100%;
		height: 100%;
	}
	.mysticky-welcomebar-animation {
		-webkit-transition: all 1s ease 0s;
		-moz-transition: all 1s ease 0s;
		transition: all 1s ease 0s;
	}
	.mysticky-welcomebar-position-top {
		top:0;
	}
	.mysticky-welcomebar-position-bottom {
		bottom:0;
	}
	.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in {
		top: -60px;
	}
	.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in {
		bottom: -60px;
	}
	.mysticky-welcomebar-entry-effect-fade {
		opacity: 0;
	}
	.mysticky-welcomebar-entry-effect-none {
		display: none;
	}
	.mysticky-welcomebar-fixed .mysticky-welcomebar-content p a,
	.mysticky-welcomebar-fixed .mysticky-welcomebar-content p {
		color: <?php echo $welcomebar['mysticky_welcomebar_bgtxtcolor'] ?>;
		font-size: <?php echo $welcomebar['mysticky_welcomebar_fontsize'] ?>px;
		margin: 0;
		padding: 0;
		line-height: 1.2;
		font-family: inherit;
		font-weight: 400;
	}
	.mysticky-welcomebar-fixed .mysticky-welcomebar-btn {
		padding-left: 30px;
		display: none;
		line-height: 1;
	}
	.mysticky-welcomebar-fixed.mysticky-welcomebar-btn-desktop .mysticky-welcomebar-btn {
		display: block;
	}
	.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a {
		background-color: <?php echo $welcomebar['mysticky_welcomebar_btncolor'] ?>;
		font-family: inherit;
		color: <?php echo $welcomebar['mysticky_welcomebar_btntxtcolor'] ?>;
		border-radius: 4px;
		text-decoration: none;
		display: inline-block;
		vertical-align: top;
		line-height: 1.2;
		font-size: <?php echo $welcomebar['mysticky_welcomebar_fontsize'] ?>px;
		font-weight: 400;
		padding: 5px 20px;
		white-space: nowrap;
	}
	.mysticky-welcomebar-fixed .mysticky-welcomebar-btn a:hover {
		/*opacity: 0.7;*/
		-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);
		-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
		box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.5);
	}
	.mysticky-welcomebar-fixed .mysticky-welcomebar-close {
		display: none;
		vertical-align: top;
		width: 30px;
		height: 30px;
		text-align: center;
		line-height: 30px;
		border-radius: 5px;
		color: #000;
		position: absolute;
		top: 5px;
		right: 10px;
		outline: none;
		font-family: Lato; 
		text-decoration: none;
		text-shadow: 0 0 0px #fff;
		-webkit-transition: all 0.5s ease 0s;
		-moz-transition: all 0.5s ease 0s;
		transition: all 0.5s ease 0s;
		-webkit-transform-origin: 50% 50%;
		-moz-transform-origin: 50% 50%;
		transform-origin: 50% 50%;
	}
	.mysticky-welcomebar-fixed .mysticky-welcomebar-close:hover {
		opacity: 1;
		-webkit-transform: rotate(180deg);
		-moz-transform: rotate(180deg);
		transform: rotate(180deg);
	}
	.mysticky-welcomebar-fixed .mysticky-welcomebar-close span.dashicons {
		font-size: 27px;
	}
	.mysticky-welcomebar-fixed.mysticky-welcomebar-showx-desktop .mysticky-welcomebar-close {
		display: inline-block;
	}	
	
	/* Animated Buttons */
		.mysticky-welcomebar-btn a {
			-webkit-animation-duration: 1s;
			animation-duration: 1s;
		}
		@-webkit-keyframes flash {
			from,
			50%,
			to {
				opacity: 1;
			}

			25%,
			75% {
				opacity: 0;
			}
		}
		@keyframes flash {
			from,
			50%,
			to {
				opacity: 1;
			}

			25%,
			75% {
				opacity: 0;
			}
		}
		.mysticky-welcomebar-attention-flash.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: flash;
			animation-name: flash;
		}
		
		@keyframes shake {
			from,
			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			10%,
			30%,
			50%,
			70%,
			90% {
				-webkit-transform: translate3d(-10px, 0, 0);
				transform: translate3d(-10px, 0, 0);
			}

			20%,
			40%,
			60%,
			80% {
				-webkit-transform: translate3d(10px, 0, 0);
				transform: translate3d(10px, 0, 0);
			}
		}

		.mysticky-welcomebar-attention-shake.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: shake;
			animation-name: shake;
		}
		
		@-webkit-keyframes swing {
			20% {
				-webkit-transform: rotate3d(0, 0, 1, 15deg);
				transform: rotate3d(0, 0, 1, 15deg);
			}

			40% {
				-webkit-transform: rotate3d(0, 0, 1, -10deg);
				transform: rotate3d(0, 0, 1, -10deg);
			}

			60% {
				-webkit-transform: rotate3d(0, 0, 1, 5deg);
				transform: rotate3d(0, 0, 1, 5deg);
			}

			80% {
				-webkit-transform: rotate3d(0, 0, 1, -5deg);
				transform: rotate3d(0, 0, 1, -5deg);
			}
	
			to {
				-webkit-transform: rotate3d(0, 0, 1, 0deg);
				transform: rotate3d(0, 0, 1, 0deg);
			}
		}

		@keyframes swing {
			20% {
				-webkit-transform: rotate3d(0, 0, 1, 15deg);
				transform: rotate3d(0, 0, 1, 15deg);
			}

			40% {
				-webkit-transform: rotate3d(0, 0, 1, -10deg);
				transform: rotate3d(0, 0, 1, -10deg);
			}

			60% {
				-webkit-transform: rotate3d(0, 0, 1, 5deg);
				transform: rotate3d(0, 0, 1, 5deg);
			}

			80% {
				-webkit-transform: rotate3d(0, 0, 1, -5deg);
				transform: rotate3d(0, 0, 1, -5deg);
			}

			to {
				-webkit-transform: rotate3d(0, 0, 1, 0deg);
				transform: rotate3d(0, 0, 1, 0deg);
			}
		}

		.mysticky-welcomebar-attention-swing.animation-start .mysticky-welcomebar-btn a {
			-webkit-transform-origin: top center;
			transform-origin: top center;
			-webkit-animation-name: swing;
			animation-name: swing;
		}
		
		@-webkit-keyframes tada {
			from {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}

			10%,
			20% {
				-webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
			}

			30%,
			50%,
			70%,
			90% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
			}

			40%,
			60%,
			80% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
			}

			to {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}
		}

		@keyframes tada {
			from {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}

			10%,
			20% {
				-webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
			}

			30%,
			50%,
			70%,
			90% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
			}

			40%,
			60%,
			80% {
				-webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
				transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
			}

			to {
				-webkit-transform: scale3d(1, 1, 1);
				transform: scale3d(1, 1, 1);
			}
		}

		.mysticky-welcomebar-attention-tada.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: tada;
			animation-name: tada;
		}
		
		@-webkit-keyframes heartBeat {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			14% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			28% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			42% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			70% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}
		}

		@keyframes heartBeat {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			14% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			28% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}

			42% {
				-webkit-transform: scale(1.3);
				transform: scale(1.3);
			}

			70% {
				-webkit-transform: scale(1);
				transform: scale(1);
			}
		}

		.mysticky-welcomebar-attention-heartbeat.animation-start .mysticky-welcomebar-btn a {
		  -webkit-animation-name: heartBeat;
		  animation-name: heartBeat;
		  -webkit-animation-duration: 1.3s;
		  animation-duration: 1.3s;
		  -webkit-animation-timing-function: ease-in-out;
		  animation-timing-function: ease-in-out;
		}
		
		@-webkit-keyframes wobble {
			from {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			15% {
				-webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
				transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
			}

			30% {
				-webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
				transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
			}

			45% {
				-webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
				transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
			}

			60% {
				-webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
				transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
			}

			75% {
				-webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
				transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
			}

			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
		}

		@keyframes wobble {
			from {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}

			15% {
				-webkit-transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
				transform: translate3d(-25%, 0, 0) rotate3d(0, 0, 1, -5deg);
			}

			30% {
				-webkit-transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
				transform: translate3d(20%, 0, 0) rotate3d(0, 0, 1, 3deg);
			}

			45% {
				-webkit-transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
				transform: translate3d(-15%, 0, 0) rotate3d(0, 0, 1, -3deg);
			}

			60% {
				-webkit-transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
				transform: translate3d(10%, 0, 0) rotate3d(0, 0, 1, 2deg);
			}

			75% {
				-webkit-transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
				transform: translate3d(-5%, 0, 0) rotate3d(0, 0, 1, -1deg);
			}

			to {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
		}
		
		.mysticky-welcomebar-attention-wobble.animation-start .mysticky-welcomebar-btn a {
			-webkit-animation-name: wobble;
			animation-name: wobble;
		}
		@media only screen and (min-width: 768px) {
			.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-fade.entry-effect {
				opacity: 1;
			}
			.mysticky-welcomebar-display-desktop.mysticky-welcomebar-entry-effect-none.entry-effect {
				display: block;
			}
			.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-top.mysticky-welcomebar-fixed ,
			.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
				top: 0;			
			}
			.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-bottom.mysticky-welcomebar-fixed ,
			.mysticky-welcomebar-display-desktop.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
				bottom: 0;
			}	
		}
		@media only screen and (max-width: 767px) {
			.mysticky-welcomebar-display-mobile.mysticky-welcomebar-entry-effect-fade.entry-effect {
				opacity: 1;
			}
			.mysticky-welcomebar-display-mobile.mysticky-welcomebar-entry-effect-none.entry-effect {
				display: block;
			}
			.mysticky-welcomebar-display-mobile.mysticky-welcomebar-position-top.mysticky-welcomebar-fixed ,
			.mysticky-welcomebar-display-mobile.mysticky-welcomebar-position-top.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
				top: 0;
			}
			.mysticky-welcomebar-display-mobile.mysticky-welcomebar-position-bottom.mysticky-welcomebar-fixed ,
			.mysticky-welcomebar-display-mobile.mysticky-welcomebar-position-bottom.mysticky-welcomebar-entry-effect-slide-in.entry-effect.mysticky-welcomebar-fixed {
				bottom: 0;
			}
			.mysticky-welcomebar-fixed.mysticky-welcomebar-showx-desktop .mysticky-welcomebar-close {
				display: none;
			}
			.mysticky-welcomebar-fixed.mysticky-welcomebar-showx-mobile .mysticky-welcomebar-close {
				display: inline-block;
			}
			.mysticky-welcomebar-fixed.mysticky-welcomebar-btn-desktop .mysticky-welcomebar-btn {
				display: none;
			}
			.mysticky-welcomebar-fixed.mysticky-welcomebar-btn-mobile .mysticky-welcomebar-btn {
				display: block;
			}
		}
		@media only screen and (max-width: 480px) {
			.mysticky-welcomebar-fixed-wrap {
				padding: 15px 36px 35px 10px;
			}
			.mysticky-welcomebar-fixed .mysticky-welcomebar-btn {
				padding-left: 10px;
			}
			.mysticky-welcomebar-fixed .mysticky-welcomebar-close {
				right: 7px;
			}
		}
		body.mysticky-welcomebar-apper #wpadminbar{
			z-index:99999999;
		}
	</style>
	<?php
}
add_action( 'wp_footer', 'mysticky_welcome_bar_frontend' );