<?php
/*
 * Plugin Pseudo Hasard
 * (c) 2015 Julien Tessier
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;


function pseudo_hasard_upgrade($nom_meta_base_version,$version_cible){
	include_spip('base/objets');
	$tables_objets = array_keys(lister_tables_objets_sql());
	$maj = array();
	$maj['create'] = array();
	$trouver_table = charger_fonction('trouver_table','base');
	foreach($tables_objets as $table){
		$desc = $trouver_table($table);
		if (!isset($desc['field']['pseudo_hasard'])) {
			$maj['create'][] = array('sql_alter',"TABLE $table ADD pseudo_hasard FLOAT DEFAULT 0 NOT NULL");
		}
	}

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

function pseudo_hasard_check_upgrade(){
	include_spip('base/objets');
	$tables_objets = array_keys(lister_tables_objets_sql());
	$trouver_table = charger_fonction('trouver_table','base');
	foreach($tables_objets as $table){
		$desc = $trouver_table($table);
		if (!isset($desc['field']['pseudo_hasard'])) {
			sql_alter("TABLE $table ADD pseudo_hasard REAL DEFAULT 0 NOT NULL");
			sql_update($table, array('pseudo_hasard' => 'RAND()'));
		}
	}
}

function pseudo_hasard_vider_tables($nom_meta_base_version) {
	include_spip('inc/meta');
	include_spip('base/abstract_sql');

	include_spip('base/objets');
	$tables_objets = array_keys(lister_tables_objets_sql());
	foreach($tables_objets as $table){
		sql_alter("TABLE $table DROP pseudo_hasard");
	}

	effacer_meta($nom_meta_base_version);
}