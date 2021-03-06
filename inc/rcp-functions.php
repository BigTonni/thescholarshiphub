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
		<select id="rcp_gender" name="rcp_gender" tabindex="5">
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
		<select id="rcp_location" name="rcp_location" tabindex="6">
                    <?php
                        echo thescholarshiphub_list_locations($location, __( '- Select a value -', 'rcp' ));
                    ?>
                </select>
	</p>
	<?php
}
add_action( 'rcp_after_last_name_registration_field', 'pw_rcp_add_user_field_location' );
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_field_location' );


function pw_rcp_add_user_field_additional_opportunities() {
	
	$additional_opportunities = get_user_meta( get_current_user_id(), 'rcp_additional_opportunities', true );
	$degree_apprenticeship = get_user_meta( get_current_user_id(), 'rcp_degree_apprenticeship', true );	
	$additional_newsletter = get_user_meta( get_current_user_id(), 'rcp_additional_newsletter', true );
	?>
    <p>
        <input name="rcp_additional_newsletter"  id="rcp_additional_newsletter" type="checkbox" value="1" <?php checked( $additional_newsletter ); ?>/>
        <label for="rcp_additional_newsletter"><?php _e( 'Newsletter Opt In', 'rcp' ); ?></label>
        <sup class="description">Registering with The Scholarship Hub will allow you to search for scholarships on our database. If you would also like to receive our email newsletter with updates on new scholarships and deadline notifications please this tick the box.</sup>
    </p>

    <p>
        <input name="rcp_additional_opportunities" id="rcp_additional_opportunities" type="checkbox" value="1" <?php checked( $additional_opportunities ); ?>/>
        <label for="rcp_additional_opportunities"><?php _e( 'Additional Opportunitiess', 'rcp' ); ?></label>
        <sup class="description">From time to time, we get information from third parties about scholarships or other opportunities which we feel may be of specific interest to you. If you would like us to tell you about these please tick this box. At no point will your information be passed on to any third party and any mailings would be from The Scholarship Hub.</sup>
    </p>

    <p class="degree_apprenticeship_wrapper">
        <input name="rcp_degree_apprenticeship" id="rcp_degree_apprenticeship" type="checkbox" value="1" <?php checked( $degree_apprenticeship ); ?>/>
        <label for="rcp_degree_apprenticeship"><?php _e( 'Degree Apprenticeship Interest', 'rcp' ); ?></label>
        <sup class="description">If you would be interested in learning about degree apprenticeship opportunities that match your profile please tick this box.</sup>
    </p>    
    <?php
}
add_action( 'rcp_after_newsletter_registration_field', 'pw_rcp_add_user_field_additional_opportunities' );


