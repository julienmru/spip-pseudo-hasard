<?php
/*
 * Plugin Pseudo Hasard
 * (c) 2015 Julien Tessier
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function pseudo_hasard_declarer_tables_objets_sql($tables){
	$tables[]['field']['pseudo_hasard'] = "FLOAT DEFAULT 0 NOT NULL";
	return $tables;
}

function pseudo_hasard_taches_generales_cron($taches){
	$taches['pseudo_hasard_refresh'] = 86400; // tous les jours
	return $taches;
}

function pseudo_hasard_post_insertion($flux) {
	$trouver_table = charger_fonction('trouver_table','base');
	$desc = $trouver_table($flux['args']['table']);
	if ($desc && isset($desc['field']['pseudo_hasard'])) {
		sql_update($flux['args']['table'], array('pseudo_hasard' => 'RAND()'), '`'.$desc['key']['PRIMARY KEY'].'` = '.intval($flux['args']['id_objet']));
	}
	return $flux;
}