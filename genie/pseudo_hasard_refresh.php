<?php
/*
 * Plugin Pseudo Hasard
 * (c) 2015 Julien Tessier
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function genie_pseudo_hasard_refresh_dist ($t) {
 
 	$tables_objets = lister_tables_objets_sql();
	foreach($tables_objets as $table => $infos){
		if (isset($infos['field']['maj'])) sql_update($table, array('pseudo_hasard' => 'RAND()', 'maj' => 'maj'));
		else sql_update($table, array('pseudo_hasard' => 'RAND()'));
	}

	return 1;
}
