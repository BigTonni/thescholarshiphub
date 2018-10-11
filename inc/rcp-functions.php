<?php
/**
 * Adds the custom fields to the registration form and profile editor
 *
 */
function pw_rcp_add_user_field_gender() {
	
	$gender = get_user_meta( get_current_user_id(), 'rcp_gender', true );
	?>
	<p id="rcp_gender_wrapper">
		<label for="rcp_gender"><?php _e( 'Gender', 'rcp' ); ?></label>
		<select id="rcp_gender" name="rcp_gender">
            <option value="" <?php selected( $gender, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
            <option value="Male" <?php selected( $gender, 'Male'); ?>><?php _e( 'Male', 'rcp' ); ?></option>
            <option value="Female" <?php selected( $gender, 'Female'); ?>><?php _e( 'Female', 'rcp' ); ?></option>
            <option value="Prefer Not to Say" <?php selected( $gender, 'Prefer Not to Say'); ?>><?php _e( 'Prefer Not to Say', 'rcp' ); ?></option>
        </select>
	</p>
	<?php
}
add_action( 'rcp_after_first_name_registration_field', 'pw_rcp_add_user_field_gender' );
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_field_gender' );

function pw_rcp_add_user_field_location() {
	$location   = get_user_meta( get_current_user_id(), 'rcp_location', true );
	?>
	<p id="rcp_location_wrapper">
		<label for="rcp_location"><?php _e( 'Current Location', 'rcp' ); ?></label>
		<select id="rcp_location" name="rcp_location">
            <option value="" <?php selected( $location, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
            <option value="East Anglia" <?php selected( $location, 'East Anglia'); ?>><?php _e( 'East Anglia', 'rcp' ); ?></option>
            <option value="London & Home Counties" <?php selected( $location, 'London & Home Counties'); ?>><?php _e( 'London & Home Counties', 'rcp' ); ?></option>
            <option value="Midlands" <?php selected( $location, 'Midlands'); ?>><?php _e( 'Midlands', 'rcp' ); ?></option>
            <option value="North West" <?php selected( $location, 'North West'); ?>><?php _e( 'North West', 'rcp' ); ?></option>
            <option value="North East" <?php selected( $location, 'North East'); ?>><?php _e( 'North East', 'rcp' ); ?></option>
            <option value="Northern Ireland" <?php selected( $location, 'Northern Ireland'); ?>><?php _e( 'Northern Ireland', 'rcp' ); ?></option>
            <option value="Scotland" <?php selected( $location, 'Scotland'); ?>><?php _e( 'Scotland', 'rcp' ); ?></option>
            <option value="South East" <?php selected( $location, 'South East'); ?>><?php _e( 'South East', 'rcp' ); ?></option>
            <option value="South West" <?php selected( $location, 'South West'); ?>><?php _e( 'South West', 'rcp' ); ?></option>
            <option value="Europe" <?php selected( $location, 'Europe'); ?>><?php _e( 'Europe', 'rcp' ); ?></option>
            <option value="Other" <?php selected( $location, 'Other'); ?>><?php _e( 'Other', 'rcp' ); ?></option>
        </select>
	</p>
	<?php
}
add_action( 'rcp_after_last_name_registration_field', 'pw_rcp_add_user_field_location' );
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_field_location' );


function pw_rcp_add_user_field_additional_opportunities() {
	
	$additional_opportunities = get_user_meta( get_current_user_id(), 'rcp_additional_opportunities', true );
	$additional_newsletter = get_user_meta( get_current_user_id(), 'rcp_additional_newsletter', true );
	?>
	<p>
        <input name="rcp_additional_newsletter" id="rcp_additional_newsletter" type="checkbox" value="1" <?php checked( $additional_newsletter ); ?>/>
        <label for="rcp_additional_newsletter"><?php _e( 'Newsletter Opt In', 'rcp' ); ?></label>
        <sup class="description">Registering with The Scholarship Hub will allow you to search for scholarships on our database. If you would also like to receive our email newsletter with updates on new scholarships and deadline notifications please this tick the box.</sup>
    </p>

    <p>
        <input name="rcp_additional_opportunities" id="rcp_additional_opportunities" type="checkbox" value="1" <?php checked( $additional_opportunities ); ?>/>
        <label for="rcp_additional_opportunities"><?php _e( 'Additional Opportunitiess', 'rcp' ); ?></label>
        <sup class="description">From time to time, we get information from third parties about scholarships or other opportunities which we feel may be of specific interest to you. If you would like us to tell you about these please tick this box. At no point will your information be passed on to any third party and any mailings would be from The Scholarship Hub.</sup>
    </p>
    
	<?php
}
add_action( 'rcp_after_newsletter_registration_field', 'pw_rcp_add_user_field_additional_opportunities' );


function pw_rcp_add_user_field_status() {
	
	$status = get_user_meta( get_current_user_id(), 'rcp_status', true );
	$field_anticipated_year_of_entry = get_user_meta( get_current_user_id(), 'rcp_field_anticipated_year_of_entry', true );
	$degree_type = get_user_meta( get_current_user_id(), 'rcp_degree_type', true );
	$subjects_of_interest = get_user_meta( get_current_user_id(), 'rcp_subjects_of_interest', true );
	$location_studies = get_user_meta( get_current_user_id(), 'rcp_location_studies', true );
	$educator_role = get_user_meta( get_current_user_id(), 'rcp_educator_role', true );
	?>
	<p id="rcp_status_wrapper">
		<label for="rcp_status"><?php _e( 'Status', 'rcp' ); ?></label>
		<select id="rcp_status" name="rcp_status">
            <option value="" <?php selected( $status, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
            <option value="Student in Secondary School" <?php selected( $status, 'Student in Secondary School'); ?>><?php _e( 'Student in Secondary School', 'rcp' ); ?></option>
            <option value="Student at University" <?php selected( $status, 'Student at University'); ?>><?php _e( 'Student at University', 'rcp' ); ?></option>
            <option value="Parent" <?php selected( $status, 'Parent'); ?>><?php _e( 'Parent', 'rcp' ); ?></option>
            <option value="Educator" <?php selected( $status, 'Educator'); ?>><?php _e( 'Educator', 'rcp' ); ?></option>
        </select>
	</p>
	<span id="others_role_wrapper">
		<p id="rcp_field_anticipated_wrapper">
			<label for="rcp_field_anticipated_year_of_entry"><?php _e( 'Anticipated Year of Entry', 'rcp' ); ?></label>
			<span class="rcp_field_anticipated_aditional_wrapper">
				<input name="rcp_field_anticipated_year_of_entry" id="rcp_field_anticipated_year_of_entry" type="text" value="<?php echo esc_attr( $field_anticipated_year_of_entry ); ?>"/>
		        <sup class="description">The calendar year in which you or your student anticipate to start, or started, a higher education course of study</sup>
		    </span>
	    </p>
		<p id="rcp_degree_type_wrapper">
			<label for="rcp_degree_type"><?php _e( 'Degree Type', 'rcp' ); ?></label>
			<select id="rcp_degree_type" name="rcp_degree_type">
	            <option value="" <?php selected( $degree_type, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
	            <option value="Undergraduate" <?php selected( $degree_type, 'Undergraduate'); ?>><?php _e( 'Undergraduate', 'rcp' ); ?></option>
	            <option value="Postgraduate" <?php selected( $degree_type, 'Postgraduate'); ?>><?php _e( 'Postgraduate', 'rcp' ); ?></option>
	        </select>
		</p>
		<p id="rcp_subjects_of_interest_wrapper">
			<label for="rcp_subjects_of_interest"><?php _e( 'Subjects of Interest', 'rcp' ); ?></label>
			<select id="rcp_subjects_of_interest" name="rcp_subjects_of_interest" multiple="multiple">
	            <option value="Architecture, building & planning" <?php selected( $subjects_of_interest, 'Architecture, building & planning'); ?>><?php _e( 'Architecture, building & planning', 'rcp' ); ?></option>
	            <option value="Accounting/Finance" <?php selected( $subjects_of_interest, 'Accounting/Finance'); ?>><?php _e( 'Accounting/Finance', 'rcp' ); ?></option>
	            <option value="Art & Design" <?php selected( $subjects_of_interest, 'Art & Design'); ?>><?php _e( 'Art & Design', 'rcp' ); ?></option>
	            <option value="Biology" <?php selected( $subjects_of_interest, 'Biology'); ?>><?php _e( 'Biology', 'rcp' ); ?></option>
	            <option value="Business related subjects" <?php selected( $subjects_of_interest, 'Business related subjects'); ?>><?php _e( 'Business related subjects', 'rcp' ); ?></option>
	            <option value="Chemistry" <?php selected( $subjects_of_interest, 'Chemistry'); ?>><?php _e( 'Chemistry', 'rcp' ); ?></option>
	            <option value="Computer Science" <?php selected( $subjects_of_interest, 'Computer Science'); ?>><?php _e( 'Computer Science', 'rcp' ); ?></option>
	            <option value="Economics" <?php selected( $subjects_of_interest, 'Economics'); ?>><?php _e( 'Economics', 'rcp' ); ?></option>
	            <option value="Education/teaching" <?php selected( $subjects_of_interest, 'Education/teaching'); ?>><?php _e( 'Education/teaching', 'rcp' ); ?></option>
	            <option value="Engineering" <?php selected( $subjects_of_interest, 'Engineering'); ?>><?php _e( 'Engineering', 'rcp' ); ?></option>
	            <option value="Geography" <?php selected( $subjects_of_interest, 'Geography'); ?>><?php _e( 'Geography', 'rcp' ); ?></option>
	            <option value="History" <?php selected( $subjects_of_interest, 'History'); ?>><?php _e( 'History', 'rcp' ); ?></option>
	            <option value="Journalism/Media" <?php selected( $subjects_of_interest, 'Journalism/Media'); ?>><?php _e( 'Journalism/Media', 'rcp' ); ?></option>
	            <option value="Languages & Literature" <?php selected( $subjects_of_interest, 'Languages & Literature'); ?>><?php _e( 'Languages & Literature', 'rcp' ); ?></option>
	            <option value="Law" <?php selected( $subjects_of_interest, 'Law'); ?>><?php _e( 'Law', 'rcp' ); ?></option>
	            <option value="Maths" <?php selected( $subjects_of_interest, 'Maths'); ?>><?php _e( 'Maths', 'rcp' ); ?></option>
	            <option value="Medicine & Dentistry" <?php selected( $subjects_of_interest, 'Medicine & Dentistry'); ?>><?php _e( 'Medicine & Dentistry', 'rcp' ); ?></option>
	            <option value="Music" <?php selected( $subjects_of_interest, 'Music'); ?>><?php _e( 'Music', 'rcp' ); ?></option>
	            <option value="Philosophy" <?php selected( $subjects_of_interest, 'Philosophy'); ?>><?php _e( 'Philosophy', 'rcp' ); ?></option>
	            <option value="Physics" <?php selected( $subjects_of_interest, 'Physics'); ?>><?php _e( 'Physics', 'rcp' ); ?></option>
	            <option value="Politics" <?php selected( $subjects_of_interest, 'Politics'); ?>><?php _e( 'Politics', 'rcp' ); ?></option>
	            <option value="Psychology" <?php selected( $subjects_of_interest, 'Psychology'); ?>><?php _e( 'Psychology', 'rcp' ); ?></option>
	            <option value="Sociology" <?php selected( $subjects_of_interest, 'Sociology'); ?>><?php _e( 'Sociology', 'rcp' ); ?></option>
	            <option value="Sport & exercise science" <?php selected( $subjects_of_interest, 'Sport & exercise science'); ?>><?php _e( 'Sport & exercise science', 'rcp' ); ?></option>
	        </select>
		</p>
		<p id="rcp_location_studies_wrapper">
			<label for="rcp_location_studies"><?php _e( 'Location of Studies', 'rcp' ); ?></label>
			<select id="rcp_location_studies" name="rcp_location_studies" multiple="multiple">
	            <option value="East Anglia" <?php selected( $location_studies, 'East Anglia'); ?>><?php _e( 'East Anglia', 'rcp' ); ?></option>
	            <option value="London & Home Counties" <?php selected( $location_studies, 'London & Home Counties'); ?>><?php _e( 'London & Home Counties', 'rcp' ); ?></option>
	            <option value="Midlands" <?php selected( $location_studies, 'Midlands'); ?>><?php _e( 'Midlands', 'rcp' ); ?></option>
	            <option value="North West" <?php selected( $location_studies, 'North West'); ?>><?php _e( 'North West', 'rcp' ); ?></option>
	            <option value="North East" <?php selected( $location_studies, 'North East'); ?>><?php _e( 'North East', 'rcp' ); ?></option>
	            <option value="Northern Ireland" <?php selected( $location_studies, 'Northern Ireland'); ?>><?php _e( 'Northern Ireland', 'rcp' ); ?></option>
	            <option value="Scotland" <?php selected( $location_studies, 'Scotland'); ?>><?php _e( 'Scotland', 'rcp' ); ?></option>
	            <option value="South East" <?php selected( $location_studies, 'South East'); ?>><?php _e( 'South East', 'rcp' ); ?></option>
	            <option value="South West" <?php selected( $location_studies, 'South West'); ?>><?php _e( 'South West', 'rcp' ); ?></option>
	            <option value="Wales" <?php selected( $location_studies, 'Wales'); ?>><?php _e( 'Wales', 'rcp' ); ?></option>
	        </select>
		</p>
	</span>
	<span id="educator_selected_role_wrapper">
	<p id="educator_role_wrapper">
		<label for="rcp_educator_role"><?php _e( 'Educator Role', 'rcp' ); ?></label>
		<select id="rcp_educator_role" name="rcp_educator_role">
            <option value="" <?php selected( $educator_role, ''); ?>><?php _e( '- None -', 'rcp' ); ?></option>
            <option value="Careers Advisor" <?php selected( $educator_role, 'Careers Advisor'); ?>><?php _e( 'Careers Advisor', 'rcp' ); ?></option>
            <option value="Year 7 – 11" <?php selected( $educator_role, 'Year 7 – 11'); ?>><?php _e( 'Year 7 – 11', 'rcp' ); ?></option>
            <option value="Sixth Form" <?php selected( $educator_role, 'Sixth Form'); ?>><?php _e( 'Sixth Form', 'rcp' ); ?></option>
            <option value="University Level" <?php selected( $educator_role, 'University Level'); ?>><?php _e( 'University Level', 'rcp' ); ?></option>
        </select>
	</p>
	<span>
	<?php
}
add_action( 'rcp_after_location_registration_field', 'pw_rcp_add_user_field_status' );
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_field_status' );
/**
 * Adds the custom fields to the member edit screen
 *
 */
function pw_rcp_add_member_edit_fields( $user_id = 0 ) {
	
	$gender = get_user_meta( $user_id, 'rcp_gender', true );
	$location   = get_user_meta( $user_id, 'rcp_location', true );
	$status = get_user_meta($user_id, 'rcp_status', true );
	$field_anticipated_year_of_entry = get_user_meta( $user_id, 'rcp_field_anticipated_year_of_entry', true );
	$degree_type = get_user_meta( $user_id, 'rcp_degree_type', true );
	$subjects_of_interest = get_user_meta( $user_id, 'rcp_subjects_of_interest', true );
	$location_studies = get_user_meta( $user_id, 'rcp_location_studies', true );
	$educator_role = get_user_meta( $user_id, 'rcp_educator_role', true );
	?>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_gender"><?php _e( 'Gender', 'rcp' ); ?></label>
		</th>
		<td>
			<select id="rcp_gender" name="rcp_gender">
	            <option value="" <?php selected( $gender, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
	            <option value="Male" <?php selected( $gender, 'Male'); ?>><?php _e( 'Male', 'rcp' ); ?></option>
	            <option value="Female" <?php selected( $gender, 'Female'); ?>><?php _e( 'Female', 'rcp' ); ?></option>
	            <option value="Prefer Not to Say" <?php selected( $gender, 'Prefer Not to Say'); ?>><?php _e( 'Prefer Not to Say', 'rcp' ); ?></option>
	        </select>
			<p class="description"><?php _e( 'The member\'s gender', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_location"><?php _e( 'Location', 'rcp' ); ?></label>
		</th>
		<td>
			<select id="rcp_location" name="rcp_location">
	            <option value="" <?php selected( $location, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
	            <option value="East Anglia" <?php selected( $location, 'East Anglia'); ?>><?php _e( 'East Anglia', 'rcp' ); ?></option>
	            <option value="London & Home Counties" <?php selected( $location, 'London & Home Counties'); ?>><?php _e( 'London & Home Counties', 'rcp' ); ?></option>
	            <option value="Midlands" <?php selected( $location, 'Midlands'); ?>><?php _e( 'Midlands', 'rcp' ); ?></option>
	            <option value="North West" <?php selected( $location, 'North West'); ?>><?php _e( 'North West', 'rcp' ); ?></option>
	            <option value="North East" <?php selected( $location, 'North East'); ?>><?php _e( 'North East', 'rcp' ); ?></option>
	            <option value="Northern Ireland" <?php selected( $location, 'Northern Ireland'); ?>><?php _e( 'Northern Ireland', 'rcp' ); ?></option>
	            <option value="Scotland" <?php selected( $location, 'Scotland'); ?>><?php _e( 'Scotland', 'rcp' ); ?></option>
	            <option value="South East" <?php selected( $location, 'South East'); ?>><?php _e( 'South East', 'rcp' ); ?></option>
	            <option value="South West" <?php selected( $location, 'South West'); ?>><?php _e( 'South West', 'rcp' ); ?></option>
	            <option value="Europe" <?php selected( $location, 'Europe'); ?>><?php _e( 'Europe', 'rcp' ); ?></option>
	            <option value="Other" <?php selected( $location, 'Other'); ?>><?php _e( 'Other', 'rcp' ); ?></option>
	        </select>
			<p class="description"><?php _e( 'The member\'s location', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_status"><?php _e( 'Status', 'rcp' ); ?></label>
		</th>
		<td>
		<select id="rcp_status" name="rcp_status">
            <option value="" <?php selected( $status, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
            <option value="Student in Secondary School" <?php selected( $status, 'Student in Secondary School'); ?>><?php _e( 'Student in Secondary School', 'rcp' ); ?></option>
            <option value="Student at University" <?php selected( $status, 'Student at University'); ?>><?php _e( 'Student at University', 'rcp' ); ?></option>
            <option value="Parent" <?php selected( $status, 'Parent'); ?>><?php _e( 'Parent', 'rcp' ); ?></option>
            <option value="Educator" <?php selected( $status, 'Educator'); ?>><?php _e( 'Educator', 'rcp' ); ?></option>
        </select>
		<td>
	</tr>
	<?php if($status == "Educator"): ?>
		<tr valign="top">
			<th scope="row" valign="top">
				<label for="rcp_educator_role"><?php _e( 'Educator Role', 'rcp' ); ?></label>
			</th>
			<td>
				<select id="rcp_educator_role" name="rcp_educator_role">
		            <option value="" <?php selected( $educator_role, ''); ?>><?php _e( '- None -', 'rcp' ); ?></option>
		            <option value="Careers Advisor" <?php selected( $educator_role, 'Careers Advisor'); ?>><?php _e( 'Careers Advisor', 'rcp' ); ?></option>
		            <option value="Year 7 – 11" <?php selected( $educator_role, 'Year 7 – 11'); ?>><?php _e( 'Year 7 – 11', 'rcp' ); ?></option>
		            <option value="Sixth Form" <?php selected( $educator_role, 'Sixth Form'); ?>><?php _e( 'Sixth Form', 'rcp' ); ?></option>
		            <option value="University Level" <?php selected( $educator_role, 'University Level'); ?>><?php _e( 'University Level', 'rcp' ); ?></option>
		        </select>				
			<td>
		</tr>
	<?php else: ?>
		<tr valign="top">
			<th scope="row" valign="top">
				<label for="rcp_field_anticipated_year_of_entry"><?php _e( 'Anticipated Year of Entry', 'rcp' ); ?></label>
			</th>
			<td>
			<input name="rcp_field_anticipated_year_of_entry" id="rcp_field_anticipated_year_of_entry" type="text" value="<?php echo esc_attr( $field_anticipated_year_of_entry ); ?>"/>				
			<td>
		</tr>
		<tr valign="top">
			<th scope="row" valign="top">
				<label for="rcp_degree_type"><?php _e( 'Degree Type', 'rcp' ); ?></label>
			</th>
			<td>
				<select id="rcp_degree_type" name="rcp_degree_type">
		            <option value="" <?php selected( $degree_type, ''); ?>><?php _e( '- Select a value -', 'rcp' ); ?></option>
		            <option value="Undergraduate" <?php selected( $degree_type, 'Undergraduate'); ?>><?php _e( 'Undergraduate', 'rcp' ); ?></option>
		            <option value="Postgraduate" <?php selected( $degree_type, 'Postgraduate'); ?>><?php _e( 'Postgraduate', 'rcp' ); ?></option>
		        </select>				
			<td>
		</tr>
		<tr valign="top">
			<th scope="row" valign="top">
				<label for="rcp_subjects_of_interest"><?php _e( 'Subjects of Interest', 'rcp' ); ?></label>
			</th>
			<td>
				<select id="rcp_subjects_of_interest" name="rcp_subjects_of_interest" multiple="multiple">
		            <option value="Architecture, building & planning" <?php selected( $subjects_of_interest, 'Architecture, building & planning'); ?>><?php _e( 'Architecture, building & planning', 'rcp' ); ?></option>
		            <option value="Accounting/Finance" <?php selected( $subjects_of_interest, 'Accounting/Finance'); ?>><?php _e( 'Accounting/Finance', 'rcp' ); ?></option>
		            <option value="Art & Design" <?php selected( $subjects_of_interest, 'Art & Design'); ?>><?php _e( 'Art & Design', 'rcp' ); ?></option>
		            <option value="Biology" <?php selected( $subjects_of_interest, 'Biology'); ?>><?php _e( 'Biology', 'rcp' ); ?></option>
		            <option value="Business related subjects" <?php selected( $subjects_of_interest, 'Business related subjects'); ?>><?php _e( 'Business related subjects', 'rcp' ); ?></option>
		            <option value="Chemistry" <?php selected( $subjects_of_interest, 'Chemistry'); ?>><?php _e( 'Chemistry', 'rcp' ); ?></option>
		            <option value="Computer Science" <?php selected( $subjects_of_interest, 'Computer Science'); ?>><?php _e( 'Computer Science', 'rcp' ); ?></option>
		            <option value="Economics" <?php selected( $subjects_of_interest, 'Economics'); ?>><?php _e( 'Economics', 'rcp' ); ?></option>
		            <option value="Education/teaching" <?php selected( $subjects_of_interest, 'Education/teaching'); ?>><?php _e( 'Education/teaching', 'rcp' ); ?></option>
		            <option value="Engineering" <?php selected( $subjects_of_interest, 'Engineering'); ?>><?php _e( 'Engineering', 'rcp' ); ?></option>
		            <option value="Geography" <?php selected( $subjects_of_interest, 'Geography'); ?>><?php _e( 'Geography', 'rcp' ); ?></option>
		            <option value="History" <?php selected( $subjects_of_interest, 'History'); ?>><?php _e( 'History', 'rcp' ); ?></option>
		            <option value="Journalism/Media" <?php selected( $subjects_of_interest, 'Journalism/Media'); ?>><?php _e( 'Journalism/Media', 'rcp' ); ?></option>
		            <option value="Languages & Literature" <?php selected( $subjects_of_interest, 'Languages & Literature'); ?>><?php _e( 'Languages & Literature', 'rcp' ); ?></option>
		            <option value="Law" <?php selected( $subjects_of_interest, 'Law'); ?>><?php _e( 'Law', 'rcp' ); ?></option>
		            <option value="Maths" <?php selected( $subjects_of_interest, 'Maths'); ?>><?php _e( 'Maths', 'rcp' ); ?></option>
		            <option value="Medicine & Dentistry" <?php selected( $subjects_of_interest, 'Medicine & Dentistry'); ?>><?php _e( 'Medicine & Dentistry', 'rcp' ); ?></option>
		            <option value="Music" <?php selected( $subjects_of_interest, 'Music'); ?>><?php _e( 'Music', 'rcp' ); ?></option>
		            <option value="Philosophy" <?php selected( $subjects_of_interest, 'Philosophy'); ?>><?php _e( 'Philosophy', 'rcp' ); ?></option>
		            <option value="Physics" <?php selected( $subjects_of_interest, 'Physics'); ?>><?php _e( 'Physics', 'rcp' ); ?></option>
		            <option value="Politics" <?php selected( $subjects_of_interest, 'Politics'); ?>><?php _e( 'Politics', 'rcp' ); ?></option>
		            <option value="Psychology" <?php selected( $subjects_of_interest, 'Psychology'); ?>><?php _e( 'Psychology', 'rcp' ); ?></option>
		            <option value="Sociology" <?php selected( $subjects_of_interest, 'Sociology'); ?>><?php _e( 'Sociology', 'rcp' ); ?></option>
		            <option value="Sport & exercise science" <?php selected( $subjects_of_interest, 'Sport & exercise science'); ?>><?php _e( 'Sport & exercise science', 'rcp' ); ?></option>
		        </select>				
			<td>
		</tr>
		<tr valign="top">
			<th scope="row" valign="top">
				<label for="rcp_location_studies"><?php _e( 'Location of Studies', 'rcp' ); ?></label>
			</th>
			<td>
				<select id="rcp_location_studies" name="rcp_location_studies" multiple="multiple">
		            <option value="East Anglia" <?php selected( $location_studies, 'East Anglia'); ?>><?php _e( 'East Anglia', 'rcp' ); ?></option>
		            <option value="London & Home Counties" <?php selected( $location_studies, 'London & Home Counties'); ?>><?php _e( 'London & Home Counties', 'rcp' ); ?></option>
		            <option value="Midlands" <?php selected( $location_studies, 'Midlands'); ?>><?php _e( 'Midlands', 'rcp' ); ?></option>
		            <option value="North West" <?php selected( $location_studies, 'North West'); ?>><?php _e( 'North West', 'rcp' ); ?></option>
		            <option value="North East" <?php selected( $location_studies, 'North East'); ?>><?php _e( 'North East', 'rcp' ); ?></option>
		            <option value="Northern Ireland" <?php selected( $location_studies, 'Northern Ireland'); ?>><?php _e( 'Northern Ireland', 'rcp' ); ?></option>
		            <option value="Scotland" <?php selected( $location_studies, 'Scotland'); ?>><?php _e( 'Scotland', 'rcp' ); ?></option>
		            <option value="South East" <?php selected( $location_studies, 'South East'); ?>><?php _e( 'South East', 'rcp' ); ?></option>
		            <option value="South West" <?php selected( $location_studies, 'South West'); ?>><?php _e( 'South West', 'rcp' ); ?></option>
		            <option value="Wales" <?php selected( $location_studies, 'Wales'); ?>><?php _e( 'Wales', 'rcp' ); ?></option>
		        </select>			
			<td>
		</tr>
	<?php endif; ?>
	<?php
}
add_action( 'rcp_edit_member_after', 'pw_rcp_add_member_edit_fields' );

/**
 * Determines if there are problems with the registration data submitted
 *
 */
function pw_rcp_validate_user_fields_on_register( $posted ) {
	if ( is_user_logged_in() ) {
	   return;
    }
	if( empty( $posted['rcp_gender'] ) ) {
		rcp_errors()->add( 'invalid_gender', __( 'Please enter your Gender', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_location'] ) ) {
		rcp_errors()->add( 'invalid_location', __( 'Please enter your Location', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_status'] ) ) {
		rcp_errors()->add( 'invalid_status', __( 'Please enter your Status', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_degree_type'] ) ) {
		rcp_errors()->add( 'invalid_rcp_degree_type', __( 'Please enter your Degree Type', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_subjects_of_interest'] ) ) {
		rcp_errors()->add( 'invalid_rcp_subjects_of_interest', __( 'Please enter your Subjects of Interest', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_field_anticipated_year_of_entry'] ) ) {
		rcp_errors()->add( 'invalid_field_anticipated_year_of_entry', __( 'Please enter Year of Entry', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_location_studies'] ) ) {
		rcp_errors()->add( 'invalid_rcp_location_studies', __( 'Please enter your Location Studies', 'rcp' ), 'register' );
	}
}
add_action( 'rcp_form_errors', 'pw_rcp_validate_user_fields_on_register', 10 );

/**
 * Stores the information submitted during registration
 *
 */
function pw_rcp_save_user_fields_on_register( $posted, $user_id ) {
	if( ! empty( $posted['rcp_gender'] ) ) {
		update_user_meta( $user_id, 'rcp_gender', sanitize_text_field( $posted['rcp_gender'] ) );
	}
	if( ! empty( $posted['rcp_location'] ) ) {
		update_user_meta( $user_id, 'rcp_location', sanitize_text_field( $posted['rcp_location'] ) );
	}
	if( ! empty( $posted['rcp_additional_opportunities'] ) ) {
		update_user_meta( $user_id, 'rcp_additional_opportunities', sanitize_text_field( $posted['rcp_additional_opportunities'] ) );
	}
	if( ! empty( $posted['rcp_additional_newsletter'] ) ) {
		update_user_meta( $user_id, 'rcp_additional_newsletter', sanitize_text_field( $posted['rcp_additional_newsletter'] ) );
	}
	if( ! empty( $posted['rcp_status'] ) ) {
		update_user_meta( $user_id, 'rcp_status', sanitize_text_field( $posted['rcp_status'] ) );
	}
	if( ! empty( $posted['rcp_field_anticipated_year_of_entry'] ) ) {
		update_user_meta( $user_id, 'rcp_field_anticipated_year_of_entry', sanitize_text_field( $posted['rcp_field_anticipated_year_of_entry'] ) );
	}
	if( ! empty( $posted['rcp_degree_type'] ) ) {
		update_user_meta( $user_id, 'rcp_degree_type', sanitize_text_field( $posted['rcp_degree_type'] ) );
	}
	if( ! empty( $posted['rcp_subjects_of_interest'] ) ) {
		update_user_meta( $user_id, 'rcp_subjects_of_interest', sanitize_text_field( $posted['rcp_subjects_of_interest'] ) );
	}
	if( ! empty( $posted['rcp_location_studies'] ) ) {
		update_user_meta( $user_id, 'rcp_location_studies', sanitize_text_field( $posted['rcp_location_studies'] ) );
	}
	if( ! empty( $posted['rcp_educator_role'] ) ) {
		update_user_meta( $user_id, 'rcp_educator_role', sanitize_text_field( $posted['rcp_educator_role'] ) );
	}
}
add_action( 'rcp_form_processing', 'pw_rcp_save_user_fields_on_register', 10, 2 );

/**
 * Stores the information submitted profile update
 *
 */
function pw_rcp_save_user_fields_on_profile_save( $user_id ) {
	if( ! empty( $_POST['rcp_gender'] ) ) {
		update_user_meta( $user_id, 'rcp_gender', sanitize_text_field( $_POST['rcp_gender'] ) );
	}
	if( ! empty( $_POST['rcp_location'] ) ) {
		update_user_meta( $user_id, 'rcp_location', sanitize_text_field( $_POST['rcp_location'] ) );
	}
	if( ! empty( $_POST['rcp_status'] ) ) {
		update_user_meta( $user_id, 'rcp_status', sanitize_text_field( $_POST['rcp_status'] ) );
	}
	if( ! empty( $_POST['rcp_field_anticipated_year_of_entry'] ) ) {
		update_user_meta( $user_id, 'rcp_field_anticipated_year_of_entry', sanitize_text_field( $_POST['rcp_field_anticipated_year_of_entry'] ) );
	}
	if( ! empty( $_POST['rcp_degree_type'] ) ) {
		update_user_meta( $user_id, 'rcp_degree_type', sanitize_text_field( $_POST['rcp_degree_type'] ) );
	}
	if( ! empty( $_POST['rcp_subjects_of_interest'] ) ) {
		update_user_meta( $user_id, 'rcp_subjects_of_interest', sanitize_text_field( $_POST['rcp_subjects_of_interest'] ) );
	}
	if( ! empty( $_POST['rcp_location_studies'] ) ) {
		update_user_meta( $user_id, 'rcp_location_studies', sanitize_text_field( $_POST['rcp_location_studies'] ) );
	}
	if( ! empty( $_POST['rcp_educator_role'] ) ) {
		update_user_meta( $user_id, 'rcp_educator_role', sanitize_text_field( $_POST['rcp_educator_role'] ) );
	}
}
add_action( 'rcp_user_profile_updated', 'pw_rcp_save_user_fields_on_profile_save', 10 );
add_action( 'rcp_edit_member', 'pw_rcp_save_user_fields_on_profile_save', 10 );
