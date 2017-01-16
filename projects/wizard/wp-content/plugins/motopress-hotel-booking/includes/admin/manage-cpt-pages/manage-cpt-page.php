<?php

namespace MPHB\Admin\ManageCPTPages;

class ManageCPTPage extends AbstractManageCPTPage {

	public function filterColumns( $columns ){
		return $columns;
	}

	public function filterSortableColumns( $columns ){
		return $columns;
	}

	public function renderColumns( $column, $postId ){

	}

}
