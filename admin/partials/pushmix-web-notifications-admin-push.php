<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/pushmix/web-notification
 * @since      1.0.0
 *
 * @package    Pushmix_Web_Notifications
 * @subpackage Pushmix_Web_Notifications/admin/partials
 */

?>

<!-- Wrap -->
<div class="wrap">


<h1>Pushmix - Web Push Notifications</h1>
<?php settings_errors(); ?>


<!-- Widget Wrap -->
<div id="dashboard-widgets-wrap">

	<!-- Dashboard Widget -->
	<div id="dashboard-widgets" class="metabox-holder">



		<!-- Audience Container 1 -->
		<div id="postbox-container-1" class="postbox-container">

			<div id="normal-sortables" class="meta-box-sortables ui-sortable"> 
			
				<div id="dashboard_quick_press" class="postbox mh-255">

					<h2 class="hndle">1. Audience</h2>

					<div class="inside m-12">

						<div class="input-text-wrap mb-1" id="title-wrap">
							<label class="pl-02" for="topic">Audience List</label>
							<select name="topic" id="topic">
							<option selected="selected" value="publish">Published</option>
							<option value="pending">Pending Review</option>
							<option value="draft">Draft</option>
							</select>
						 
						</div>

						<div class="input-text-wrap mb-1" id="title-wrap">
						
							<label class="pl-02" for="priority">Priority</label>
							<select name="priority" id="priority">
								<option value="high" selected="selected">High</option>
								<option value="normal">Normal</option>
							</select>
						 
						</div>

						<div class="input-text-wrap" id="title-wrap">
							<label class="pl-02" for="time_to_live">Lifespan</label>
							<select name="time_to_live" id="time_to_live">
								<option value="3600" selected="selected">1 Hour</option>
								<option value="14400">4 Hours</option>
								<option value="28800">8 Hours</option>
								<option value="57600">16 Hours</option>
								<option value="86400">24 Hours</option>
								<option value="172800">2 Days</option>
								<option value="604800">7 Days</option>
								<option value="1209600">2 Weeks</option>
								<option value="1814400">3 Weeks</option>
								<option value="2419200">4 Weeks</option>
							</select>
						 
						</div>												

	

				

					</div>

				</div>

			</div>
			

		</div>
		<!-- END Audience Container 1 -->
	

		<!-- Content Container 2 -->
		<div id="postbox-container-1" class="postbox-container">

			<div id="normal-sortables" class="meta-box-sortables ui-sortable"> 
			
				<div id="dashboard_quick_press" class="postbox mh-255">

					<h2 class="hndle">2. Content</h2>

					<div class="inside m-12">


						<div class="input-text-wrap mb-2" id="title-wrap">
							<label class="prompt" for="title" id="title-prompt-text">
								Notification Title
							</label>

							<input type="text" name="post_title" id="title" autocomplete="off">
						</div>

						<div class="textarea-wrap mb-1" id="description-wrap">
							<label class="prompt" for="content" id="content-prompt-text">Notification body (keep it short)</label>
							<textarea name="content" id="content" class="mceEditor" rows="3" cols="15" autocomplete="off"></textarea>
						</div>

						<div class="input-text-wrap mb-1" id="title-wrap">
							<label class="prompt" for="url" id="title-prompt-text">
								URL
							</label>

							<input type="text" name="url" id="url" autocomplete="off">
						</div>	

				

					</div>

				</div>

			</div>
			

		</div>
		<!-- END Content Container 2 -->


		<!-- Content Container 3 -->
		<div id="postbox-container-1" class="postbox-container float-left">

			<div id="normal-sortables" class="meta-box-sortables ui-sortable"> 
			
				<div id="dashboard_quick_press" class="postbox mh-255">

					<h2 class="hndle">3. Actions</h2>

					<div class="inside m-12">
						
						<p>Action Buttons </p>
						<small>Action 1 title</small>
						<div class="input-text-wrap mb-2" id="title-wrap">
							<label class="prompt" for="action_title_one" id="title-prompt-text">
								Action Title One
							</label>

							<input type="text" name="action_title_one" id="action_title_one" autocomplete="off">
						</div>

						<small>Action 1 destination URL</small>
						<div class="input-text-wrap mb-2" id="title-wrap">
							<label class="prompt" for="action_url_one" id="title-prompt-text">
								Action One URL
							</label>

							<input type="text" name="action_url_one" id="action_url_one" autocomplete="off">
						</div>	

						<small>Action 2 title</small>
						<div class="input-text-wrap mb-2" id="title-wrap">
							<label class="prompt" for="action_title_two" id="title-prompt-text">
								Action Title Two
							</label>

							<input type="text" name="action_title_two" id="action_title_two" autocomplete="off">
						</div>

						<small>Action 2 destination URL</small>
						<div class="input-text-wrap mb-2" id="title-wrap">
							<label class="prompt" for="action_url_two" id="title-prompt-text">
								Action Two URL
							</label>

							<input type="text" name="action_url_two" id="action_url_two" autocomplete="off">
						</div>

						<p>Large Image URL</p>
		
						<div class="input-text-wrap mb-2" id="title-wrap">
							<label class="prompt" for="image" id="title-prompt-text">
								Image URL
							</label>

							<input type="text" name="image" id="image" autocomplete="off">
						</div>						
				

					</div>

				</div>

			</div>
			

		</div>
		<!-- END Content Container 3 -->



	</div>
	<!-- END Dashboard Widget -->

</div>
<!-- END Widget Wrap -->

</div>
<!-- END Wrap -->
