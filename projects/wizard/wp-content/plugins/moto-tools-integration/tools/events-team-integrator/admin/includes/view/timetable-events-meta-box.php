<select id="mti-mebmers-select" name="mti-mebmers-select[]" multiple="multiple">
<?php
	$members_list = events_team_integrator_admin()->get_members_list();
	foreach ( $members_list as $member ) {
		$selected = $member['selected'] ? ' selected' : '';
		echo '<option value="' . $member['id'] . '"' . $selected . '>' . $member['title'] . '</option>';
	}
?>
</select>
