<?php
class ModelExtensionModuleMegamenu extends Model {
	public function getCategories($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) LEFT JOIN " . DB_PREFIX . "megamenu m ON (c.category_id = m.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}

	public function getMegamenuBannerIdByCategoryId($category_id) {
		$query = $this->db->query("SELECT banner_id FROM " . DB_PREFIX . "megamenu WHERE category_id = '" . (int)$category_id . "'");

		if ($query->num_rows) {
			return $query->row['banner_id'];
		} else {
			return 0;
		}
	}
}