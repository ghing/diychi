<?php
 /**
  * This template is used to print the address of a venue, respecting
  * the public flag of the address.
	*
	* It's neccessary because we're trying to reference a field of a field
	* collection that is a field of a referenced entity. 
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php
$address_output = '';
// Get the raw public flag and address array from the row.
// This seems like a totally ridiculous way to get the information and
// I pray there's a cleaner way.
if (isset($row->field_field_protected_address[0])) {
	$field_collection_id = array_pop(array_pop($field->get_value($row)));
	$public = $row->field_field_protected_address[0]['rendered']['entity']['field_collection_item'][$field_collection_id]['field_public']['#items'][0]['value'];
	$address = $row->field_field_protected_address[0]['rendered']['entity']['field_collection_item'][$field_collection_id]['field_address']['#items'][0];
	if ($public) {
		$address_output = _diychi_render_address($address);
	}
}
?>
<?php print $address_output; ?>