function pw_rcp_add_user_field_status() {
	$user_id = get_current_user_id();
        
	$status = get_user_meta( $user_id, 'rcp_status', true );
	$field_anticipated_year_of_entry = get_user_meta( $user_id, 'rcp_field_anticipated_year_of_entry', true );
	$degree_type = get_user_meta( $user_id, 'rcp_degree_type', true );
	$subjects_of_interest = get_user_meta( $user_id, 'rcp_subjects_of_interest', true );
        $subjects_of_interest = $subjects_of_interest != false ? $subjects_of_interest : array();
	$location_studies = get_user_meta( $user_id, 'rcp_location_studies', true );
        $location_studies = $location_studies != false ? $location_studies : array();
	$educator_role = get_user_meta( $user_id, 'rcp_educator_role', true );
	?>
	<p id="rcp_status_wrapper">
		<label for="rcp_status"><?php _e( 'Status', 'rcp' ); ?></label>
		<select id="rcp_status" name="rcp_status" tabindex="9">
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
                            <?php
                                echo thescholarshiphub_list_study_levels($degree_type, __('- Select a value -', 'rcp'));
                            ?>
                        </select>
		</p>
		<p id="rcp_subjects_of_interest_wrapper">
			<label for="rcp_subjects_of_interest"><?php _e( 'Subjects of Interest', 'rcp' ); ?></label>
			<select id="rcp_subjects_of_interest" name="rcp_subjects_of_interest[]" multiple="multiple" style="width:69%;">
                            <?php
                                echo thescholarshiphub_list_subjects_multiple_new($subjects_of_interest);//thescholarshiphub_list_subjects_multiple($subjects_of_interest, '', false);
                            ?>
                        </select>
		</p>
		<p id="rcp_location_studies_wrapper">
			<label for="rcp_location_studies"><?php _e( 'Location of Studies', 'rcp' ); ?></label>
			<select id="rcp_location_studies" name="rcp_location_studies[]" multiple="multiple">
                        <?php
                            echo thescholarshiphub_list_locations_multiple($location_studies,'', false);
                        ?>
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
        $subjects_of_interest = $subjects_of_interest != false ? $subjects_of_interest : array();
	$location_studies = get_user_meta( $user_id, 'rcp_location_studies', true );
        $location_studies = $location_studies != false ? $location_studies : array();
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
                        <?php
                            echo thescholarshiphub_list_locations($location, __( '- Select a value -', 'rcp' ));
                        ?>	            
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
                                    <?php
                                        echo thescholarshiphub_list_study_levels($degree_type, __('- Select a value -', 'rcp'));
                                    ?>
                                </select>				
			<td>
		</tr>
		<tr valign="top">
			<th scope="row" valign="top">
				<label for="rcp_subjects_of_interest"><?php _e( 'Subjects of Interest', 'rcp' ); ?></label>
			</th>
			<td>
				<select id="rcp_subjects_of_interest" name="rcp_subjects_of_interest[]" multiple="multiple" style="width:69%;">
                                    <?php
                                        echo thescholarshiphub_list_subjects_multiple_new($subjects_of_interest);//thescholarshiphub_list_subjects_multiple($subjects_of_interest, '', false);
                                    ?>
                                </select>				
			<td>
		</tr>
		<tr valign="top">
			<th scope="row" valign="top">
				<label for="rcp_location_studies"><?php _e( 'Location of Studies', 'rcp' ); ?></label>
			</th>
			<td>
				<select id="rcp_location_studies" name="rcp_location_studies[]" multiple="multiple">
                                    <?php
                                        echo thescholarshiphub_list_locations_multiple($location_studies,'', false);
                                    ?>
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
	if( empty( $posted['rcp_subjects_of_interest'] ) && $posted['rcp_status'] != 'Educator' ) {
		rcp_errors()->add( 'invalid_rcp_subjects_of_interest', __( 'Please enter your Subjects of Interest', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_field_anticipated_year_of_entry'] ) ) {
		rcp_errors()->add( 'invalid_field_anticipated_year_of_entry', __( 'Please enter Year of Entry', 'rcp' ), 'register' );
	}
	if( empty( $posted['rcp_location_studies'] ) && $posted['rcp_status'] != 'Educator' ) {
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
	if( ! empty( $posted['rcp_degree_apprenticeship'] ) ) {
		update_user_meta( $user_id, 'rcp_degree_apprenticeship', sanitize_text_field( $posted['rcp_degree_apprenticeship'] ) );
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
		update_user_meta( $user_id, 'rcp_subjects_of_interest', $posted['rcp_subjects_of_interest'] );
	}
	if( ! empty( $posted['rcp_location_studies'] ) ) {
		update_user_meta( $user_id, 'rcp_location_studies', $posted['rcp_location_studies'] );
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
		update_user_meta( $user_id, 'rcp_subjects_of_interest', $_POST['rcp_subjects_of_interest'] );
	}
	if( ! empty( $_POST['rcp_location_studies'] ) ) {
		update_user_meta( $user_id, 'rcp_location_studies', $_POST['rcp_location_studies'] );
	}
	if( ! empty( $_POST['rcp_educator_role'] ) ) {
		update_user_meta( $user_id, 'rcp_educator_role', sanitize_text_field( $_POST['rcp_educator_role'] ) );
	}
}
add_action( 'rcp_user_profile_updated', 'pw_rcp_save_user_fields_on_profile_save', 10 );
add_action( 'rcp_edit_member', 'pw_rcp_save_user_fields_on_profile_save', 10 );
